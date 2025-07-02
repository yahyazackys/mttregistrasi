<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
     protected $fillable = ['user_id', 'name', 'address', 'city', 'map_embed', 'category', 'total_rooms', 'facilities', 'photo'];

    protected $casts = [
        'facilities' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
