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
        :root{
    --gd:#1a3a2a;
    --gm:#2d5a3d;
    --gold:#c9a84c;
    --gold-l:#f5edd0;
    --cream:#faf7f0;
    --gl:#e8f5ee;
}

body{
    background:var(--cream);
    font-family:'Poppins',sans-serif;
    padding-top: 80px; /* penting banget */
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
        .card{
    border:1px solid rgba(201,168,76,0.2);
    border-radius:16px;
    background:white;
    box-shadow:0 3px 16px rgba(26,58,42,0.07);
}
        .section-title{
    color:var(--gd);
    font-weight:700;
    font-size:0.78rem;
    text-transform:uppercase;
    letter-spacing:1.5px;
    border-bottom:2px solid var(--gold-l);
    padding-bottom:8px;
    margin-bottom:14px;
}
        .layanan-card{
    border:1.5px solid rgba(201,168,76,0.2);
    border-radius:12px;
    padding:12px 14px;
    cursor:pointer;
    transition:all .2s;
    background:white;
    display:block;
}

.layanan-card:hover{
    border-color:var(--gold);
    background:var(--gold-l);
}

.layanan-card.selected{
    border-color:var(--gold);
    background:var(--gold-l);
    box-shadow:0 0 0 2px rgba(201,168,76,.3);
}
        .layanan-card input[type=checkbox] { display:none; }

.btn-pink{
    background:linear-gradient(135deg,var(--gold),#b8922e);
    color:var(--gd);
    border:none;
    border-radius:12px;
    font-weight:700;
}
.btn-pink:hover{
    background:linear-gradient(135deg,#b8922e,var(--gold));
    color:var(--gd);
}
.form-control,
.form-select{
    border:1.5px solid rgba(201,168,76,0.3);
    border-radius:10px;
}
       .form-control:focus,
.form-select:focus{
    border-color:var(--gold);
    box-shadow:0 0 0 3px rgba(201,168,76,0.15);
}
      .summary-box{
    background:linear-gradient(135deg,var(--gd),var(--gm));
    border-radius:14px;
    padding:16px;
    color:white;
    border:none;
}

.summary-box .text-muted{
    color:rgba(255,255,255,0.75) !important;
}

.summary-box .fw-semibold{
    color:#ffffff !important;
}

.summary-box .fw-bold{
    color:var(--gold) !important;
}
        .availability-badge {
            font-size:0.78rem; padding:4px 12px; border-radius:20px;
            display:inline-block; margin-top:4px;
        }
   .badge-available{
    background:#e8f5ee;
    color:var(--gd);
}
        .badge-full      { background:#ffebee; color:#c62828; }


.terapis-card-horizontal{
    width:100%;
    height:100%;
    display:flex;
    align-items:center;
    gap:15px;
    padding:18px;
    border:3px solid #c9a84c;
    border-radius:20px;
    background:white;
    transition:.3s;
    cursor:pointer;
}

.terapis-card-horizontal {
    position: relative;
    display:flex;
    align-items:center;
    gap:15px;
    padding:18px;
    border-radius:20px;
    background:
        linear-gradient(white, white) padding-box,
        linear-gradient(135deg, #c9a84c, #f5e1a0) border-box;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: all .3s;
    cursor:pointer;
}

.terapis-card-horizontal:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.terapis-card-horizontal::after {
    content:"";
    position:absolute;
    inset:0;
    border-radius:20px;
    box-shadow: inset 0 0 0 1px rgba(255,255,255,0.3);
    pointer-events:none;
}
.terapis-foto-horizontal{
    width:70px;
    height:70px;
    border-radius:50%;
    object-fit:cover;

    border:4px solid #1a3a2a;


    box-shadow:0 4px 10px rgba(26,58,42,.25);
}
.terapis-info{
    flex:1;
}

.terapis-info h5{
    margin-bottom:3px;
    font-size:16px;
}

.tag-wrap{
    display:flex;
    flex-wrap:wrap;
    gap:5px;
    margin-top:5px;
}

.tag{
    background:#fff0f0;
    color:#d46a6a;
    border-radius:10px;
    padding:2px 6px;
    font-size:10px;
}

.badge-ai{
    display:inline-block;
    background:#d4af37;
    color:white;
    padding:4px 10px;
    border-radius:20px;
    font-size:11px;
    margin-bottom:10px;
}

.rating{
    font-size:22px;
    font-weight:bold;
    color:#d4af37;
    margin-bottom:10px;
}

.rating-badge{
    display:inline-block;
    background:#fff8e1;
    color:#b8860b;

    padding:4px 10px;
    border-radius:20px;

    font-size:13px;
    font-weight:600;
}

.statistik{
    display:flex;
    justify-content:center;
    gap:30px;
    margin:15px 0;
}

.mini-stat{
    font-size:12px;
    color:#666;
    margin-top:5px;
}

.container{
    max-width:850px !important;
}

.terapis-card-horizontal.selected{
    border:3px solid #1a3a2a;
    background:#f8fff8;
    box-shadow:0 0 15px rgba(26,58,42,.15);
}

.disabled-card{
    opacity:.5;
    cursor:not-allowed;
    background:#f5f5f5;
    pointer-events:none !important;
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
    <div class="d-flex align-items-center gap-3">
        <a href="/booking/riwayat" class="btn btn-outline-danger btn-sm rounded-pill">
            <i class="bi bi-clock-history"></i> Riwayat
        </a>
        <span class="small" style="color:var(--gold)">
    {{ Auth::user()->nama_lengkap }}
</span>
        <form action="/logout" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-outline-secondary btn-sm rounded-pill">Logout</button>
        </form>
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
            <input type="text" class="form-control"
                value="{{ Auth::user()->nama_lengkap }}" disabled
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
    <button class="form-select text-start" type="button"
        data-bs-toggle="dropdown"
        data-bs-auto-close="outside">
        Pilih layanan
    </button>

    <ul class="dropdown-menu w-100 p-2" style="max-height:250px; overflow:auto;">
            @foreach($layanan as $l)
            <li>
                <label class="dropdown-item layanan-card d-flex justify-content-between align-items-start
                    {{ is_array(old('layanan_ids')) && in_array($l->id, old('layanan_ids')) ? 'selected' : '' }}"
                    data-harga="{{ $l->harga }}"
                    data-durasi="{{ $l->durasi }}"
                    onclick="toggleLayanan(this)">

                    <input type="checkbox"
                        name="layanan_ids[]"
                        value="{{ $l->id }}"
                        class="me-2"
                        {{ is_array(old('layanan_ids')) && in_array($l->id, old('layanan_ids')) ? 'checked' : '' }}>

                    <div style="width:100%">
                        <div class="fw-semibold" style="font-size:0.9rem; color:#2d1b20">
                            {{ $l->nama_layanan }}
                        </div>

                        <small style="color:#9a7b82">
                            <i class="bi bi-clock"></i> {{ $l->durasi }} menit
                        </small>
                    </div>

                    <span class="fw-bold ms-2" style="color:#b5485a;font-size:0.85rem">
                        Rp {{ number_format($l->harga, 0, ',', '.') }}
                    </span>

                </label>
            </li>
            @endforeach

        </ul>
    </div>
</div>

      {{-- PILIH TANGGAL --}}
<div class="card p-4 mb-3">
    <div class="section-title">Pilih Tanggal/Hari</div>

    <select class="form-select"
        onchange="pilihTanggal(this.value)"
        style="font-size:0.9rem;">

        <option value="">Pilih Tanggal</option>

@foreach($tanggalTersedia as $tgl)
    <option value="{{ $tgl['value'] }}"
        {{ old('tgl_booking') == $tgl['value'] ? 'selected' : '' }}>

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


<div class="row row-terapis justify-content-center g-3">

@foreach($terapis as $t)

<div class="col-md-6 mb-3">

<div class="terapis-card-horizontal
    {{ !$t->tersedia ? 'disabled-card' : '' }}"
    @if($t->tersedia)
        onclick="pilihTerapis(this)"
    @endif>

    <img src="{{ asset('images/terapis1.jpg') }}"
         class="terapis-foto-horizontal">

    <div class="terapis-info">

        @if($loop->first)
            <span class="badge-ai">
                🏆 Terapis Unggulan
            </span>
        @endif

        <h5>{{ $t->nama_terapis }}</h5>
        @if(!$t->tersedia)
    <div class="badge bg-danger mb-2">
        Penuh
    </div>
@endif

<div class="rating-badge">
    ⭐ {{ $t->rating_rata }}
</div>

               <div class="mini-stat">
     {{ $t->jumlah_booking }} Booking
    •
     {{ $t->jumlah_review }} Review
</div>

        <div class="tag-wrap mt-2">

@if($t->ramah > 0)
    <span class="tag">Ramah ({{ $t->ramah }})</span>
@endif

@if($t->rapi > 0)
    <span class="tag">Rapi ({{ $t->rapi }})</span>
@endif

@if($t->bersih > 0)
    <span class="tag">Bersih ({{ $t->bersih }})</span>
@endif

@if($t->profesional > 0)
    <span class="tag">Profesional ({{ $t->profesional }})</span>
@endif

@if($t->tepat_waktu > 0)
    <span class="tag">Tepat Waktu ({{ $t->tepat_waktu }})</span>
@endif

        </div>

        <div class="mt-2">
    <input type="radio"
       name="terapis_id"
       value="{{ $t->id }}"
       {{ !$t->tersedia ? 'disabled' : '' }}
       required>

            Pilih Terapis
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
                <div class="d-flex justify-content-between" style="font-size:0.95rem">
                    <span class="fw-bold">Total Harga</span>
                    <span id="summary-total" class="fw-bold" style="color:#b5485a">-</span>
                </div>
            </div>

            {{-- Pilih Jenis Pembayaran --}}
            <div class="section-title mt-3">Pilih Jenis Pembayaran</div>
            <div class="card p-3">

    <div class="row g-2">

        {{-- DP --}}
        <div class="col-6">
            <label class="p-3 text-center w-100"
                style="border:1.5px solid #f0e0e3; border-radius:10px; cursor:pointer;"
                id="bayar-dp"
                onclick="pilihBayar('dp', this)">

                <input type="radio" name="jenis_pembayaran" value="dp" style="display:none">

                <div class="fw-semibold">DP 30%</div>
                <div id="dp-amount" style="color:#b5485a; font-size:0.85rem">Rp -</div>
            </label>
        </div>

        {{-- FULL --}}
        <div class="col-6">
            <label class="p-3 text-center w-100"
                style="border:1.5px solid #f0e0e3; border-radius:10px; cursor:pointer;"
                id="bayar-full"
                onclick="pilihBayar('full', this)">

                <input type="radio" name="jenis_pembayaran" value="full" style="display:none">

                <div class="fw-semibold">Full</div>
                <div id="full-amount" style="color:#b5485a; font-size:0.85rem">Rp -</div>
            </label>
        </div>
       <div class="mt-2 text-center" style="font-size:0.78rem;color:#8c6d1f;">
    <i class="bi bi-info-circle-fill"></i>
    Terlambat >15 menit / tidak hadir → pembayaran hangus.
</div>

    </div>
</div>
        </div>

        <button type="submit" class="btn btn-pink w-100 py-3 fw-semibold" style="font-size:1rem">
    <i class="bi bi-arrow-right-circle me-2"></i>
    Lanjut ke Pembayaran
</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
let selectedTgl   = '{{ old('tgl_booking') }}';


function pilihTerapis(card){

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
}

// Toggle layanan
function toggleLayanan(card) {
    const cb = card.querySelector('input[type=checkbox]');
    cb.checked = !cb.checked;
    card.classList.toggle('selected', cb.checked);
    updateSummary();

}

// Pilih tanggal (dropdown)
function pilihTanggal(val) {
    document.getElementById('tgl_booking').value = val;
    selectedTgl = val;

}



// Pilih jenis bayar
function pilihBayar(val, el) {
    document.querySelectorAll('[id^="bayar-"]').forEach(e => {
        e.style.borderColor = '#f0e0e3';
        e.style.background  = 'white';
    });
    el.style.borderColor = '#b5485a';
    el.style.background  = '#fff0f3';
    el.querySelector('input[type=radio]').checked = true;
}

// Update summary
function updateSummary() {
    let totalHarga  = 0;
    let totalDurasi = 0;
    let namaLayanan = [];

    document.querySelectorAll('input[name="layanan_ids[]"]:checked').forEach(cb => {
        const card = cb.closest('label');
        totalHarga  += parseInt(card.dataset.harga || 0);
        totalDurasi += parseInt(card.dataset.durasi || 0);
        namaLayanan.push(card.querySelector('.fw-semibold').innerText.trim());
    });

    const fmt = v => 'Rp ' + new Intl.NumberFormat('id-ID').format(v);

    document.getElementById('summary-layanan').textContent =
        namaLayanan.length > 0 ? namaLayanan.join(', ') : '-';
    document.getElementById('summary-durasi').textContent =
        totalDurasi > 0 ? totalDurasi + ' menit' : '-';
    document.getElementById('summary-total').textContent =
        totalHarga > 0 ? fmt(totalHarga) : '-';
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

    radio.addEventListener('change', function() {

        const namaTerapis =
            this.closest('.terapis-card-horizontal')
            .querySelector('h5').innerText;

        document.getElementById('summary-terapis').textContent =
            namaTerapis;

        updateSummary();
    });

});

// Validasi submit
document.getElementById('formBooking').addEventListener('submit', function(e) {
    const layanan = document.querySelectorAll('input[name="layanan_ids[]"]:checked').length;
    const terapis = document.getElementById('terapis_id').value;
    const tgl     = document.getElementById('tgl_booking').value;
    const bayar   = document.querySelector('input[name="jenis_pembayaran"]:checked');

    if (!layanan) { e.preventDefault(); alert('Pilih minimal satu layanan!'); return; }
    if (!terapis) { e.preventDefault(); alert('Pilih terapis!'); return; }
    if (!tgl)     { e.preventDefault(); alert('Pilih tanggal!'); return; }
    if (!bayar)   { e.preventDefault(); alert('Pilih jenis pembayaran!'); return; }
});
</script>
</body>
</html>
