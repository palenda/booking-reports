<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingStatus extends Model
{
    use HasFactory;

    protected $table = 'bookings_statuses';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'booking_id',
        'status'
    ];

    /** @var string[] */
    protected $casts = [
        'status' => BookingStatus::class,
    ];

    /**
     * @return BelongsTo
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
