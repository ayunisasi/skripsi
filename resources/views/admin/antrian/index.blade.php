
@extends('admin.layout')
@section('title', 'Data Antrean Hari Ini')
@section('content')

    <div class="card mb-4" style="background:#faf7ff;border:1px solid #e9d5ff;">
        <div class="card-body d-flex justify-content-between align-items-center py-3">
            <div>
                <h6 class="mb-0 fw-bold" style="color:black">
                    <i class="bi bi-list-ol me-2"></i>Antrean Hari Ini
                </h6>
                <small style="color:#8b5cf6">
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                </small>
            </div>
        </div>
    </div>

    @forelse($terapis as $t)

        @php
            $data = isset($antrians[$t->id])
                ? $antrians[$t->id]->whereNotIn('status', ['dibatalkan'])
                : collect();

            // Antrean sedang diproses dan selesai
            $riwayatAktif = $data->whereIn('status', [
                'dipanggil',
                'dilayani',
                'selesai'
            ])->sortBy('nomor_antrian');

            // Antrean menunggu
            $menunggu = $data->where('status', 'menunggu')
                ->sortBy('nomor_antrian');

            // Antrean sedang diproses
            $diproses = $data->whereIn('status', [
                'dipanggil',
                'dilayani'
            ]);
        @endphp

        <div class="card mb-4">
            <div class="card-body">

                {{-- NAMA TERAPIS --}}
<div class="d-flex align-items-center gap-2 mb-3">
    <span class="badge fw-bold"
        style="background:#ede9fe;
               color:#5b21b6;
               border:1px solid #a78bfa;
               font-size:1rem;
               padding:9px 18px;
               border-radius:6px;">
        {{ $t->nama_terapis }}
    </span>
</div>

                {{-- TABEL ANTREAN SEDANG DIPROSES DAN SELESAI --}}
                <h6 class="fw-bold mb-3">
                    Antrean Sedang Diproses & Selesai
                </h6>

                @if($riwayatAktif->count() > 0)

                    <div class="table-responsive mb-4">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>No. Antrean</th>
                                    <th>Pelanggan</th>
                                    <th>Layanan</th>
                                    <th>Est. Mulai</th>
                                    <th>Est. Selesai</th>
                                    <th>Durasi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($riwayatAktif as $a)
                                    <tr class="{{ $a->status === 'dilayani' ? 'row-active' : '' }}">

                                        <td>
                                            <strong style="color:#7c3aed;font-size:1.2rem">
                                                {{ $a->nomor_antrian }}
                                            </strong>
                                        </td>

                                        <td>{{ $a->booking->user->nama_lengkap }}</td>

                                        <td>
                                            <small>
                                                {{ $a->booking->layanan->pluck('nama_layanan')->join(', ') }}
                                            </small>
                                        </td>

                                        <td>
                                            <strong>{{ $a->estimasi_jam_mulai }}</strong>
                                        </td>

                                        <td>{{ $a->estimasi_jam_selesai }}</td>

                                        <td>{{ $a->total_durasi }} mnt</td>

                                        {{-- STATUS --}}
                                        <td>
                                            @if($a->status === 'dipanggil')
                                                <span class="badge"
                                                    style="background:#ede9fe;color:#6d28d9">
                                                    Dipanggil
                                                </span>

                                            @elseif($a->status === 'dilayani')
                                                <span class="badge"
                                                    style="background:#e8f5e9;color:#388e3c">
                                                    Dilayani
                                                </span>

                                            @elseif($a->status === 'selesai')
                                                <span class="badge"
                                                    style="background:#e3f2fd;color:#1565c0">
                                                    Selesai
                                                </span>
                                            @endif
                                        </td>

                                        {{-- AKSI ADMIN --}}
                                        <td>
                                            @if($a->status === 'dipanggil')

                                                <form action="{{ route('admin.antrian.layani', $a->id) }}"
                                                    method="POST" class="form-antrian d-inline">
                                                    @csrf

                                                    <button type="submit"
                                                        class="btn btn-sm rounded-3 fw-semibold"
                                                        style="background:#ecfdf5;color:#16a34a;border:1px solid #bbf7d0;"
                                                        onclick="return confirm('Mulai melayani {{ $a->booking->user->nama_lengkap }}?')">
                                                        Layani
                                                    </button>
                                                </form>

                                            @elseif($a->status === 'dilayani')

                                                <form action="{{ route('admin.antrian.selesai', $a->id) }}"
                                                    method="POST" class="form-antrian d-inline">
                                                    @csrf

                                                    <button type="submit"
                                                        class="btn btn-sm rounded-3 fw-semibold"
                                                        style="background:#dbeafe;color:#2563eb;border:1px solid #93c5fd;"
                                                        onclick="return confirm('Selesaikan pelayanan {{ $a->booking->user->nama_lengkap }}?')">
                                                        Selesai
                                                    </button>
                                                </form>

                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                @else
                    <p class="text-muted small mb-4">
                        Belum ada antrean yang dipanggil atau selesai.
                    </p>
                @endif





