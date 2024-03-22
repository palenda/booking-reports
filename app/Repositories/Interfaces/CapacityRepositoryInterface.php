<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface CapacityRepositoryInterface
{
    public function getCapacityByHotelIdAndDatePeriod(int $hotelId, string $startDate, string $endDate): Collection;

    public function updateCapacity(int $id, int $capacity): void;
}
