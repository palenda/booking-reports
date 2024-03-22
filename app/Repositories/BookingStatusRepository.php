<?php

namespace App\Repositories;

use App\Models\BookingStatus;
use App\Repositories\Interfaces\BookingStatusRepositoryInterface;

class BookingStatusRepository implements BookingStatusRepositoryInterface
{
    /**
     * @param int $bookingId
     * @param string $bookingStatus
     * @return void
     */
    public function setBookingStatus(int $bookingId, string $bookingStatus): void
    {
        BookingStatus::query()
            ->insert([
                'booking_id' => $bookingId,
                'status' => $bookingStatus
            ]);
    }
}
