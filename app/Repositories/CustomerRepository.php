<?php

namespace App\Repositories;

use App\Enums\BookingStatusEnum;
use App\Models\Customer;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CustomerRepository implements CustomerRepositoryInterface
{
    /**
     * Get list of 5 most unlucky customers.
     *
     * @return Collection
     */
    public function getUnluckyCustomers(): Collection
    {
        return Customer::query()
            ->select('customers.id', 'customers.name', DB::raw('COUNT(bookings_statuses.booking_id) as rejection_count'))
            ->leftJoin('bookings', 'customers.id', '=', 'bookings.customer_id')
            ->leftJoin('bookings_statuses', 'bookings.id', '=', 'bookings_statuses.booking_id')
            ->where('bookings_statuses.status', BookingStatusEnum::REJECTED->value)
            ->groupBy('customers.id', 'customers.name')
            ->orderByDesc('rejection_count')
            ->orderBy('customers.id')
            ->limit(5)
            ->get();
    }
}
