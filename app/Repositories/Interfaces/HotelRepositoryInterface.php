<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface HotelRepositoryInterface
{
    public function getHotels(): Collection;
}
