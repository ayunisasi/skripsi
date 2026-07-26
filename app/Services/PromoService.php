<?php

namespace App\Services;

use App\Models\Diskon;
use Carbon\Carbon;

class PromoService
{
    public static function cekPromo($user, $totalHarga)
    {
        $today = Carbon::today();

        // Cari semua promo aktif
        $promos = Diskon::where('status', true)->get();

        foreach ($promos as $promo) {

            // =====================
            // Promo Event
            // =====================
            if (
                $promo->jenis == 'event' &&
                $promo->tanggal_mulai &&
                $promo->tanggal_selesai &&
                $today->between($promo->tanggal_mulai, $promo->tanggal_selesai)
            ) {
                return self::hitungPotongan($promo, $totalHarga);
            }

            // =====================
            // Promo Diskon
            // =====================
if (
    $promo->jenis == 'diskon' &&
    $totalHarga >= $promo->minimal_transaksi
) {
    return self::hitungPotongan($promo, $totalHarga);
} {
                return self::hitungPotongan($promo, $totalHarga);
            }

            // =====================
            // Promo Langganan
            // =====================
            if (
                $promo->jenis == 'langganan' &&
                $user->jumlah_kunjungan >= $promo->minimal_kunjungan
            ) {
                return self::hitungPotongan($promo, $totalHarga);
            }
        }

        return null;
    }

    private static function hitungPotongan($promo, $totalHarga)
    {
        if ($promo->tipe_potongan == 'persen') {

            $potongan = ($promo->nilai / 100) * $totalHarga;

        } else {

            $potongan = $promo->nilai;

        }

        return [
            'id' => $promo->id,
            'nama' => $promo->nama_diskon,
            'potongan' => $potongan
        ];
    }
}
