<?php
namespace App\Services;

use App\Models\Antrian;
use App\Models\Booking;
use Carbon\Carbon;

class AntrianService
{
    // Assign nomor antrian FCFS ke booking
    public function assignAntrian(Booking $booking): Antrian
    {
        $tgl       = $booking->tgl_booking;
        $terapisId = $booking->terapis_id;
        $durasi    = $booking->total_durasi;

        // Ambil antrian terakhir yang aktif
        $lastAktif = Antrian::where('terapis_id', $terapisId)
            ->where('tgl_antrian', $tgl)
            ->whereNotIn('status', ['dibatalkan'])
            ->orderBy('nomor_antrian', 'desc')
            ->first();

        $nomorBaru = $lastAktif ? $lastAktif->nomor_antrian + 1 : 1;

        // Jam mulai: setelah terakhir selesai atau jam buka
        $jamBuka = Carbon::parse('09:00');

$sekarang = Carbon::now();

if ($lastAktif) {

    $lastSelesai = Carbon::parse(
        $tgl . ' ' . $lastAktif->estimasi_jam_selesai
    );

    // Kalau antrean terakhir masih berlangsung
    if ($lastSelesai->gt($sekarang)) {

        $jamMulai = $lastSelesai->copy();

    } else {

        // Antrean sudah kosong
        if (Carbon::parse($tgl)->isToday()) {

            if ($sekarang->lt($jamBuka)) {
                $jamMulai = $jamBuka->copy();
            } else {
                $jamMulai = $sekarang->copy()->addMinutes(10);
            }

        } else {

            $jamMulai = $jamBuka->copy();

        }

    }

} else {

    if (Carbon::parse($tgl)->isToday()) {

        if ($sekarang->lt($jamBuka)) {
            $jamMulai = $jamBuka->copy();
        } else {
            $jamMulai = $sekarang->copy()->addMinutes(10);
        }

    } else {

        $jamMulai = $jamBuka->copy();

    }

}

        $jamSelesai = $jamMulai->copy()->addMinutes($durasi);

        // Batasi jam tutup salon
        $jamTutup = Carbon::parse($tgl . ' 18:00');
        if ($jamSelesai->gt($jamTutup)) {
            throw new \Exception('Terapis yang dipilih sudah penuh. Silahkan pilih terapis lainnya');
        }

        $antrian = Antrian::create([
            'booking_id'           => $booking->id,
            'terapis_id'           => $terapisId,
            'tgl_antrian'          => $tgl,
            'nomor_antrian'        => $nomorBaru,
            'estimasi_jam_mulai'   => $jamMulai->format('H:i'),
            'estimasi_jam_selesai' => $jamSelesai->format('H:i'),
            'total_durasi'         => $durasi,
            'status'               => 'menunggu',
        ]);

        $booking->update([
            'nomor_antrian' => $nomorBaru,
            'estimasi_jam'  => $jamMulai->format('H:i'),
            'jam_mulai'     => $jamMulai->format('H:i'),
            'jam_selesai'   => $jamSelesai->format('H:i'),
        ]);

        return $antrian;
    }

    // Cek ketersediaan terapis hari ini
    public function cekKetersediaan(string $tgl, int $terapisId, int $durasi): array
    {
        $jumlahAktif = Antrian::where('terapis_id', $terapisId)
            ->where('tgl_antrian', $tgl)
            ->whereNotIn('status', ['dibatalkan'])
            ->count();

        if ($jumlahAktif >= 5) {
            return [
                'tersedia' => false,
                'pesan' => 'Terapis yang dipilih sudah penuh. Silahkan pilih terapis lainnya',
            ];
        }

        $last = Antrian::where('terapis_id', $terapisId)
            ->where('tgl_antrian', $tgl)
            ->whereNotIn('status', ['dibatalkan'])
            ->orderBy('nomor_antrian', 'desc')
            ->first();

        $jamBuka = Carbon::parse('09:00');
$sekarang = Carbon::now();

if ($last) {

    $lastSelesai = Carbon::parse(
        $tgl . ' ' . $last->estimasi_jam_selesai
    );

    // Jika antrean terakhir masih berlangsung
    if ($lastSelesai->gt($sekarang)) {

        $jamMulai = $lastSelesai->copy();

    } else {

        // Antrean sudah kosong
        if (Carbon::parse($tgl)->isToday()) {

            if ($sekarang->lt($jamBuka)) {
                $jamMulai = $jamBuka->copy();
            } else {
                $jamMulai = $sekarang->copy()->addMinutes(10);
            }

        } else {

            $jamMulai = $jamBuka->copy();

        }

    }

} else {

    if (Carbon::parse($tgl)->isToday()) {

        if ($sekarang->lt($jamBuka)) {
            $jamMulai = $jamBuka->copy();
        } else {
            $jamMulai = $sekarang->copy()->addMinutes(10);
        }

    } else {

        $jamMulai = $jamBuka->copy();

    }

}

        $jamSelesai = $jamMulai->copy()->addMinutes($durasi);

        // Batasi jam tutup
        $jamTutup = Carbon::parse($tgl . ' 18:00');
if ($jamSelesai->gt($jamTutup)) {
    return [
        'tersedia' => false,
        'pesan' => 'Terapis yang dipilih sudah penuh. Silahkan pilih terapis lainnya'
    ];
}

        return [
            'tersedia' => true,
            'estimasi_mulai' => $jamMulai->format('H:i'),
            'estimasi_selesai' => $jamSelesai->format('H:i'),
            'nomor_antrian' => $last ? $last->nomor_antrian + 1 : 1,
        ];
    }

