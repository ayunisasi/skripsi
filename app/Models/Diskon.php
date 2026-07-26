<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    protected $fillable = [
        'nama_diskon',
        'jenis',
        'tipe_potongan',
        'nilai',
        'minimal_transaksi',
        'minimal_kunjungan',
        'tanggal_mulai',
        'tanggal_selesai',
        'status'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'status' => 'boolean'
    ];

}
