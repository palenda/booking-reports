<?php

namespace Database\Seeders;

use App\Models\Capacity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CapacitySeeder extends Seeder
{
    public function run(): void
    {
        // Parse capacities from CSV file
        $csvFile = fopen(storage_path("app/data/capacity.csv"), "r");
        $firstLine = true;

        DB::beginTransaction();
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstLine) {
                $hotelId = $data[0];
                $date = $data[1];
                $capacity = $data[2];

                $existingCapacity = Capacity::where('hotel_id', $hotelId)
                    ->where('date', $date)
                    ->first();

                if ($existingCapacity) {
                    $existingCapacity->capacity = max($existingCapacity->capacity, $capacity);
                    $existingCapacity->save();
                } else {
                    Capacity::create([
                        "hotel_id" => $hotelId,
                        "date" => $date,
                        "capacity" => $capacity
                    ]);
                }
            }
            $firstLine = false;
        }
        DB::commit();

        fclose($csvFile);
    }
}
