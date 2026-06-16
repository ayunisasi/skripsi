<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProdukTambahan extends Model
{
    protected $table = 'produk_tambahan';
    protected $fillable = [
        'booking_id', 'nama_item', 'harga', 'tipe', 'catatan'
    ];

    public function booking() { return $this->belongsTo(Booking::class); }
}
