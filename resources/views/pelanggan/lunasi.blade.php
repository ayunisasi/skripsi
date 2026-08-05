<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lunasi Pembayaran - Sri Salon</title>

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
            align-items: center;
            justify-content: center;

            padding: 20px;
        }

        .card {
            border: 1px solid #e6d9ff;
            border-radius: 20px;

            box-shadow: 0 8px 25px rgba(109, 40, 217, 0.08);

            max-width: 500px;
            width: 100%;
            margin: auto;

            background: #fff;
        }

        .btn-gold {
            background: linear-gradient(135deg, #7c3aed, #6d28d9);
            color: #fff;

            border: none;
            border-radius: 12px;

            padding: 12px;
            font-weight: 600;

            width: 100%;
            transition: .2s;
        }

        .btn-gold:hover {
            background: linear-gradient(135deg, #6d28d9, #5b21b6);
            color: #fff;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 0.88rem;
        }

        .box {
            background: var(--gl);
            border-radius: 12px;
            padding: 14px;
            margin-bottom: 16px;

            border: 1px solid #e6d9ff;
        }

        .total {
            border-top: 2px dashed #e6d7a6;
            padding-top: 10px;
            margin-top: 10px;
        }

        .summary-row.total span:last-child {
            color: var(--gold);
            font-size: 0.95rem;
            font-weight: 700;
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <div class="card p-4">

        <div class="text-center mb-4">
            <div style="font-size:2.5rem">💳</div>
            <h5 class="fw-bold" style="color:var(--gd)">Lunasi Pembayaran</h5>
            <small class="text-muted">Sisa tagihan booking kamu</small>
        </div>

        <div class="box">

            <div class="summary-row">
                <span class="text-muted">Kode Booking</span>
                <span class="fw-semibold font-monospace">{{ $booking->kd_booking }}</span>
            </div>

            <div class="summary-row">
                <span class="text-muted">Total Tagihan</span>
                <span>Rp {{ number_format($booking->total_bayar ?? $booking->total_harga, 0, ',', '.') }}</span>
            </div>

            <div class="summary-row">
                <span class="text-muted">Sudah Dibayar (DP)</span>
                <span class="text-success fw-semibold">
                    Rp {{ number_format($booking->jumlah_dibayar, 0, ',', '.') }}
                </span>
            </div>

            <div class="summary-row total">
                <span class="fw-bold">Sisa yang Harus Dibayar</span>
                <span class="fw-bold" style="color:var(--gold); font-size:1.1rem">
                    Rp {{ number_format($sisaBayar, 0, ',', '.') }}
                </span>
            </div>

        </div>

        <button id="btnLunasi" class="btn-gold mb-3">
            Bayar Rp {{ number_format($sisaBayar, 0, ',', '.') }}
        </button>

        <div class="text-center">
            <a href="/booking/riwayat" style="color:var(--gd); font-size:0.82rem">
                ← Kembali ke riwayat
            </a>
        </div>

    </div>

    <script src="{{ config('services.midtrans.is_production')
    ? 'https://app.midtrans.com/snap/snap.js'
    : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ config('services.midtrans.client_key') }}">
        </script>

    <script>
        document.getElementById('btnLunasi').onclick = function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function () {
                    window.location.href = '/booking/antrian/{{ $booking->kd_booking }}';
                },
                onPending: function () {
                    alert('Menunggu konfirmasi pembayaran...');
                },
                onError: function () {
                    alert('Pembayaran gagal. Silakan coba lagi.');
                }
            });
        };
    </script>

</body>

</html>