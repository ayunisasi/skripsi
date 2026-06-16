<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan';
    protected $fillable = ['nama_layanan', 'harga', 'durasi'];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_layanan');
    }
}
