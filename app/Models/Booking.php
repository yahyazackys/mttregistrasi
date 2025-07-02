<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
    'user_id',
    'hotel_id',
    'room_id',
    'tanggal_checkin',
    'tanggal_checkout',
    'jumlah_kamar',
    'total_harga',
];

public function hotel()
{
    return $this->belongsTo(Hotel::class);
}

public function room()
{
    return $this->belongsTo(Room::class);
}

}
