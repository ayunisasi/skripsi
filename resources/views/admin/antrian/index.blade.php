@extends('admin.layout')
@section('title', 'Data Antrean Hari Ini')
@section('content')

    <div class="card mb-4" style="background:#faf7ff;border:1px solid #e9d5ff;">
        <div class="card-body d-flex justify-content-between align-items-center py-3">
            <div>
                <h6 class="mb-0 fw-bold" style="color: black">
                    <i class="bi bi-list-ol me-2"></i>Antrian Hari Ini
                </h6>
                <small style="color:#8b5cf6">
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                </small>
            </div>
            {{-- <span style="color: black;font-size:0.82rem">
                Antrian kemarin otomatis tersembunyi
            </span> --}}
        </div>
    </div>

    @forelse($terapis as $t)
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge fw-semibold"
                        style="background:#f5f3ff;color:#7c3aed;border:1px solid #d8b4fe;font-size:0.88rem;padding:7px 14px">
                        <i class="bi bi-person-badge me-1"></i>{{ $t->nama_terapis }}
                    </span>
                </div>

                @php
                    $data = isset($antrians[$t->id])
                        ? $antrians[$t->id]->whereNotIn('status', ['dibatalkan'])
                        : collect();
                @endphp

                @if($data->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>No. Antrian</th>
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
                                @foreach($data->sortBy('nomor_antrian') as $a)
                                    <tr class="{{ $a->status === 'dilayani' ? 'row-active' : '' }}">
                                        <td>
                                            <strong style="color:#7c3aed;font-size:1.2rem">
                                                {{ $a->nomor_antrian }}
                                            </strong>
                                        </td>
                                        <td>{{ $a->booking->user->nama_lengkap }}</td>
                                        <td><small>{{ $a->booking->layanan->pluck('nama_layanan')->join(', ') }}</small></td>
                                        <td><strong>{{ $a->estimasi_jam_mulai }}</strong></td>
                                        <td>{{ $a->estimasi_jam_selesai }}</td>
                                        <td>{{ $a->total_durasi }} mnt</td>
                                        <td>
                                            @if($a->status === 'menunggu')
    <span class="badge" style="background:#fff3e0;color:#f57c00">
        ⏳ Menunggu
    </span>

@elseif($a->status === 'dipanggil')
    <span class="badge" style="background:#ede9fe;color:#6d28d9">
        📢 Dipanggil
    </span>

@elseif($a->status === 'dilayani')
    <span class="badge" style="background:#e8f5e9;color:#388e3c">
        ▶ Dilayani
    </span>

@elseif($a->status === 'selesai')
    <span class="badge" style="background:#e3f2fd;color:#1565c0">
        ✅ Selesai
    </span>
@endif
                                        </td>
                                        <td>
                                            @if($a->status === 'menunggu')

    <form action="{{ route('admin.antrian.panggil', $a->id) }}" method="POST" class="d-inline">
        @csrf
        <button class="btn btn-sm rounded-3 fw-semibold"
            style="background:#f5f3ff;color:#7c3aed;border:1px solid #d8b4fe;">
            📢 Panggil
        </button>
    </form>

@elseif($a->status === 'dipanggil')

    <form action="{{ route('admin.antrian.layani', $a->id) }}" method="POST" class="d-inline">
        @csrf
        <button class="btn btn-sm rounded-3 fw-semibold"
            style="background:#ecfdf5;color:#16a34a;border:1px solid #bbf7d0;">
            ▶ Layani
        </button>
    </form>

@elseif($a->status === 'dilayani')

    <form action="{{ route('admin.antrian.selesai', $a->id) }}" method="POST" class="d-inline">
        @csrf
        <button class="btn btn-sm rounded-3 fw-semibold"
            style="background:#dbeafe;color:#2563eb;border:1px solid #93c5fd;">
            ✅ Selesai
        </button>
    </form>

@endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted small mb-0">Belum ada antrian hari ini untuk terapis ini.</p>
                @endif
            </div>
        </div>
    @empty
        <div class="card p-4 text-center text-muted">Belum ada terapis aktif.</div>
    @endforelse

    <script>
document.addEventListener('DOMContentLoaded', function () {

    // Kembalikan posisi scroll setelah halaman selesai dimuat
    const scrollPos = sessionStorage.getItem('antrianScroll');

    if (scrollPos) {
        window.scrollTo(0, parseInt(scrollPos));
        sessionStorage.removeItem('antrianScroll');
    }

    // Simpan posisi scroll saat klik tombol aksi
    document.querySelectorAll('form').forEach(function(form) {

        form.addEventListener('submit', function() {

            sessionStorage.setItem('antrianScroll', window.scrollY);

        });

    });

});
</script>
@endsection
