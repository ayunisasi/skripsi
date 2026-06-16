@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')

    <div class="row g-4 mb-4">

        {{-- Total Pelanggan --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100"
                style="border-radius:20px;background:linear-gradient(135deg,#1a3a2a,#2d5a3d);">
                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <div style="font-size:0.85rem;color:rgba(255,255,255,.7)">
                            Total Pelanggan
                        </div>
                        <h2 class="fw-bold mb-0 text-white">
                            {{ $totalPelanggan }}
                        </h2>
                        <small style="color:#c9a84c">
                            Pelanggan terdaftar
                        </small>
                    </div>

                    <div style="
                        width:70px;
                        height:70px;
                        border-radius:18px;
                        background:rgba(255,255,255,.12);
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        font-size:2rem;">
                        👥
                    </div>
                </div>
            </div>
        </div>

        {{-- Selesai Hari Ini --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100"
                style="border-radius:20px;background:linear-gradient(135deg,#c9a84c,#e8c96e);">
                <div class="card-body p-4 d-flex justify-content-between align-items-center">
                    <div>
                        <div style="font-size:0.85rem;color:rgba(0,0,0,.6)">
                            Selesai Hari Ini
                        </div>
                        <h2 class="fw-bold mb-0 text-dark">
                            {{ $layananSelesaiHariIni }}
                        </h2>
                        <small style="color:#1a3a2a">
                            Layanan telah selesai
                        </small>
                    </div>

                    <div style="
                        width:70px;
                        height:70px;
                        border-radius:18px;
                        background:rgba(255,255,255,.35);
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        font-size:2rem;">
                        ✅
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card">
        <div class="card-body">
            <div
                style="background:linear-gradient(135deg,#1a3a2a,#2d5a3d);border-radius:10px;padding:14px 18px;margin-bottom:18px;display:flex;justify-content:space-between;align-items:center">
                <div>
                    <span style="color:#c9a84c;font-weight:700;font-size:0.95rem">
                        <i class="bi bi-list-ol me-2"></i>Antrian Hari Ini
                    </span>
                    <div style="color:rgba(255,255,255,0.6);font-size:0.78rem;margin-top:2px">
                        {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                    </div>
                </div>
                <a href="/admin/antrian" style="color:#c9a84c;font-size:0.82rem;text-decoration:none">
                    Lihat Semua →
                </a>
            </div>

            @forelse($terapisList as $terapis)
                <div class="mb-4">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge" style="background:#1a3a2a;color:#c9a84c;padding:6px 14px">
                            {{ $terapis->nama_terapis }}
                        </span>
                    </div>
                    @if(isset($antrians[$terapis->id]) && $antrians[$terapis->id]->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No. Antrian</th>
                                        <th>Pelanggan</th>
                                        <th>Layanan</th>
                                        <th>Est. Mulai</th>
                                        <th>Est. Selesai</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($antrians[$terapis->id] as $a)
                                        <tr>
                                            <td><strong style="color:#1a3a2a">{{ $a->nomor_antrian }}</strong></td>
                                            <td>{{ $a->booking->user->nama_lengkap }}</td>
                                            <td><small>{{ $a->booking->layanan->pluck('nama_layanan')->join(', ') }}</small></td>
                                            <td>{{ $a->estimasi_jam_mulai }}</td>
                                            <td>{{ $a->estimasi_jam_selesai }}</td>
                                            <td>
                                                @if($a->status === 'menunggu')
                                                    <span class="badge badge-menunggu">⏳ Menunggu</span>
                                                @elseif($a->status === 'dilayani')
                                                    <span class="badge badge-green">▶ Dilayani</span>
                                                @else
                                                    <span class="badge badge-selesai">✅ Selesai</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted small">Tidak ada antrian hari ini.</p>
                    @endif
                </div>
            @empty
                <p class="text-muted">Belum ada terapis aktif.</p>
            @endforelse
        </div>
    </div>
@endsection