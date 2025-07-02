<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail; // ⬅️ tambahkan ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail // ⬅️ tambahkan implements
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'pic_name',
        'phone',
        'terms_agreed',
        'status',
        'document_file'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function hotel()
    {
        return $this->hasOne(Hotel::class);
    }

    public function isAdmin() {
        return $this->role === 'admin';
    }

    public function isVendor() {
        return $this->role === 'vendor';
    }
}
