<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Terapis extends Model
{
    protected $table = 'terapis';
    protected $fillable = ['nama_terapis', 'status'];

    public function bookings() { return $this->hasMany(Booking::class); }
    public function antrian()  { return $this->hasMany(Antrian::class); }
    public function reviews()  { return $this->hasMany(Review::class); }
}
