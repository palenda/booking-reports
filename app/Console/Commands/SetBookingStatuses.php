<?php

namespace App\Console\Commands;

use App\Enums\BookingStatusEnum;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Interfaces\BookingStatusRepositoryInterface;
use App\Repositories\Interfaces\CapacityRepositoryInterface;
use App\Repositories\Interfaces\HotelRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SetBookingStatuses extends Command
{
    /**
     * @var string
     */
    protected $signature = 'app:set-booking-statuses';

    /**
     * @var string
     */
    protected $description = 'To set statuses for bookings';

    public function __construct(
        protected readonly BookingRepositoryInterface $bookingRepository,
        protected readonly CapacityRepositoryInterface $capacityRepository,
        protected readonly HotelRepositoryInterface $hotelRepository,
        protected readonly BookingStatusRepositoryInterface $bookingStatusRepository
    ) {
        parent::__construct();
    }

    /**
     * Set status for each booking, according to hotel capacity.
     *
     * @return void
     */
    public function handle(): void
    {
        $hotels = $this->hotelRepository->getHotels();

        $this->info('Setting bookings statuses for hotels');
        $bar = $this->output->createProgressBar(count($hotels));
        DB::beginTransaction();
        foreach ($hotels as $hotel) {
            $bookings = $this->bookingRepository->getBookingsByHotelId($hotel->id);
            foreach ($bookings as $booking) {
                $arrivalDate = $booking->arrival_date;
                $nights = $booking->nights;

                $startDate = Carbon::parse($arrivalDate);
                $endDate = $startDate->copy()->addDays($nights)->subDay();

                $capacities = $this->capacityRepository->getCapacityByHotelIdAndDatePeriod($hotel->id, $startDate, $endDate);

                if ($capacities->count() !== $nights) {
                    $this->bookingStatusRepository->setBookingStatus($booking->id, BookingStatusEnum::REJECTED->value);
                    continue;
                }

                foreach ($capacities as $capacity) {
                    $this->capacityRepository->updateCapacity($capacity->id, $capacity->capacity - 1);
                }
                $this->bookingStatusRepository->setBookingStatus($booking->id, BookingStatusEnum::APPROVED->value);
            }
            $bar->advance();
        }
        DB::commit();
        $this->info("\nBookings statuses have been set");
    }
}
