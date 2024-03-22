<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface BookingRepositoryInterface
{
    public function getBookingsByHotelId(int $id): Collection;

    public function getAvgBookingRejectionRatePerHotel(): Collection;

    public function getHotelsWithLowestWeekendStays(): Collection;

    public function getWeekWithBiggestProfit(): Collection;
}
