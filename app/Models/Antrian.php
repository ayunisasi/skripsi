<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $table = 'antrian';
    protected $fillable = [
        'booking_id', 'terapis_id', 'tgl_antrian',
        'nomor_antrian', 'estimasi_jam_mulai',
        'estimasi_jam_selesai', 'total_durasi', 'status',
    ];

    public function booking() { return $this->belongsTo(Booking::class); }
    public function terapis() { return $this->belongsTo(Terapis::class); }
}