{{-- CARD PANGGIL ANTREAN BERIKUTNYA --}}
<div class="card mb-4"
    style="background:#faf7ff; border:1px solid #e9d5ff; border-radius:8px;">

    <div class="card-body text-center ">

        <form action="{{ route('admin.antrian.panggilBerikutnya', $t->id) }}"
            method="POST" class="form-antrian">

            @csrf

            <button type="submit"
                class="btn btn-sm px-4 py-2 fw-semibold"
                style="background:#7c3aed; color:white; font-size:15px; border-radius:5px; min-width:190px;"
                {{ $diproses->count() > 0 || $menunggu->count() == 0 ? 'disabled' : '' }}
                onclick="return confirm('Panggil antrean berikutnya untuk {{ $t->nama_terapis }}?')">

                PANGGIL ANTREAN BERIKUTNYA
            </button>
        </form>

    </div>
</div>


                {{-- TABEL DAFTAR ANTREAN MENUNGGU --}}
                <h6 class="fw-bold mb-3">
                    Daftar Antrean Menunggu
                </h6>

                @if($menunggu->count() > 0)

                    <div class="table-responsive mb-3">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>No. Antrean</th>
                                    <th>Pelanggan</th>
                                    <th>Layanan</th>
                                    <th>Est. Mulai</th>
                                    <th>Est. Selesai</th>
                                    <th>Durasi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($menunggu as $a)
                                    <tr>
                                        <td>
                                            <strong style="color:#7c3aed;font-size:1.2rem">
                                                {{ $a->nomor_antrian }}
                                            </strong>
                                        </td>

                                        <td>{{ $a->booking->user->nama_lengkap }}</td>

                                        <td>
                                            <small>
                                                {{ $a->booking->layanan->pluck('nama_layanan')->join(', ') }}
                                            </small>
                                        </td>

                                        <td>
                                            <strong>{{ $a->estimasi_jam_mulai }}</strong>
                                        </td>

                                        <td>{{ $a->estimasi_jam_selesai }}</td>

                                        <td>{{ $a->total_durasi }} mnt</td>

                                        <td>
                                            <span class="badge"
                                                style="background:#fff3e0;color:#f57c00">
                                                Menunggu
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                @else
                    <p class="text-muted small mb-3">
                        Belum ada antrean menunggu untuk terapis ini.
                    </p>
                @endif

            </div>
        </div>

    @empty

        <div class="card p-4 text-center text-muted">
            Belum ada terapis aktif.
        </div>

    @endforelse


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Mengembalikan posisi scroll setelah halaman dimuat
            const scrollPos = sessionStorage.getItem('antrianScroll');

            if (scrollPos !== null) {
                window.scrollTo(0, parseInt(scrollPos));
                sessionStorage.removeItem('antrianScroll');
            }

            // Menyimpan posisi scroll saat tombol aksi diklik
            document.querySelectorAll('.form-antrian').forEach(function(form) {
                form.addEventListener('submit', function() {
                    sessionStorage.setItem('antrianScroll', window.scrollY);
                });
            });

        });
    </script>

@endsection
