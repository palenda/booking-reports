<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\View\View;

class ReportsController extends Controller
{
    public function __construct(
        protected readonly BookingRepositoryInterface $bookingRepository,
        protected readonly CustomerRepositoryInterface $customerRepository
    ) {}

    public function index(): View
    {
        return view('welcome',
            [
                'rejects' => $this->bookingRepository->getAvgBookingRejectionRatePerHotel(),
                'minStays' => $this->bookingRepository->getHotelsWithLowestWeekendStays(),
                'profits' => $this->bookingRepository->getWeekWithBiggestProfit(),
                'unluckyCustomers' => $this->customerRepository->getUnluckyCustomers(),
            ]
        );
    }
}
