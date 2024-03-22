<?php

namespace App\Repositories;

use App\Models\Hotel;
use App\Repositories\Interfaces\HotelRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class HotelRepository implements HotelRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getHotels(): Collection
    {
        return Hotel::all();
    }
}
