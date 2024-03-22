<?php

namespace App\Repositories;

use App\Models\Capacity;
use App\Repositories\Interfaces\CapacityRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CapacityRepository implements CapacityRepositoryInterface
{
    /**
     * @param int $hotelId
     * @param string $startDate
     * @param string $endDate
     * @return Collection
     */
    public function getCapacityByHotelIdAndDatePeriod(int $hotelId, string $startDate, string $endDate): Collection
    {
        return Capacity::query()
            ->where('hotel_id', $hotelId)
            ->whereBetween('date', [$startDate, $endDate])
            ->where('capacity', '>', 0)
            ->get();
    }

    /**
     * @param int $id
     * @param int $capacity
     * @return void
     */
    public function updateCapacity(int $id, int $capacity): void
    {
        Capacity::query()
            ->where('id', $id)
            ->update(['capacity' => $capacity]);
    }
}
