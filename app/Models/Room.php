<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'hotel_id', 'name', 'size', 'facilities', 'units',
        'photo', 'publish_rate', 'corporate_rate', 'start_date', 'end_date', 'blackout_dates'
    ];

    protected $casts = [
        'facilities' => 'array',
        'blackout_dates' => 'array',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
