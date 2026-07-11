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
            --primary: #7c3aed;
            --primary-dark: #6d28d9;
            --primary-light: #f5f3ff;

            --accent: #f59e0b;

            --bg: #fafafa;
            --card: #ffffff;

            --text: #1f2937;
            --text-soft: #6b7280;

            --border: #ececec;
            --cream: #faf7f0;
        }

        body {
            padding-top: 80px;
            background: var(--cream);
            font-family: 'Poppins', sans-serif;
            font-family: 'Poppins', sans-serif
        }

        .navbar-top {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;

            background: #faf7ff;
            border-bottom: 1px solid #e9d5ff;

            padding: 8px 16px;
            /* SAMA seperti booking */

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand-name {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.02rem;
            letter-spacing: 1.5px;
            color: #6d28d9;
            text-transform: uppercase;
            font-style: italic;
            /* INI YANG BIKIN MIRING */
            position: relative;
            line-height: 1;
        }

        .brand-name::after {
            content: "";
            display: block;
            width: 28px;
            height: 2px;
            background: #c084fc;
            margin: 5px auto 0;
            border-radius: 10px;
            opacity: .9;
        }

        .dropdown-menu .dropdown-item {
            font-size: 0.8rem;
        }


        .nav-btn {
            border: 1.5px solid #7c3aed;
            color: #7c3aed;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            text-decoration: none;
            transition: .2s;
        }

        .nav-btn:hover {
            background: #7c3aed;
            color: white;
        }

        .card {
            background: #fff;
            border: 1px solid #e9d5ff;
            border-radius: 20px;

            box-shadow:
                0 8px 24px rgba(124, 58, 237, 0.08),
                0 0 12px rgba(196, 132, 252, 0.10);

            margin-bottom: 10px;
        }

        .card-body {
            padding: 14px;
        }

        /* HERO ANTRIAN */
        .antrian-hero {
            max-width: 500px;
            margin: 0 auto 14px;

            padding: 18px 20px;

            /* ✨ tema baru: ungu soft + putih + gold */
            background: linear-gradient(135deg, #ffffff 0%, #f5f3ff 60%, #ede9fe 100%);

            border: 1px solid #e9d5ff;
            border-left: 6px solid #7c3aed;

            border-radius: 18px;

            text-align: center;

            box-shadow:
                0 10px 24px rgba(124, 58, 237, 0.12),
                0 2px 6px rgba(0, 0, 0, 0.06);

            position: relative;
            overflow: hidden;
        }

        /* glow ungu soft */
        .antrian-hero::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 180px;
            height: 180px;
            background: radial-gradient(circle, rgba(124, 58, 237, 0.15), transparent 70%);
            border-radius: 50%;
        }

        .antrian-hero::after {
            content: '';
            position: absolute;
            bottom: -50px;
            left: -50px;
            width: 180px;
            height: 180px;
            background: radial-gradient(circle, rgba(198, 162, 74, 0.12), transparent 70%);
            border-radius: 50%;
        }

        .hero-label {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 2px;
            color: #6b7280;
            margin-bottom: 6px;
        }

        .hero-nomor {
            margin: 0;
            line-height: 1.05;
            font-size: 3.6rem;
            font-weight: 900;
            color: #7c3aed;
            letter-spacing: 2px;
            text-shadow: 0 4px 10px rgba(124, 58, 237, 0.25);
        }

        .hero-sub {
            font-size: 0.85rem;
            color: #374151;
            margin-top: 6px;
        }

        .status-pill {
            display: inline-block;
            margin-top: 10px;
            padding: 6px 12px;
            border-radius: 999px;

            font-size: 0.72rem;
            font-weight: 700;

            border: 1px solid transparent;
        }

        /* MENUNGGU */
        .status-menunggu {
            background: #ede9fe;
            color: #5b21b6;
            border-color: #c4b5fd;
        }

        /* SEDANG DILAYANI */
        .status-dilayani {
            background: #dcfce7;
            color: #166534;
            border-color: #86efac;
        }

        /* SELESAI */
        .status-selesai {
            background: #e5e7eb;
            color: #374151;
            border-color: #d1d5db;
        }

        .pulse {
            animation: pulse 2s infinite
        }

        .container {
            padding-top: 8px !important;
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

        .info-box.status-box {
            grid-column: span 1;
        }

        .info-box {
            background: #ffffff;
            border: 1px solid #e9d5ff;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(124, 58, 237, 0.06);
            border-radius: 20px;
            padding: 12px;
            text-align: center;
        }

        .info-box.gold-bg {
            background: #faf5ff;
            border-color: #e9d5ff;
        }

        .info-box.green-bg {
            grid-column: span 1;
            background: #f5f3ff;
            border-color: #ddd6fe;
        }

        .info-val {
            font-size: 1.2rem;
            font-weight: 700;
            line-height: 1.1;
            text-align: center;


        }

        .info-val.gold {
            color: var(--gold)
        }

        .info-lbl {
            font-size: 0.65rem;
            color: #9a7b82;
            margin-top: 5px;
            font-weight: 500
        }

        .card-status-mini .card-body {
            padding: 10px;
        }

        .card-status-mini .now-serving {
            padding: 8px 10px;
            gap: 8px;
            margin-top: 6px;
        }

        .card-status-mini .now-badge {
            font-size: .6rem;
            padding: 3px 6px;
        }

        .card-status-mini .next-alert {
            padding: 8px 10px;
            font-size: .7rem;
            margin-top: 8px;
        }

        .card-status-mini .next-alert div {
            font-size: .65rem !important;
        }

        .card-status-mini .nama-pelanggan {
            font-size: .75rem !important;
        }

        .card-status-mini .detail-antrian {
            font-size: .65rem !important;
        }

        /* COUNTDOWN */
        .countdown-box {
            background: #ffffff;
            border: 1px solid #e9d5ff;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(124, 58, 237, 0.06);
            color: black;

            padding: 12px;
            text-align: center;
            margin-bottom: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
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
            color: #7c3aed;
            font-size: 2.2rem;
            font-weight: 800;
            font-family: 'Playfair Display', serif;
            line-height: 1
        }

        .countdown-sub {
            color: #111827;
            font-size: 0.78rem;
            margin-top: 5px;
            opacity: .75
        }

        /* SEDANG DILAYANI */
        .now-serving {
            background: #ffffff;
            border: 1px solid #e9d5ff;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(124, 58, 237, 0.06);
            border-radius: 12px;
            padding: 6px 8px;
            gap: 8px;
            display: flex;
            align-items: center;
            margin-top: 12px;
        }

        .now-badge {
            background: #7c3aed;
            color: white;
            border-radius: 8px;
            font-size: .5rem;
            padding: 2px 5px;
            font-weight: 700;
            white-space: nowrap;
        }

        .next-alert {
            background: #ffffff;
            border: 1px solid #e9d5ff;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(124, 58, 237, 0.06);

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
            color: #111827 !important;
        }

        .detail-row .val {
            font-weight: 500;
            color: #111827 !important;
            text-align: right;
            max-width: 60%
        }

        .btn-gold {
            display: flex;
            justify-content: center;
            align-items: center;

            width: 100%;

            background: transparent;
            border: 1.5px solid #7c3aed;
            color: #7c3aed;

            border-radius: 12px;
            padding: 10px;

            font-size: .85rem;
            font-weight: 600;

            margin-top: 12px;
            text-decoration: none;
        }

        .btn-gold:hover {
            background: #7c3aed;
            color: white;
            transform: none;
            box-shadow: none;
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

        .detail-toggle {
            width: 100%;
            border: none;
            background: #f8fafc;
            padding: 10px 14px;
            font-size: .88rem;
            border-radius: 14px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            font-weight: 600;
            color: #374151;

            cursor: pointer;
        }

        .detail-toggle:hover {
            background: #f3f4f6;
        }

        .durasi-box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 90px;
        }

        .info-box,
        .info-box.gold-bg,
        .info-box.green-bg,
        .countdown-box,
        .now-serving,
        .next-alert {
            background: #fff !important;
            border: 2.5px solid #d1d5db !important;
            box-shadow: 0 6px 18px rgba(124, 58, 237, 0.06);
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

            <div class="brand-name">SAlonQu</div>
        </div>

        <div class="d-flex align-items-center gap-3">

            <div class="dropdown">
                <a class="dropdown-toggle text-decoration-none" href="#" role="button" data-bs-toggle="dropdown"
                    style="color:#7c3aed;font-size:0.85rem;font-weight:500">

                    <i class="bi bi-person-circle me-1"></i>
                    {{ Auth::user()->nama_lengkap }}
                </a>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>
                        <a class="dropdown-item" href="/booking/riwayat">
                            <i class="bi bi-clock-history me-2"></i>
                            Riwayat
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form action="/logout" method="POST">
                            @csrf
                            <button class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Logout
                            </button>
                        </form>
                    </li>

                </ul>
            </div>

        </div>
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
                    <div class="status-pill status-menunggu">⏳ Menunggu Giliran</div>

                @elseif($antrian->status === 'dipanggil')
                    <div class="status-pill status-menunggu pulse">
                        📢 Dipanggil, segera menuju salon
                    </div>

                @elseif($antrian->status === 'dilayani')
                    <div class="status-pill status-dilayani pulse">▶ Sedang Dilayani</div>

                @elseif($antrian->status === 'selesai')
                    <div class="status-pill status-selesai">✅ Selesai Dilayani</div>
                @endif
            </div>

            {{-- COUNTDOWN REAL-TIME --}}
            @if($antrian->status === 'menunggu' && $antrianDidepan >= 0)

                <div class="countdown-box">
                    <div class="countdown-label">⏱ Estimasi Waktu Tunggu</div>

                    <div class="countdown-time" id="countdown-display">
                        --:--:--
                    </div>

                    <div style="font-size:0.78rem;margin-top:4px;opacity:.7">
                        Estimasi mulai dilayani:
                        <strong>{{ $antrian->estimasi_jam_mulai }}</strong>
                    </div>
                </div>

            @elseif($antrian->status === 'dipanggil')

                <div class="countdown-box">
                    <div class="countdown-label">
                        📢 Waktu Kehadiran
                    </div>

                    <div class="countdown-time" id="countdown-display">
                        --:--:--
                    </div>

                    <div class="countdown-sub">
                        Segera datang ke salon. Batas waktu kehadiran 15 menit.
                    </div>
                </div>

            @elseif($antrian->status === 'dilayani')

                <div class="countdown-box">
                    <div class="countdown-label">
                        ✅ Sedang Dilayani
                    </div>

                    <div class="countdown-sub">
                        Pelayanan sedang berlangsung.
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
                    <div style="display:flex;justify-content:space-around;align-items:center">
                        <div>
                            <div class="info-val" style="font-size:1.15rem">
                                {{ $antrian->estimasi_jam_mulai }}
                            </div>
                            <div class="info-lbl">Mulai</div>
                        </div>

                        <div style="width:1px;height:35px;background:#ddd6fe"></div>

                        <div>
                            <div class="info-val" style="font-size:1.15rem">
                                {{ $antrian->estimasi_jam_selesai }}
                            </div>
                            <div class="info-lbl">Selesai</div>
                        </div>
                    </div>
                </div>
                <div class="info-box gold-bg durasi-box">
                    <div class="info-val gold" style="font-size:1rem">
                        {{ $antrian->total_durasi }} Menit
                    </div>
                    <div class="info-lbl">Durasi Layanan</div>
                </div>
                <div class="info-box status-box">
                    {{-- STATUS ANTRIAN SEKARANG --}}

                    <div
                        style="font-size:0.60rem;color:#9a7b82;font-weight:700;text-transform:uppercase;letter-spacing:1px;margin-bottom:3px">
                        Status Antrian Sekarang
                    </div>
                    @if($sedangDilayani)
                        <div class="now-serving">
                            <div class="now-badge">▶ DILAYANI</div>
                            <div>
                                <div style="font-weight:600;color:#111827;font-size:0.72rem">
                                    {{ $sedangDilayani->booking->user->nama_lengkap }}
                                </div>
                                <div style="font-size:0.62rem;color:#9a7b82">
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
                            <div style="font-size:0.70rem;color: black">Belum ada yang dilayani saat ini</div>
                        </div>
                    @endif

                    @if($antrianDidepan === 0 && $antrian->status === 'menunggu')
                        {{-- <div class="next-alert">
                            <i class="bi bi-bell-fill me-2" style="color: black"></i>
                            <strong>Kamu berikutnya!</strong> Harap segera bersiap.
                            <div style="font-size:0.78rem;color:var(--gm);margin-top:4px">
                                Keterlambatan lebih dari 15 menit → booking dibatalkan otomatis.
                            </div>
                        </div> --}}
                    @endif
                </div>
            </div>




            {{-- DETAIL BOOKING --}}
            <div class="card">
                <div class="card-body">
                    <button class="detail-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#detailBooking">

                        <span>
                            <i class="bi bi-receipt"></i>
                            Detail Booking
                        </span>

                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="collapse mt-3" id="detailBooking">
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
                            <span
                                class="val">{{ \Carbon\Carbon::parse($booking->tgl_booking)->isoFormat('D MMM Y') }}</span>
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
                        {{-- TOMBOL --}}
                        @if($booking->sisaBayar() > 0 && !in_array($booking->status, ['dibatalkan', 'dibatalkan_sistem']))
                            <a href="/booking/{{ $booking->id }}/lunasi" class="btn-gold d-block text-center">
                                <i class="bi bi-credit-card me-2"></i>
                                Lunasi
                            </a>
                        @endif
                    </div>

                </div>
            </div>




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

            const targetTime = '{{ \Carbon\Carbon::parse($booking->tgl_booking)->format("Y-m-d") }} {{ $antrian->estimasi_jam_mulai }}:00';

        @elseif($antrian && $antrian->status === 'dipanggil')

            const targetTime = '{{ \Carbon\Carbon::parse($antrian->called_at)->addMinutes(15)->format("Y-m-d H:i:s") }}';

        @elseif($antrian && $antrian->status === 'dilayani')

            const targetTime = null;

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