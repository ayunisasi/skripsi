<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian Saya - Sri Salon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --gd: #1a3a2a;
            --gm: #2d5a3d;
            --gold: #c9a84c;
            --gold-l: #f5edd0;
            --cream: #faf7f0;
            --gl: #e8f5ee
        }

        body {
            padding-top: 80px;
            background: var(--cream);
            font-family: 'Poppins', sans-serif
        }

        .navbar-top {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;

            background: var(--gd);
            padding: 14px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
        }

        .brand-name {
            color: var(--gold);
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.1rem
        }

        .brand-sub {
            color: rgba(255, 255, 255, 0.45);
            font-size: 0.62rem;
            letter-spacing: 1.5px
        }

        .nav-btn {
            border: 1.5px solid var(--gold);
            color: var(--gold);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            text-decoration: none;
            transition: all .2s
        }

        .nav-btn:hover {
            background: var(--gold);
            color: var(--gd)
        }

        .card {
            border: 1px solid rgba(201, 168, 76, 0.2);
            border-radius: 18px;
            background: white;
            box-shadow: 0 4px 20px rgba(26, 58, 42, 0.07);
            margin-bottom: 16px;
            overflow: hidden
        }

        .card-body {
            padding: 20px
        }

        /* HERO ANTRIAN */
        .antrian-hero {
            background: linear-gradient(135deg, var(--gd) 0%, var(--gm) 70%, #3d7a52 100%);
            border-radius: 18px;
            padding: 30px 24px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
            margin-bottom: 16px;
        }

        .antrian-hero::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(201, 168, 76, 0.1);
        }

        .antrian-hero::after {
            content: '';
            position: absolute;
            bottom: -40px;
            left: -40px;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(201, 168, 76, 0.08);
        }

        .hero-label {
            font-size: 0.72rem;
            opacity: .7;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 8px
        }

        .hero-nomor {
            font-size: 4.5rem;
            font-weight: 800;
            color: var(--gold);
            line-height: 1;
            font-family: 'Playfair Display', serif;
            position: relative;
            z-index: 1
        }

        .hero-sub {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.75);
            margin-top: 6px;
            position: relative;
            z-index: 1
        }

        .status-pill {
            display: inline-block;
            padding: 6px 22px;
            border-radius: 25px;
            font-size: 0.82rem;
            font-weight: 600;
            margin-top: 14px;
            background: rgba(201, 168, 76, 0.2);
            color: var(--gold);
            border: 1px solid rgba(201, 168, 76, 0.35);
            position: relative;
            z-index: 1;
        }

        .pulse {
            animation: pulse 2s infinite
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: .5
            }
        }

        /* INFO GRID */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 16px
        }

        .info-box {
            background: white;
            border: 1px solid rgba(201, 168, 76, 0.2);
            border-radius: 14px;
            padding: 16px;
            text-align: center;
        }

        .info-box.gold-bg {
            background: var(--gold-l);
            border-color: rgba(201, 168, 76, 0.4)
        }

        .info-box.green-bg {
            background: var(--gl);
            border-color: rgba(26, 58, 42, 0.15)
        }

        .info-val {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--gd);
            line-height: 1.1
        }

        .info-val.gold {
            color: var(--gold)
        }

        .info-lbl {
            font-size: 0.72rem;
            color: #9a7b82;
            margin-top: 5px;
            font-weight: 500
        }

        /* COUNTDOWN */
        .countdown-box {
            background: linear-gradient(135deg, var(--gold), #b8922e);
            border-radius: 16px;
            padding: 18px 20px;
            color: var(--gd);
            text-align: center;
            margin-bottom: 16px;
        }

        .countdown-label {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            opacity: .7;
            margin-bottom: 8px
        }

        .countdown-time {
            font-size: 2.8rem;
            font-weight: 800;
            font-family: 'Playfair Display', serif;
            line-height: 1
        }

        .countdown-sub {
            font-size: 0.78rem;
            margin-top: 5px;
            opacity: .75
        }

        /* SEDANG DILAYANI */
        .now-serving {
            background: var(--gl);
            border-radius: 12px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 12px;
        }

        .now-badge {
            background: var(--gd);
            color: var(--gold);
            border-radius: 8px;
            padding: 4px 10px;
            font-size: 0.72rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .next-alert {
            background: var(--gold-l);
            border: 1.5px solid rgba(201, 168, 76, 0.5);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.84rem;
            margin-top: 12px;
        }

        .next-alert strong {
            color: var(--gd)
        }

        /* DETAIL ROWS */
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.86rem;
            padding: 8px 0;
            border-bottom: 1px solid rgba(201, 168, 76, 0.12);
        }

        .detail-row:last-child {
            border-bottom: none
        }

        .detail-row .lbl {
            color: #9a7b82
        }

        .detail-row .val {
            font-weight: 500;
            color: var(--gd);
            text-align: right;
            max-width: 60%
        }

        .btn-gold {
            background: linear-gradient(135deg, var(--gold), #b8922e);
            color: var(--gd);
            border: none;
            border-radius: 12px;
            padding: 13px;
            font-weight: 700;
            width: 100%;
            font-size: 0.95rem;
            transition: all .3s;
            cursor: pointer;
            display: block;
            text-align: center;
            text-decoration: none;
        }

        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(201, 168, 76, 0.35);
            color: var(--gd)
        }

        .btn-outline {
            display: block;
            text-align: center;
            border: 1.5px solid rgba(26, 58, 42, 0.2);
            color: var(--gd);
            border-radius: 12px;
            padding: 12px;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all .2s;
            margin-top: 10px;
        }

        .btn-outline:hover {
            background: var(--gl);
            color: var(--gd)
        }
    </style>
</head>

<body>

    <nav class="navbar-top">
        <div style="display:flex;align-items:center;gap:10px">
            <div>
                <img src="{{ asset('images/salon.jpg') }}" alt="Logo" width="40" height="40"
                    style="border-radius:50%; object-fit:cover;">
            </div>
            <div class="brand-name">E-Booking Salon</div>
        </div>
        </div>
        <a href="/booking/riwayat" class="nav-btn">
            <i class="bi bi-clock-history"></i> Riwayat
        </a>
    </nav>

    <div class="container py-4" style="max-width:500px">

        @if(session('success'))
            <div class="alert border-0 rounded-3 mb-3"
                style="background:var(--gl);color:var(--gd);border-left:4px solid var(--gd) !important">
                <i class="bi bi-check-circle-fill me-2" style="color:var(--gold)"></i>{{ session('success') }}
            </div>
        @endif

        @if($antrian)

            {{-- HERO NOMOR ANTRIAN --}}
            <div class="antrian-hero">
                <div class="hero-label">Nomor Antrian Kamu</div>
                <div class="hero-nomor">
                    {{ strtoupper(substr($booking->terapis->nama_terapis, 0, 1)) }}{{ sprintf('%02d', $antrian->nomor_antrian) }}
                </div>
                <div class="hero-sub">
                    {{ $booking->terapis->nama_terapis }} •
                    {{ \Carbon\Carbon::parse($booking->tgl_booking)->format('d M Y') }}
                </div>
                @if($antrian->status === 'menunggu')
                    <div class="status-pill">⏳ Menunggu Giliran</div>
                @elseif($antrian->status === 'dilayani')
                    <div class="status-pill pulse"
                        style="background:rgba(255,255,255,0.2);color:white;border-color:rgba(255,255,255,0.3)">
                        ▶ Sedang Dilayani
                    </div>
                @elseif($antrian->status === 'selesai')
                    <div class="status-pill" style="background:rgba(255,255,255,0.15);color:white">✅ Selesai Dilayani</div>
                @endif
            </div>

            {{-- COUNTDOWN REAL-TIME --}}
            @if($antrian->status === 'menunggu' && $antrianDidepan >= 0)
                <div class="countdown-box">
                    <div class="countdown-label">⏱ Estimasi Waktu Tunggu</div>
                    <div class="countdown-time" id="countdown-display">--:--:--</div>

                    <div style="font-size:0.78rem;margin-top:4px;opacity:.7">
                        Estimasi mulai dilayani: <strong>{{ $antrian->estimasi_jam_mulai }}</strong>
                    </div>
                </div>
            @elseif($antrian->status === 'dilayani')
                <div class="countdown-box" style="background:linear-gradient(135deg,var(--gd),var(--gm))">
                    <div class="countdown-label" style="color:rgba(201,168,76,0.8)">⏱ Perkiraan Selesai</div>
                    <div class="countdown-time" style="color:var(--gold)" id="countdown-display">--:--:--</div>
                    <div class="countdown-sub" style="color:rgba(255,255,255,0.65)">Estimasi selesai:
                        {{ $antrian->estimasi_jam_selesai }}
                    </div>
                </div>
            @endif

            {{-- INFO GRID --}}
            <div class="info-grid">
                <div class="info-box gold-bg">
                    <div class="info-val gold">{{ $antrianDidepan }}</div>
                    <div class="info-lbl">Antrian di Depan</div>
                </div>
                <div class="info-box green-bg">
                    <div class="info-val" style="font-size:1.3rem">{{ $antrian->estimasi_jam_mulai }}</div>
                    <div class="info-lbl">Estimasi Dilayani</div>
                </div>
                <div class="info-box">
                    <div class="info-val" style="font-size:1.3rem">{{ $antrian->estimasi_jam_selesai }}</div>
                    <div class="info-lbl">Estimasi Selesai</div>
                </div>
                <div class="info-box gold-bg">
                    <div class="info-val gold">{{ $antrian->total_durasi }}'</div>
                    <div class="info-lbl">Durasi Layanan</div>
                </div>
            </div>

            {{-- STATUS ANTRIAN SEKARANG --}}
            <div class="card">
                <div class="card-body">
                    <div
                        style="font-size:0.72rem;color:#9a7b82;font-weight:700;text-transform:uppercase;letter-spacing:1px;margin-bottom:10px">
                        Status Antrian Sekarang
                    </div>
                    @if($sedangDilayani)
                        <div class="now-serving">
                            <div class="now-badge">▶ DILAYANI</div>
                            <div>
                                <div style="font-weight:600;color:var(--gd);font-size:0.9rem">
                                    {{ $sedangDilayani->booking->user->nama_lengkap }}
                                </div>
                                <div style="font-size:0.76rem;color:#9a7b82">
                                    No. {{ $sedangDilayani->nomor_antrian }} —
                                    selesai ~{{ $sedangDilayani->estimasi_jam_selesai }}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="now-serving" style="background:#f5f5f5">
                            <div
                                style="background:#9e9e9e;color:white;border-radius:8px;padding:4px 10px;font-size:0.72rem;font-weight:700;white-space:nowrap">
                                KOSONG
                            </div>
                            <div style="font-size:0.86rem;color:#9a7b82">Belum ada yang dilayani saat ini</div>
                        </div>
                    @endif

                    @if($antrianDidepan === 0 && $antrian->status === 'menunggu')
                        <div class="next-alert">
                            <i class="bi bi-bell-fill me-2" style="color:var(--gold)"></i>
                            <strong>Kamu berikutnya!</strong> Harap segera bersiap.
                            <div style="font-size:0.78rem;color:var(--gm);margin-top:4px">
                                Keterlambatan lebih dari 15 menit → booking dibatalkan otomatis.
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- DETAIL BOOKING --}}
            <div class="card">
                <div class="card-body">
                    <div
                        style="font-size:0.72rem;color:#9a7b82;font-weight:700;text-transform:uppercase;letter-spacing:1px;margin-bottom:12px">
                        Detail Booking
                    </div>
                    <div class="detail-row">
                        <span class="lbl">Kode Booking</span>
                        <span class="val"
                            style="font-family:monospace;color:var(--gold);font-weight:700">{{ $booking->kd_booking }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="lbl">Layanan</span>
                        <span class="val">{{ $booking->layanan->pluck('nama_layanan')->join(', ') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="lbl">Terapis</span>
                        <span class="val">{{ $booking->terapis->nama_terapis }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="lbl">Tanggal</span>
                        <span class="val">{{ \Carbon\Carbon::parse($booking->tgl_booking)->isoFormat('D MMM Y') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="lbl">Total Harga</span>
                        <span class="val" style="color:var(--gold);font-weight:700">
                            Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="lbl">Status Bayar</span>
                        <span class="val">
                            @if($booking->status_pembayaran === 'lunas')
                                <span style="color:var(--gd);font-weight:700">✅ Lunas</span>
                            @elseif($booking->status_pembayaran === 'dp_lunas')
                                <span style="color:#1565c0;font-weight:600">DP Lunas</span>
                                <span style="color:#9a7b82;font-size:0.78rem;display:block">
                                    Sisa: Rp {{ number_format($booking->sisaBayar(), 0, ',', '.') }}
                                </span>
                            @else
                                <span style="color:#e65100">Belum Lunas</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            {{-- TOMBOL --}}
            @if($booking->sisaBayar() > 0 && !in_array($booking->status, ['dibatalkan', 'dibatalkan_sistem']))
                <a href="/booking/{{ $booking->id }}/lunasi" class="btn-gold">
                    <i class="bi bi-credit-card me-2"></i>
                    Lunasi Sisa — Rp {{ number_format($booking->sisaBayar(), 0, ',', '.') }}
                </a>
            @endif
            <a href="/booking/riwayat" class="btn-outline">← Kembali ke Riwayat</a>

        @else
            <div class="card" style="text-align:center;padding:40px 20px">
                <div style="font-size:3rem;margin-bottom:14px">📋</div>
                <h5 style="color:var(--gd);font-family:'Playfair Display',serif;margin-bottom:8px">Belum Ada Antrian</h5>
                <p style="color:#9a7b82;margin-bottom:20px">Selesaikan pembayaran terlebih dahulu.</p>
                <a href="/booking/{{ $booking->id }}/lunasi" class="btn-gold">Bayar Sekarang</a>
            </div>
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ✅ REAL-TIME COUNTDOWN
        @if($antrian && $antrian->status === 'menunggu')
            const targetTime = '{{ \Carbon\Carbon::parse($booking->tgl_booking)->format('Y-m-d') }} {{ $antrian->estimasi_jam_mulai }}:00';
        @elseif($antrian && $antrian->status === 'dilayani')
            const targetTime = '{{ \Carbon\Carbon::parse($booking->tgl_booking)->format('Y-m-d') }} {{ $antrian->estimasi_jam_selesai }}:00';
        @else
            const targetTime = null;
        @endif

        function updateCountdown() {
            if (!targetTime) return;
            const el = document.getElementById('countdown-display');
            if (!el) return;

            const now = new Date().getTime();
            const target = new Date(targetTime).getTime();
            const diff = target - now;

            if (diff <= 0) {
                el.textContent = '00:00:00';
                el.closest('.countdown-box').querySelector('.countdown-sub').textContent = 'Sudah waktunya! Harap menuju salon.';
                return;
            }

            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

            el.textContent = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        }

        // Update setiap detik
        setInterval(updateCountdown, 1000);
        updateCountdown();

        // Auto reload halaman setiap 30 detik untuk update data antrian
        setTimeout(() => window.location.reload(), 30000);
    </script>
</body>

</html>