<?php

namespace App\Repositories;

use App\Enums\BookingStatusEnum;
use App\Models\Booking;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BookingRepository implements BookingRepositoryInterface
{
    /**
     * @param int $id
     * @return Collection
     */
    public function getBookingsByHotelId(int $id): Collection
    {
        return Booking::query()
            ->where('hotel_id', $id)
            ->orderBy('arrival_date')
            ->orderBy('purchase_day')
            ->get();
    }

    /**
     * Get average rejection rate per hotel.
     *
     * @return Collection
     */
    public function getAvgBookingRejectionRatePerHotel(): Collection
    {
        return Booking::query()
            ->select('bookings.hotel_id as hotel_id')
            ->selectRaw('((COUNT(bookings_statuses.booking_id) / total_count.total) * 100) as rate')
            ->join('bookings_statuses', 'bookings.id', '=', 'bookings_statuses.booking_id')
            ->joinSub(function ($query) {
                $query->selectRaw('COUNT(bookings.id) as total, bookings.hotel_id')
                    ->from('bookings')
                    ->groupBy('bookings.hotel_id');
            }, 'total_count', function ($join) {
                $join->on('bookings.hotel_id', '=', 'total_count.hotel_id');
            })
            ->where('bookings_statuses.status', BookingStatusEnum::REJECTED)
            ->groupBy('bookings.hotel_id')
            ->get();
    }

    /**
     * Get list of 5 hotels with the smallest number of weekend stays.
     *
     * @return Collection
     */
    public function getHotelsWithLowestWeekendStays(): Collection
    {
        return Booking::query()
            ->select('bookings.hotel_id')
            ->selectRaw('COUNT(*) as weekend_stays')
            ->join('bookings_statuses', 'bookings.id', '=', 'bookings_statuses.booking_id')
            ->where('bookings_statuses.status', BookingStatusEnum::APPROVED)
            ->where(function($query) {
                $query->whereBetween(DB::raw('DAYOFWEEK(arrival_date)'), [6, 7]);
            })
            ->groupBy('bookings.hotel_id')
            ->orderBy('weekend_stays')
            ->limit(5)
            ->get();
    }

    /**
     * Get week with the biggest profit.
     *
     * @return Collection
     */
    public function getWeekWithBiggestProfit(): Collection
    {
        return Booking::query()
            ->select(DB::raw('WEEK(purchase_day) as week_number, YEAR(purchase_day) as year'),
                DB::raw('SUM(sales_price - purchase_price) as total_profit'))
            ->join('bookings_statuses', 'bookings.id', '=', 'bookings_statuses.booking_id')
            ->where('bookings_statuses.status', BookingStatusEnum::APPROVED)
            ->groupBy('week_number')
            ->orderByDesc('total_profit')
            ->limit(1)
            ->get()
            ->map(function ($query) {
                return (object) [
                    'start_week' => Carbon::create($query->year)->addWeeks($query->week_number)->startOfWeek()->format('d.m.Y'),
                    'end_week' => Carbon::create($query->year)->addWeeks($query->week_number)->endOfWeek()->format('d.m.Y'),
                    'total_profit' => $query->total_profit,
                ];
            });
    }
}
