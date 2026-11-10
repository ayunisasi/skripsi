<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KetidakhadiranTerapis extends Model
{
    protected $table = 'ketidakhadiran_terapis';

    protected $fillable = [
        'terapis_id',
        'tanggal',
        'alasan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function terapis()
    {
        return $this->belongsTo(Terapis::class);
    }
}
