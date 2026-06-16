<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Booking - Sri Salon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600&display=swap"
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

        .btn-gold {
            background: linear-gradient(135deg, var(--gold), #b8922e);
            color: var(--gd);
            border: none;
            border-radius: 10px;
            padding: 8px 18px;
            font-weight: 700;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all .2s;
            display: inline-flex;
            align-items: center;
            gap: 5px
        }

        .btn-gold:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(201, 168, 76, 0.3);
            color: var(--gd)
        }

        .nav-btn {
            border: 1.5px solid var(--gold);
            color: var(--gold);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            text-decoration: none;
            background: transparent;
            cursor: pointer;
            transition: all .2s
        }

        .nav-btn:hover {
            background: var(--gold);
            color: var(--gd)
        }

        .booking-card {
            background: white;
            border-radius: 18px;
            overflow: hidden;
            margin-bottom: 14px;
            border: 1px solid rgba(201, 168, 76, 0.15);
            box-shadow: 0 3px 16px rgba(26, 58, 42, 0.07);
            transition: all .2s;
        }

        .booking-card:hover {
            box-shadow: 0 8px 25px rgba(26, 58, 42, 0.12)
        }

        .status-bar {
            height: 4px
        }

        .card-inner {
            padding: 18px 20px
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: var(--gold-l);
            color: var(--gd);
            border: 1px solid rgba(201, 168, 76, 0.3);
            border-radius: 20px;
            padding: 3px 10px;
            font-size: 0.76rem;
            font-weight: 500;
            margin: 2px;
        }

        .info-row {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.83rem;
            color: #6b7c6b;
            margin-bottom: 4px
        }

        .info-row i {
            color: var(--gold);
            width: 15px
        }

        .status-badge {
            display: inline-block;
            border-radius: 20px;
            padding: 3px 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .sb-aktif {
            background: var(--gl);
            color: var(--gd)
        }

        .sb-selesai {
            background: #e3f2fd;
            color: #1565c0
        }

        .sb-menunggu {
            background: var(--gold-l);
            color: #7a5c00
        }

        .sb-batal {
            background: #ffebee;
            color: #c62828
        }

        .btn-aksi {
            border-radius: 8px;
            padding: 6px 14px;
            font-size: 0.78rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all .2s;
            cursor: pointer;
            border: none;
        }

        .btn-antrian {
            background: var(--gd);
            color: var(--gold)
        }

        .btn-antrian:hover {
            background: var(--gm);
            color: var(--gold)
        }

        .btn-lunasi {
            background: #1565c0;
            color: white
        }

        .btn-lunasi:hover {
            background: #0d47a1;
            color: white
        }

        .btn-batal {
            background: white;
            color: #c62828;
            border: 1.5px solid #ef9a9a
        }

        .btn-batal:hover {
            background: #ffebee;
            color: #c62828
        }

        .btn-hapus {
            background: white;
            color: #9e9e9e;
            border: 1.5px solid #e0e0e0
        }

        .btn-hapus:hover {
            background: #ffebee;
            color: #c62828;
            border-color: #ef9a9a
        }

        .batal-form {
            background: #fff8f0;
            border: 1px solid rgba(201, 168, 76, 0.3);
            border-radius: 10px;
            padding: 12px;
            margin-top: 10px;
            display: none;
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
        <div style="display:flex;gap:10px;align-items:center">
            <a href="/booking" class="btn-gold"><i class="bi bi-plus-lg"></i> Booking Baru</a>
            <span style="color:rgba(255,255,255,0.5);font-size:0.8rem">{{ Auth::user()->nama_lengkap }}</span>
            <form action="/logout" method="POST" class="d-inline">@csrf
                <button type="submit" class="nav-btn">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container py-4" style="max-width:700px">

        @if(session('success'))
            <div class="alert border-0 rounded-3 mb-3"
                style="background:var(--gl);color:var(--gd);border-left:4px solid var(--gold) !important">
                <i class="bi bi-check-circle-fill me-2" style="color:var(--gold)"></i>{{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert border-0 rounded-3 mb-3"
                style="background:#ffebee;color:#c62828;border-left:4px solid #c62828 !important">
                {{ session('error') }}
            </div>
        @endif

        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
            <div>
                <h4 style="font-family:'Playfair Display',serif;color:var(--gd);margin-bottom:2px">Riwayat Pemesanan
                </h4>
                <p style="color:#9a7b82;font-size:0.82rem;margin:0">{{ $bookings->total() }} total booking</p>
            </div>
        </div>

        @forelse($bookings as $b)
            <div class="booking-card">
                {{-- Color bar --}}
                <div class="status-bar" style="background:
                                                                                                                    {{ $b->status === 'aktif' ? 'linear-gradient(90deg,#1a3a2a,#2d5a3d)' :
            ($b->status === 'selesai' ? 'linear-gradient(90deg,#c9a84c,#b8922e)' :
                (str_contains($b->status, 'dibatalkan') ? 'linear-gradient(90deg,#c62828,#ef5350)' :
                    'linear-gradient(90deg,#f57c00,#ffb74d)')) }}">
                </div>

                <div class="card-inner">
                    {{-- Header --}}
                    <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:12px">
                        <span style="font-family:monospace;font-weight:700;color:var(--gold);font-size:0.9rem">
                            {{ $b->kd_booking }}
                        </span>
                        <div style="display:flex;gap:5px;flex-wrap:wrap;justify-content:flex-end">
                            @if($b->status === 'aktif')
                                <span class="status-badge sb-aktif">✅ Aktif</span>
                                @if($b->status == 'selesai' && !$booking->review)

                                    <a href="/review/{{ $booking->id }}" class="btn btn-warning btn-sm">

                                        ⭐ Beri Review

                                    </a>

                                @endif
                            @elseif($b->status === 'menunggu_pembayaran')
                                <span class="status-badge sb-menunggu">⏳ Menunggu Bayar</span>
                            @elseif(str_contains($b->status, 'dibatalkan'))
                                <span class="status-badge sb-batal">✕ Dibatalkan</span>
                            @endif
                            @if($b->status_pembayaran === 'lunas')
                                <span class="status-badge" style="background:var(--gl);color:var(--gd)">💰 Lunas</span>
                            @elseif($b->status_pembayaran === 'dp_lunas')
                                <span class="status-badge" style="background:#e3f2fd;color:#1565c0">DP Lunas</span>
                            @endif
                        </div>
                    </div>

                    {{-- Chips Layanan --}}
                    <div style="margin-bottom:12px">
                        @foreach($b->layanan as $l)
                            <span class="chip">✂ {{ $l->nama_layanan }}</span>
                        @endforeach
                    </div>

                    {{-- Info Grid --}}
                    <div class="row g-0">
                        <div class="col-6">
                            <div class="info-row"><i class="bi bi-person-badge"></i>{{ $b->terapis->nama_terapis ?? '-' }}
                            </div>
                            <div class="info-row"><i
                                    class="bi bi-calendar3"></i>{{ \Carbon\Carbon::parse($b->tgl_booking)->isoFormat('D MMM Y') }}
                            </div>
                            @if($b->nomor_antrian)
                                <div class="info-row">
                                    <i class="bi bi-list-ol"></i>
                                    No. Antrian: <strong style="color:var(--gd)">#{{ $b->nomor_antrian }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="col-6">
                            <div class="info-row">
                                <i class="bi bi-cash-coin"></i>
                                <strong style="color:var(--gold)">Rp
                                    {{ number_format($b->total_harga, 0, ',', '.') }}</strong>
                            </div>
                            @if($b->sisaBayar() > 0 && !str_contains($b->status, 'dibatalkan'))
                                <div class="info-row">
                                    <i class="bi bi-exclamation-circle" style="color:#e65100"></i>
                                    <span style="color:#e65100;font-size:0.8rem">
                                        Sisa: Rp {{ number_format($b->sisaBayar(), 0, ',', '.') }}
                                    </span>
                                </div>
                            @endif
                            @if($b->estimasi_jam)
                                <div class="info-row"><i class="bi bi-alarm"></i>Est: {{ $b->estimasi_jam }}</div>
                            @endif
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div
                        style="display:flex;gap:8px;flex-wrap:wrap;margin-top:14px;padding-top:12px;border-top:1px solid rgba(201,168,76,0.12)">

                        @if(in_array($b->status, ['aktif', 'menunggu_pembayaran']))
                            <a href="/booking/antrian/{{ $b->kd_booking }}" class="btn-aksi btn-antrian">
                                <i class="bi bi-list-ol"></i> Lihat Antrian
                            </a>
                        @endif

                        @if($b->bisaDibatalkan())
                            <form action="/booking/{{ $b->id }}/batalkan" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn-aksi btn-batal">
                                    <i class="bi bi-x-circle"></i> Batalkan
                                </button>
                            </form>
                        @endif

                        @if($b->sisaBayar() > 0 && $b->status === 'aktif')
                            <a href="/booking/{{ $b->id }}/lunasi" class="btn-aksi btn-lunasi">
                                <i class="bi bi-credit-card"></i> Lunasi
                            </a>
                        @endif



                        @if(in_array($b->status, ['selesai', 'dibatalkan', 'dibatalkan_sistem']))
                            <form action="/booking/{{ $b->id }}/hapus" method="POST" class="d-inline"
                                onsubmit="return confirm('Hapus riwayat booking ini dari daftar?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-aksi btn-hapus">
                                    <i class="bi bi-trash3"></i> Hapus Riwayat
                                </button>
                            </form>
                        @endif

                        @if($b->status == 'selesai')
                            @if(!$b->review)
                                <a href="/review/{{ $b->id }}" class="btn-aksi" style="background:#ffc107;color:#000;">
                                    ⭐ Beri Ulasan
                                </a>
                            @else
                                <span style="font-size:0.8rem;color:green;font-weight:600">
                                    ✔ Sudah Direview
                                </span>
                            @endif
                        @endif
                    </div>


                </div>
            </div>
        @empty
            <div
                style="background:white;border-radius:20px;padding:60px 20px;text-align:center;border:1px solid rgba(201,168,76,0.15)">
                <div style="font-size:4rem;margin-bottom:16px">📋</div>
                <h5 style="font-family:'Playfair Display',serif;color:var(--gd);margin-bottom:8px">Belum Ada Booking</h5>
                <p style="color:#9a7b82;margin-bottom:24px">Kamu belum pernah melakukan booking.</p>
                <a href="/booking" class="btn-gold" style="display:inline-flex">Booking Sekarang</a>
            </div>
        @endforelse

        <div class="mt-2">{{ $bookings->links() }}</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>