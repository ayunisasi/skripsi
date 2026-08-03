<?php

namespace App\Services;

use App\Models\Diskon;
use Carbon\Carbon;

class PromoService
{
    public static function cekPromo($user, $totalHarga)
{
    $today = Carbon::today();

    $promos = Diskon::where('status', true)->get();

    $promoTerbaik = null;

    foreach ($promos as $promo) {

        $valid = false;

        // =====================
        // Promo Event
        // =====================
        if (
            $promo->jenis == 'event' &&
            $promo->tanggal_mulai &&
            $promo->tanggal_selesai &&
            $today->between($promo->tanggal_mulai, $promo->tanggal_selesai)
        ) {
            $valid = true;
        }

        // =====================
        // Promo Diskon
        // =====================
        if (
            $promo->jenis == 'diskon' &&
            $promo->minimal_transaksi &&
            $totalHarga >= $promo->minimal_transaksi
        ) {
            $valid = true;
        }

        // =====================
        // Promo Langganan
        // =====================
        if (
            $promo->jenis == 'langganan' &&
            $user->jumlah_kunjungan >= $promo->minimal_kunjungan
        ) {
            $valid = true;
        }

        if ($valid) {

            $hasil = self::hitungPotongan($promo, $totalHarga);

            if (
                !$promoTerbaik ||
                $hasil['potongan'] > $promoTerbaik['potongan']
            ) {

                $promoTerbaik = $hasil;

            }

        }

    }

    return $promoTerbaik;
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
