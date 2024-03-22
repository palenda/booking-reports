<?php

use App\Enums\BookingStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->enum('status', BookingStatusEnum::getValues());

            $table->foreign('booking_id')
                ->references('id')
                ->on('bookings')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings_statuses');
    }
};
