<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Booking - Sri Salon</title>

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
            --gl: #e8f5ee;
        }

        body {
            background: var(--cream);
            font-family: 'Poppins', sans-serif;
            padding-top: 80px;
            /* penting banget */
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
            /* 🔥 diperkecil */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand-name {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.02rem;
            /* diperkecil dikit */
            letter-spacing: 1.5px;
            /* gak terlalu jauh */
            color: #6d28d9;
            text-transform: uppercase;
            font-style: italic;
            position: relative;
            line-height: 1;
        }

        .brand-name::after {
            content: "";
            display: block;
            width: 28px;
            /* lebih kecil biar elegan */
            height: 2px;
            background: #c084fc;
            margin: 5px auto 0;
            border-radius: 10px;
            opacity: 0.9;
            /* biar gak terlalu “ngejreng” */
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
            border-radius: 16px;
            background: white;
            box-shadow: 0 3px 16px rgba(26, 58, 42, 0.07);
        }

        .section-title {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #7c3aed;
            /* soft purple */
            margin-bottom: 12px;
        }

        .layanan-card {
            border: 1.5px solid rgba(201, 168, 76, 0.2);
            border-radius: 12px;
            padding: 12px 14px;
            cursor: pointer;
            transition: all .2s;
            background: white;
            display: block;
        }

        .layanan-card:hover {
            border-color: var(--gold);
            background: var(--gold-l);
        }

        .layanan-card.selected {
            border-color: var(--gold);
            background: var(--gold-l);
            box-shadow: 0 0 0 2px rgba(201, 168, 76, .3);
        }

       .layanan-card input[type=checkbox]{
        display:none;
        }

        .btn-pink {
            background: #8b5cf6;
            color: white;
            border: none;
            border-radius: 14px;
            font-weight: 600;
            box-shadow: 0 6px 18px rgba(139, 92, 246, .18);
        }

        .btn-pink:hover {
            background: #7c3aed;
            transform: translateY(-1px);
        }

        .payment-option {
            border: 1.5px solid #e9d5ff !important;
            border-radius: 12px;
            transition: .2s;
        }

        .payment-option:hover {
            background: #faf7ff;
        }

        .form-control,
        .form-select {
            border: 1.5px solid rgba(201, 168, 76, 0.3);
            border-radius: 10px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(201, 168, 76, 0.15);
        }

        .summary-box {
            background: #faf7ff;
            border: 1px solid #e9d5ff;
            border-radius: 16px;
            padding: 18px;
            color: #222;
        }

        .summary-box * {
            color: #222 !important;
        }

        .availability-badge {
            font-size: 0.78rem;
            padding: 4px 12px;
            border-radius: 20px;
            display: inline-block;
            margin-top: 4px;
        }

        .badge-available {
            background: #e8f5ee;
            color: var(--gd);
        }

        .badge-full {
            background: #ffebee;
            color: #c62828;
        }


        .terapis-card-horizontal {
            display: flex;
            gap: 14px;
            padding: 16px;
            border-radius: 18px;
            border: 1px solid #e9d5ff;
            background: #fff;
            cursor: pointer;
            transition: .25s ease;
            align-items: flex-start;
            position: relative;
            height: 100%;
        }

        .terapis-card-horizontal:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(124, 58, 237, .12);
            border-color: #c084fc;
        }

        .terapis-card-horizontal.selected {
            border: 2px solid #7c3aed;
            background: #f5f3ff;
        }

        /* foto */
        .terapis-foto-horizontal {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ede9fe;
            flex-shrink: 0;
        }

        .terapis-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        /* nama */
        .terapis-info h5 {
            margin: 0;
            font-size: 15px;
            font-weight: 700;
            color: #2d1b20;
        }

        .terapis-info input[type="radio"] {
            transform: scale(1.1);
            accent-color: #7c3aed;
            margin-right: 6px;
        }

        .tag-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-top: 5px;
        }

        .tag {
            background: #fdf2f8;
            color: #be185d;
            border-radius: 999px;
            padding: 3px 8px;
            font-size: 10px;
        }

        /* badge unggulan */
        .badge-ai {
            display: inline-block;
            background: #7c3aed;
            color: white;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 10px;
            width: max-content;
        }

        .rating {
            font-size: 22px;
            font-weight: bold;
            color: #d4af37;
            margin-bottom: 10px;
        }

        /* rating */
        .rating-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #ede9fe;
            color: #6d28d9;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 11px;
            width: max-content;
        }

        .statistik {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 15px 0;
        }

        .mini-stat {
            font-size: 11px;
            color: #6b7280;
            margin-top: 2px;
        }

        .container {
            max-width: 850px !important;
        }

        .terapis-card-horizontal.selected {
            border: 1px solid #1a3a2a;

            box-shadow: 0 0 15px rgba(26, 58, 42, .15);
        }

        .terapis-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        /* biar card full lebar di grid */
        .terapis-grid .col-md-6 {
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .disabled-card {
            opacity: .45;
            pointer-events: none;
            filter: grayscale(30%);
        }

        .dropdown-menu .dropdown-item {
            font-size: 0.8rem;
        }

        /* responsive HP */
        @media(max-width:768px) {
            .terapis-grid {
                grid-template-columns: 1fr;
            }
            .payment-option{
            padding:12px 8px !important;
            }

            .payment-option .fw-semibold{
                font-size:1.15rem;
            }

            .payment-option div:last-child{
                font-size:.95rem !important;
                white-space:nowrap;
            }
            .summary-box{
                font-size:.92rem;
            }

            .summary-box .fw-bold{
                font-size:1rem;
            }
            #summary-promo{
                font-size:.85rem;
                line-height:1.3;
                text-align:right;
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
            <div class="brand-name">SalonQu</div>
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
                            <i class="bi bi-clock-history me-2"></i> Riwayat
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form action="/logout" method="POST">
                            @csrf
                            <button class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4" style="max-width:750px;width:100%">

        @if(session('error'))
            <div class="alert alert-danger rounded-3 border-0 shadow-sm">
                <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
            </div>
        @endif

        <form action="/booking" method="POST" id="formBooking">
            @csrf

            {{-- NAMA PELANGGAN --}}
            <div class="card p-4 mb-3">
                <div class="section-title">Nama Pelanggan</div>
                <input type="text" class="form-control" value="{{ Auth::user()->nama_lengkap }}" disabled
                    style="background:#fdf6f7">
            </div>


            {{-- PILIH LAYANAN --}}
            <div class="card p-4 mb-3">
                <div class="section-title">
                    Pilih Layanan
                    <span style="color:#9a7b82;font-weight:400;text-transform:none;font-size:0.75rem">
                        (Bisa pilih lebih dari satu)
                    </span>
                </div>

                @error('layanan_ids')
                    <div class="alert alert-danger py-2 small mb-2">{{ $message }}</div>
                @enderror

                {{-- Dropdown toggle --}}
                <div class="dropdown">
                    <button id="btnDropdownLayanan" class="form-select text-start" type="button"
                        data-bs-toggle="dropdown" data-bs-auto-close="outside">

                        <span id="dropdownTextLayanan">
                            Pilih layanan
                        </span>

                    </button>

                    <ul class="dropdown-menu w-100 p-0" style="overflow:hidden;">
                        <div style="max-height:250px;overflow-y:auto;padding:8px;">
                            @foreach($layanan as $l)
                                <li>
                                    <label
                                        class="dropdown-item layanan-card d-flex align-items-start"
                                        {{ is_array(old('layanan_ids')) && in_array($l->id, old('layanan_ids')) ? 'selected' : '' }}"
                                        data-harga="{{ $l->harga }}" data-durasi="{{ $l->durasi }}"
                                        onclick="toggleLayanan(this)">

                                        <input type="checkbox" name="layanan_ids[]"value="{{ $l->id }}"hidden
                                        {{ is_array(old('layanan_ids')) && in_array($l->id, old('layanan_ids')) ? 'checked' : '' }}>

                                        <div style="flex:1; min-width:0;">
                                            <div class="fw-semibold" style="font-size:0.9rem; color:#2d1b20">
                                                {{ $l->nama_layanan }}
                                            </div>

                                            <small style="color:#9a7b82">
                                                <i class="bi bi-clock"></i> {{ $l->durasi }} menit
                                            </small>
                                        </div>

                                        <span class="fw-bold ms-3" style="white-space:nowrap;color:#b5485a;font-size:.85rem">
                                            Rp {{ number_format($l->harga, 0, ',', '.') }}
                                        </span>

                                    </label>
                                </li>
                            @endforeach
                        </div>
                        <div class="text-end p-3 border-top bg-white">
                            <button type="button" id="btnSimpanLayanan" class="btn btn-sm px-4" style="
            background:#8b5cf6;
            color:#fff;
            border-radius:10px;
        ">
                                Simpan
                            </button>
                        </div>

                    </ul>
                </div>
            </div>

            {{-- PILIH TANGGAL --}}
            <div class="card p-4 mb-3">
                <div class="section-title">Pilih Tanggal/Hari</div>

                <select class="form-select" onchange="pilihTanggal(this.value)" style="font-size:0.9rem;">

                    <option value="">Pilih Tanggal</option>

                    @foreach($tanggalTersedia as $tgl)
                                    <option value="{{ $tgl['value'] }}" {{ old('tgl_booking') == $tgl['value'] ? 'selected' : '' }}>

                                        {{ \Carbon\Carbon::parse($tgl['value'])
                        ->locale('id')
                        ->isoFormat('dddd, D MMMM Y') }}

                                        @if($tgl['is_today'])
                                            (Hari Ini)
                                        @endif

                                    </option>
                    @endforeach

                </select>

                <input type="hidden" name="tgl_booking" id="tgl_booking" value="{{ old('tgl_booking') }}">
            </div>

            {{-- PILIH TERAPIS --}}
            <div class="card p-4 mb-3">
                <div class="section-title">Pilih Terapis</div>
                @error('terapis_id')
                    <div class="alert alert-danger py-2 small mb-2">{{ $message }}</div>
                @enderror


                <div class="terapis-grid">

                    @foreach($terapis as $t)

                        <div class="col-md-6 mb-3">

                            <div class="terapis-card-horizontal" {{ !$t->tersedia ? 'disabled-card' : '' }}"
                                @if($t->tersedia) onclick="pilihTerapis(this)" @endif>

                                @if($t->foto)
                                    <img src="{{ asset('storage/' . $t->foto) }}"
                                    class="terapis-foto-horizontal"
                                    alt="{{ $t->nama_terapis }}">
                                @else
                                    <img src="{{ asset('images/terapis1.jpg') }}"
                                    class="terapis-foto-horizontal"
                                    alt="{{ $t->nama_terapis }}">
                                @endif

                                <div class="terapis-info">

                                    @if($loop->first)
                                        <span class="badge-ai">
                                            🏆 Terapis Unggulan
                                        </span>
                                    @endif

                                    <h5>{{ $t->nama_terapis }}</h5>
                                    {{-- @if(!$t->tersedia)
                                    <div class="badge bg-danger mb-2">
                                        Penuh
                                    </div>
                                    @else
                                    <div class="badge bg-success mb-2">
                                        Tersedia
                                    </div>
                                    @endif --}}

                                    <div class="rating-badge">
                                        ⭐ {{ $t->rating }}
                                    </div>

                                    <div class="mini-stat">
                                        {{ $t->booking_selesai }} Booking
                                        •
                                        {{ $t->jumlah_review }} Review
                                    </div>

                                    <div class="tag-wrap mt-2">

                                        <span class="tag">
                                            Ramah ({{ $t->ramah ?? 0 }})
                                        </span>

                                        <span class="tag">
                                            Rapi ({{ $t->rapi ?? 0 }})
                                        </span>

                                        <span class="tag">
                                            Bersih ({{ $t->bersih ?? 0 }})
                                        </span>

                                        <span class="tag">
                                            Profesional ({{ $t->profesional ?? 0 }})
                                        </span>

                                        <span class="tag">
                                            Keterampilan ({{ $t->keterampilan ?? 0 }})
                                        </span>

                                    </div>

                                    <div class="mt-2">

                                        @if($t->tersedia)

                                            <input type="radio" name="terapis_id" value="{{ $t->id }}" required>

                                            Pilih Terapis

                                        @else

                                            <span class="text-danger fw-semibold">
                                                Terapis Sudah Penuh
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

                {{-- RINGKASAN & JENIS BAYAR --}}
                <div class="card p-4 mb-3">
                    <div class="section-title">Ringkasan & Pembayaran</div>
                    <div class="summary-box mb-3">
                        <div class="d-flex justify-content-between mb-2" style="font-size:0.88rem">
                            <span class="text-muted">Layanan</span>
                            <span id="summary-layanan" class="fw-semibold">-</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2" style="font-size:0.88rem">
                            <span class="text-muted">Terapis</span>
                            <span id="summary-terapis" class="fw-semibold">-</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2" style="font-size:0.88rem">
                            <span class="text-muted">Total Durasi</span>
                            <span id="summary-durasi" class="fw-semibold">-</span>
                        </div>

                        <hr style="border-color:#f2c4cc">

                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span id="summary-subtotal">-</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span style="color:#16a34a">🎉 Promo</span>
                            <span id="summary-promo" style="color:#16a34a">-</span>
                        </div>

                        <div class="d-flex justify-content-between" style="font-size:0.95rem">
                            <span class="fw-bold">Total Bayar</span>
                            <span id="summary-total" class="fw-bold" style="color:#b5485a">-</span>
                        </div>
                    </div>

                    {{-- Pilih Jenis Pembayaran --}}
                    <div class="section-title mt-3">Pilih Jenis Pembayaran</div>
                    <div class="card p-3">

                        <div class="row g-2">

                            {{-- DP --}}
                            <div class="col-6">
                                <label class="p-3 text-center w-100" class="payment-option p-3 text-center w-100"
                                    style="border:1.5px solid #f0e0e3; border-radius:10px; cursor:pointer;"
                                    id="bayar-dp" onclick="pilihBayar('dp', this)">

                                    <input type="radio" name="jenis_pembayaran" value="dp" style="display:none">

                                    <div class="fw-semibold">DP 30%</div>
                                    <div id="dp-amount" style="color:#b5485a; font-size:0.85rem">Rp -</div>
                                </label>
                            </div>

                            {{-- FULL --}}
                            <div class="col-6">
                                <label class="p-3 text-center w-100" class="payment-option p-3 text-center w-100"
                                    style="border:1.5px solid #f0e0e3; border-radius:10px; cursor:pointer;"
                                    id="bayar-full" onclick="pilihBayar('full', this)">

                                    <input type="radio" name="jenis_pembayaran" value="full" style="display:none">

                                    <div class="fw-semibold">Full</div>
                                    <div id="full-amount" style="color:#b5485a; font-size:0.85rem">Rp -</div>
                                </label>
                            </div>
                            <div class="mt-2 text-center" style="
font-size:0.78rem;
color: black;
background:#f5f3ff;
padding:8px;
border-radius:10px;
">
                                <i class="bi bi-info-circle-fill"></i>
                                Pembayaran hangus jika batal, tidak hadir, atau terlambat >15 menit setelah dipanggil.
                            </div>

                        </div>
                    </div>
                </div>

                <button id="btnBooking" type="submit" class="btn btn-pink w-100 py-3 fw-semibold" style="font-size:1rem"
                    disabled>
                    <i class="bi bi-arrow-right-circle me-2"></i>
                    Lanjut ke Pembayaran
                </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let selectedTgl = '{{ old('tgl_booking') }}';
        let promoPotongan = 0;
        let promoNama = '';
        let totalBayar = 0;

        function pilihTerapis(card) {

            // hapus pilihan sebelumnya
            document.querySelectorAll('.terapis-card-horizontal')
                .forEach(c => c.classList.remove('selected'));

            // pilih card yg diklik
            card.classList.add('selected');

            // centang radio
            const radio = card.querySelector('input[type="radio"]');
            radio.checked = true;

            // update ringkasan
            const namaTerapis =
                card.querySelector('h5').innerText;

            document.getElementById('summary-terapis').textContent =
                namaTerapis;
            cekFormLengkap();
        }

        // Toggle layanan
        function toggleLayanan(card) {
            const cb = card.querySelector('input[type=checkbox]');
            cb.checked = !cb.checked;
            card.classList.toggle('selected', cb.checked);
            updateSummary();
            cekFormLengkap();

        }

        // Pilih tanggal (dropdown)
        function pilihTanggal(val) {
            document.getElementById('tgl_booking').value = val;
            selectedTgl = val;
            cekFormLengkap();

        }



        // Pilih jenis bayar
        function pilihBayar(val, el) {
            document.querySelectorAll('[id^="bayar-"]').forEach(e => {
                e.style.borderColor = '#f0e0e3';
                e.style.background = 'white';
            });
            el.style.borderColor = '#7c3aed';
            el.style.background = '#f5f3ff';
            el.querySelector('input[type=radio]').checked = true;
            cekFormLengkap();
        }

        // Update summary
        function updateSummary() {
            let totalHarga = 0;
            let totalDurasi = 0;
            let namaLayanan = [];

            document.querySelectorAll('input[name="layanan_ids[]"]:checked').forEach(cb => {
                const card = cb.closest('label');
                totalHarga += parseInt(card.dataset.harga || 0);
                totalDurasi += parseInt(card.dataset.durasi || 0);
                namaLayanan.push(card.querySelector('.fw-semibold').innerText.trim());
            });

            const fmt = v => 'Rp ' + new Intl.NumberFormat('id-ID').format(v);
            const layananIds = [];

            document.querySelectorAll('input[name="layanan_ids[]"]:checked').forEach(cb => {
                layananIds.push(cb.value);
            });

            fetch("{{ route('booking.cekPromo') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({
                    layanan_ids: layananIds
                })
            })
                .then(res => res.json())
                .then(data => {

                    document.getElementById('summary-subtotal').textContent =
                        fmt(data.subtotal);

                    document.getElementById('summary-promo').textContent =
                        data.potongan > 0
                            ? '- ' + fmt(data.potongan) + ' (' + data.nama_promo + ')'
                            : '-';

                    document.getElementById('summary-total').textContent =
                        fmt(data.total_bayar);

                    document.getElementById('dp-amount').textContent =
                        fmt(Math.round(data.total_bayar * 0.30));

                    document.getElementById('full-amount').textContent =
                        fmt(data.total_bayar);

                });

            document.getElementById('summary-layanan').textContent =
                namaLayanan.length > 0 ? namaLayanan.join(', ') : '-';
            document.getElementById('summary-durasi').textContent =
                totalDurasi > 0 ? totalDurasi + ' menit' : '-';
            document.getElementById('summary-subtotal').textContent =
                totalHarga > 0 ? fmt(totalHarga) : '-';
            document.getElementById('summary-promo').textContent =
                promoPotongan > 0
                    ? '- ' + fmt(promoPotongan) + ' (' + promoNama + ')'
                    : '-';

            document.getElementById('summary-total').textContent =
                totalBayar > 0
                    ? fmt(totalBayar)
                    : fmt(totalHarga);
            document.getElementById('dp-amount').textContent =
                totalHarga > 0 ? fmt(Math.round(totalHarga * 0.30)) : 'Rp -';
            document.getElementById('full-amount').textContent =
                totalHarga > 0 ? fmt(totalHarga) : 'Rp -';
            const terapisDipilih =
                document.querySelector('input[name="terapis_id"]:checked');

            if (terapisDipilih) {

                const namaTerapis =
                    terapisDipilih.closest('.terapis-card-horizontal')
                        .querySelector('h5').innerText;

                document.getElementById('summary-terapis').textContent =
                    namaTerapis;
            }
        }



        document.querySelectorAll('input[name="terapis_id"]').forEach(radio => {

            radio.addEventListener('change', function () {

                const namaTerapis =
                    this.closest('.terapis-card-horizontal')
                        .querySelector('h5').innerText;

                document.getElementById('summary-terapis').textContent =
                    namaTerapis;

                updateSummary();
                cekFormLengkap();
            });

        });

        // Validasi submit
        document.getElementById('formBooking').addEventListener('submit', function (e) {
            const layanan = document.querySelectorAll('input[name="layanan_ids[]"]:checked').length;
            const terapis = document.querySelector('input[name="terapis_id"]:checked');
            const tgl = document.getElementById('tgl_booking').value;
            const bayar = document.querySelector('input[name="jenis_pembayaran"]:checked');

            if (!layanan) { e.preventDefault(); alert('Pilih minimal satu layanan!'); return; }
            if (!terapis) { e.preventDefault(); alert('Pilih terapis!'); return; }
            if (!tgl) { e.preventDefault(); alert('Pilih tanggal!'); return; }
            if (!bayar) { e.preventDefault(); alert('Pilih jenis pembayaran!'); return; }
        });
        function cekFormLengkap() {

            const layanan = document.querySelectorAll('input[name="layanan_ids[]"]:checked').length;

            const terapis = document.querySelector('input[name="terapis_id"]:checked');

            const tanggal = document.getElementById('tgl_booking').value;

            const bayar = document.querySelector('input[name="jenis_pembayaran"]:checked');

            document.getElementById('btnBooking').disabled =
                !(layanan && terapis && tanggal && bayar);

        }
        document.getElementById('btnSimpanLayanan').addEventListener('click', function () {

            const layanan = [];

            document.querySelectorAll('input[name="layanan_ids[]"]:checked')
                .forEach(cb => {

                    const nama = cb.closest('label')
                        .querySelector('.fw-semibold')
                        .innerText
                        .trim();

                    layanan.push(nama);

                });

            let text = "Pilih layanan";

            if (layanan.length === 1) {

                text = layanan[0];

            } else if (layanan.length === 2) {

                text = layanan.join(", ");

            } else if (layanan.length > 2) {

                text = layanan[0] + " +" + (layanan.length - 1) + " layanan";

            }

            document.getElementById("dropdownTextLayanan").innerText = text;

            document.getElementById("btnDropdownLayanan").click();

        });
    </script>
</body>

</html>
