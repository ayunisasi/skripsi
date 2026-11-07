<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'nama_lengkap', 'username', 'email',
        'password', 'no_telp', 'foto_profil', 'role'
    ];
    protected $hidden = ['password', 'remember_token'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
