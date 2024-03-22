<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface CustomerRepositoryInterface
{
    public function getUnluckyCustomers() : Collection;
}
