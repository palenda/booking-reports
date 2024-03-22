<?php

namespace App\Providers;

use App\Repositories\BookingRepository;
use App\Repositories\BookingStatusRepository;
use App\Repositories\CapacityRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\HotelRepository;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Interfaces\BookingStatusRepositoryInterface;
use App\Repositories\Interfaces\CapacityRepositoryInterface;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Repositories\Interfaces\HotelRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        BookingRepositoryInterface::class => BookingRepository::class,
        CapacityRepositoryInterface::class => CapacityRepository::class,
        HotelRepositoryInterface::class => HotelRepository::class,
        BookingStatusRepositoryInterface::class => BookingStatusRepository::class,
        CustomerRepositoryInterface::class => CustomerRepository::class,
    ];
}