    // Recalculate jam setelah ada perubahan
    public function recalculate(string $tgl, int $terapisId): void
    {
        $antrians = Antrian::where('terapis_id', $terapisId)
            ->where('tgl_antrian', $tgl)
            ->whereNotIn('status', ['dibatalkan', 'selesai'])
            ->orderBy('nomor_antrian')
            ->get();

        $jam = Carbon::parse('09:00'); // jam buka

        foreach ($antrians as $a) {
            if ($a->status === 'dilayani') {
                $jam = Carbon::parse($a->estimasi_jam_selesai);
                continue;
            }

            $selesai = $jam->copy()->addMinutes($a->total_durasi);

            $a->update([
                'estimasi_jam_mulai'   => $jam->format('H:i'),
                'estimasi_jam_selesai' => $selesai->format('H:i'),
            ]);

            $a->booking->update([
                'estimasi_jam' => $jam->format('H:i'),
                'jam_mulai'    => $jam->format('H:i'),
                'jam_selesai'  => $selesai->format('H:i'),
            ]);

            $jam = $selesai;
        }
    }

    public function cekKonflikTambahan(Booking $booking, int $durasiTambahan): array
{
    $antrian = $booking->antrian;
    if (!$antrian) {
        return ['konflik' => false, 'jam_selesai_baru' => null];
    }

    $jamMulai = Carbon::parse($antrian->estimasi_jam_selesai);
    $jamSelesaiBaru = $jamMulai->copy()->addMinutes($durasiTambahan);

    $jamTutup = Carbon::parse($booking->tgl_booking . ' 18:00');// jam tutup salon
    if ($jamSelesaiBaru->gt($jamTutup)) {
        return [
            'konflik' => true,
            'pesan' => "Penambahan layanan melebihi jam tutup ({$jamTutup->format('H:i')}).",
        ];
    }

    // Cek apakah bentrok dengan antrian berikutnya
    $berikutnya = Antrian::where('terapis_id', $booking->terapis_id)
        ->where('tgl_antrian', $booking->tgl_booking)
        ->where('nomor_antrian', '>', $antrian->nomor_antrian)
        ->whereNotIn('status', ['dibatalkan'])
        ->orderBy('nomor_antrian')
        ->first();

    if ($berikutnya) {
        $jamMulaiBerikutnya = Carbon::parse($berikutnya->estimasi_jam_mulai);
        if ($jamSelesaiBaru->gt($jamMulaiBerikutnya)) {
            return [
                'konflik' => true,
                'pesan' => "Penambahan layanan akan bentrok dengan antrian berikutnya (#{$berikutnya->nomor_antrian}).",
            ];
        }
    }

    return [
        'konflik' => false,
        'jam_selesai_baru' => $jamSelesaiBaru->format('H:i'),
    ];
}

    public static function getTanggalTersedia(): array
    {
        $result = [];
        $today = Carbon::today();

if (Carbon::now()->hour >= 18) {
    $today->addDay();
}
        $count  = 0;
        $i      = 0;

        while ($count < 6) {
            $tgl = $today->copy()->addDays($i++);
            if ($tgl->dayOfWeek === Carbon::SUNDAY) continue;
            $result[] = [
                'value'    => $tgl->format('Y-m-d'),
                'label'    => $tgl->isoFormat('dddd, D MMMM Y'),
                'is_today' => $tgl->isToday(),
            ];
            $count++;
        }

        return $result;
    }
}
