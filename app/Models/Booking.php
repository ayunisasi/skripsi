<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = [
        'kd_booking', 'user_id', 'terapis_id',
        'tgl_booking', 'nomor_antrian',
        'estimasi_jam', 'jam_mulai', 'jam_selesai',
        'total_harga', 'total_durasi',
        'jenis_pembayaran', 'status_pembayaran',
        'jumlah_dibayar', 'midtrans_order_id', 'snap_token',
        'status', 'status_kehadiran',
        'alasan_batal', 'dibatalkan_at', 'checkin_at',
    ];

    protected $casts = [
        'dibatalkan_at' => 'datetime',
        'checkin_at'    => 'datetime',
    ];

    // Relasi
    public function user()            { return $this->belongsTo(User::class); }
    public function terapis()         { return $this->belongsTo(Terapis::class); }
    public function layanan()         { return $this->belongsToMany(Layanan::class, 'booking_layanan'); }
    public function antrian()         { return $this->hasOne(Antrian::class); }
    public function pembayaran()      { return $this->hasMany(Pembayaran::class); }
    public function produkTambahan()  { return $this->hasMany(ProdukTambahan::class); }
    public function review()          { return $this->hasOne(Review::class); }

    // Helper methods
    public function jumlahDP()
    {
        return (int) round($this->total_harga * 0.30);
    }

    public function sisaBayar()
    {
        return $this->total_harga - $this->jumlah_dibayar;
    }



    public function bisaDibatalkan()
    {
        if (!in_array($this->status, ['aktif', 'menunggu_pembayaran'])) {
            return false;
        }
        $batas = Carbon::parse($this->tgl_booking)->subDay()->endOfDay();
        return Carbon::now()->lte($batas);
    }
}
