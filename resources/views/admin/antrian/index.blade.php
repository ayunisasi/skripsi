@extends('admin.layout')
@section('title', 'Data Antrean Hari Ini')
@section('content')

    <div class="card mb-4" style="background:linear-gradient(135deg,#1a3a2a,#2d5a3d);border:none;">
        <div class="card-body d-flex justify-content-between align-items-center py-3">
            <div>
                <h6 class="mb-0 fw-bold" style="color:#c9a84c">
                    <i class="bi bi-list-ol me-2"></i>Antrian Hari Ini
                </h6>
                <small style="color:rgba(255,255,255,0.7)">
                    {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                </small>
            </div>
            <span style="color:rgba(255,255,255,0.6);font-size:0.82rem">
                Antrian kemarin otomatis tersembunyi
            </span>
        </div>
    </div>

    @forelse($terapis as $t)
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge fw-semibold" style="background:#1a3a2a;color:#c9a84c;font-size:0.88rem;padding:7px 14px">
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
                                    <tr class="{{ $a->status === 'dilayani' ? 'table-warning' : '' }}">
                                        <td>
                                            <strong style="color:#1a3a2a;font-size:1.2rem">
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
                                                <span class="badge" style="background:#fff3e0;color:#f57c00">⏳ Menunggu</span>
                                            @elseif($a->status === 'dilayani')
                                                <span class="badge" style="background:#e8f5e9;color:#388e3c">▶ Dilayani</span>
                                            @elseif($a->status === 'selesai')
                                                <span class="badge" style="background:#e3f2fd;color:#1565c0">✅ Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($a->status === 'menunggu')
                                                <form action="/admin/antrian/{{ $a->id }}/panggil" method="POST" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-sm rounded-3 fw-semibold"
                                                        style="background:#1a3a2a;color:#c9a84c;border:none">
                                                        Panggil
                                                    </button>
                                                </form>
                                                <form action="/admin/antrian/{{ $a->id }}/keterlambatan" method="POST" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-warning btn-sm rounded-3"
                                                        onclick="return confirm('Proses keterlambatan?')">
                                                        Terlambat?
                                                    </button>
                                                </form>
                                            @elseif($a->status === 'dilayani')
                                                <form action="/admin/antrian/{{ $a->id }}/selesai" method="POST" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm rounded-3 fw-semibold">
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
@endsection