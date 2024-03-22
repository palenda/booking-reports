<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hotels';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    /**
     * @return HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * @return HasMany
     */
    public function capacities(): HasMany
    {
        return $this->hasMany(Capacity::class);
    }
}
