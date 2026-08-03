<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan';
    protected $fillable = [
    'nama_layanan',
    'harga',
    'durasi',

    'gambar',
    'deskripsi_singkat',
    'landing',
    'urutan'
];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_layanan');
    }
}
