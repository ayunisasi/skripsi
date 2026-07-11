<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Sri Salon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --gd: #6d28d9;
            --gm: #8b5cf6;
            --gold: #c9a84c;
            --gold-l: #f5edd0;
            --cream: #faf7f0;
            --gl: #f3e8ff;
        }

        body {
            background: var(--cream);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .card {
            border: 1px solid #e6d9ff;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(109, 40, 217, 0.08);
            width: 100%;
            max-width: 500px;
            margin: auto;
            background: #fff;
        }

        .btn-pink {
            background: linear-gradient(135deg, #7c3aed, #6d28d9);
            color: #fff;
            border: none;
            font-weight: 600;
            padding: 10px 14px;
            border-radius: 12px;
            width: 100%;
            transition: .2s;
        }

        .btn-pink:hover {
            background: linear-gradient(135deg, #6d28d9, #5b21b6);
            color: #fff;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 0.88rem;
        }

        .total-row {
            border-top: 2px dashed #e6d9ff;
            padding-top: 10px;
            margin-top: 10px;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="card p-4">
        <div class="text-center mb-4">
            <div style="font-size:2.5rem">💳</div>
            <h5 class="fw-bold" style="color: black">Pembayaran</h5>
            <small class="text-muted">Sri Salon Sindang</small>
        </div>

        {{-- Info Booking --}}
        <div
            style="background:var(--gl); border-radius:12px; padding:14px; margin-bottom:16px; border:1px solid #e6d9ff;">
            <div class="summary-row">
                <span class="text-muted">Kode Booking</span>
                <span class="fw-semibold font-monospace">{{ $booking->kd_booking }}</span>
            </div>
            <div class="summary-row">
                <span class="text-muted">Layanan</span>
                <span class="fw-semibold">{{ $booking->layanan->pluck('nama_layanan')->join(', ') }}</span>
            </div>
            <div class="summary-row">
                <span class="text-muted">Terapis</span>
                <span>{{ $booking->terapis->nama_terapis }}</span>
            </div>
            <div class="summary-row">
                <span class="text-muted">No. Antrian</span>
                <strong style="color:var(--gd); font-size:1.1rem">{{ $booking->nomor_antrian }}</strong>
            </div>
            <div class="summary-row">
                <span class="text-muted">Estimasi Dilayani</span>
                <span>{{ $booking->estimasi_jam }}</span>
            </div>
            <div class="summary-row total-row">
                <span class="fw-bold">
                    {{ $booking->jenis_pembayaran === 'dp' ? 'Bayar DP (30%)' : 'Full Payment' }}
                </span>
                <span class="fw-bold" style="color:var(--gold); font-size:1.05rem">
                    Rp {{ number_format($jumlahBayar, 0, ',', '.') }}
                </span>
            </div>
            @if($booking->jenis_pembayaran === 'dp')
                <div class="summary-row" style="font-size:0.8rem">
                    <span class="text-muted">Sisa bayar di salon</span>
                    <span>Rp {{ number_format($booking->total_harga - $jumlahBayar, 0, ',', '.') }}</span>
                </div>
            @endif
        </div>

        <button id="btnBayar" class="btn-pink mb-3">
            <i class="bi bi-credit-card me-2"></i> Bayar Sekarang
        </button>

        {{-- <div class="text-center">
            <a href="/booking/riwayat" style="color:var(--gd); font-size:0.82rem">
                Bayar nanti →
            </a>
        </div> --}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script
        src="{{ config('services.midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script>
        document.getElementById('btnBayar').onclick = function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function (result) {
                    window.location.href = '/booking/antrian/{{ $booking->kd_booking }}';
                },
                onPending: function (result) {
                    alert('Pembayaran pending. Selesaikan pembayaranmu!');
                },
                onError: function (result) {
                    alert('Pembayaran gagal. Silakan coba lagi.');
                },
                onClose: function () {
                    console.log('Pop-up ditutup');
                }
            });
        };
    </script>
</body>

</html>