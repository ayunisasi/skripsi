<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $fillable = [
        'booking_id', 'kd_pembayaran', 'jumlah', 'tipe',
        'metode', 'status', 'midtrans_order_id',
        'snap_token', 'tgl_bayar', 'catatan',
    ];
    protected $casts = ['tgl_bayar' => 'datetime'];

    public function booking() { return $this->belongsTo(Booking::class); }
}
