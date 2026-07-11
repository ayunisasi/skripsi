<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Antrian;
use Carbon\Carbon;

class CheckExpiredQueue extends Command
{
    protected $signature = 'queue:check-expired';

    protected $description = 'Membatalkan antrean yang dipanggil lebih dari 15 menit';

    public function handle()
    {
        $expiredQueues = Antrian::with('booking')
            ->where('status', 'dipanggil')
            ->where('called_at', '<=', Carbon::now()->subMinutes(15))
            ->get();

        foreach ($expiredQueues as $antrian) {

            $antrian->update([
                'status' => 'dibatalkan'
            ]);

            if ($antrian->booking) {
                $antrian->booking->update([
                    'status'           => 'dibatalkan_sistem',
                    'status_kehadiran' => 'tidak_hadir',
                    'alasan_batal'     => 'Otomatis dibatalkan karena tidak hadir dalam 15 menit.',
                    'dibatalkan_at'    => now(),
                ]);
            }

            $this->info("Antrian {$antrian->nomor_antrian} dibatalkan.");
        }

        return self::SUCCESS;
    }
}
