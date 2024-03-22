<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        // Parse bookings from CSV file
        $csvFile = fopen(storage_path("data/bookings.csv"), "r");
        $firstLine = true;

        DB::beginTransaction();
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstLine) {
                Booking::create([
                    "hotel_id" => $data['1'],
                    "customer_id" => $data['2'],
                    "sales_price" => $data['3'],
                    "purchase_price" => $data['4'],
                    "arrival_date" => $data['5'],
                    "purchase_day" => $data['6'],
                    "nights" => $data['7'],
                ]);
            }
            $firstLine = false;
        }
        DB::commit();

        fclose($csvFile);
    }
}
