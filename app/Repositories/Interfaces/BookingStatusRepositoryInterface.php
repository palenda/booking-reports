<?php

namespace App\Repositories\Interfaces;

interface BookingStatusRepositoryInterface
{
    public function setBookingStatus(int $bookingId, string $bookingStatus): void;
}
