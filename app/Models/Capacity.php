<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Capacity extends Model
{
    use HasFactory;

    protected $table = 'capacity';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'date',
        'capacity'
    ];

    /**
     * @return BelongsTo
     */
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}
