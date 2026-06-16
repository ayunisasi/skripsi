<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'nama_lengkap', 'username', 'email',
        'password', 'no_telp', 'role'
    ];
    protected $hidden = ['password', 'remember_token'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
