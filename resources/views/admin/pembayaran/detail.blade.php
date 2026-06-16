@extends('admin.layout')
@section('title', 'Detail Pembayaran')

@section('content')

    <div class="container py-4 pt-1">
        <div class="row g-4">

            {{-- LEFT: DATA BOOKING --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3" style="color:#1a3a2a">Data Booking & Pelanggan</h6>

                        <div class="row g-2" style="font-size:0.88rem">
                            <div class="col-5 text-muted">Kode Booking</div>
                            <div class="col-7 font-monospace">{{ $booking->kd_booking }}</div>

                            <div class="col-5 text-muted">Nama Pelanggan</div>
                            <div class="col-7">{{ $booking->user->nama_lengkap }}</div>

                            <div class="col-5 text-muted">No. Telepon</div>
                            <div class="col-7">{{ $booking->user->no_telp }}</div>

                            <div class="col-5 text-muted">Terapis</div>
                            <div class="col-7">{{ $booking->terapis->nama_terapis ?? '-' }}</div>

                            <div class="col-5 text-muted">Tanggal</div>
                            <div class="col-7">
                                {{ \Carbon\Carbon::parse($booking->tgl_booking)->format('d/m/Y') }}
                            </div>

                            <div class="col-5 text-muted">Status</div>
                            <div class="col-7">
                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: RINGKASAN --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3" style="color:#1a3a2a">Ringkasan Pembayaran</h6>

                        <div class="d-flex justify-content-between mb-2" style="font-size:0.88rem">
                            <span class="text-muted">Total Tagihan</span>
                            <span class="fw-bold">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2" style="font-size:0.88rem">
                            <span class="text-muted">Sudah Dibayar</span>
                            <span class="fw-bold text-success">
                                Rp {{ number_format($booking->jumlah_dibayar, 0, ',', '.') }}
                            </span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between" style="font-size:0.95rem">
                            <span class="fw-bold">Sisa Bayar</span>
                            <span class="fw-bold" style="color:#c9a84c">
                                Rp {{ number_format($booking->sisaBayar(), 0, ',', '.') }}
                            </span>
                        </div>

                    </div>
                </div>
            </div>

            {{-- LAYANAN --}}
            <div class="col-md-6">
                <div class="card" style="margin-top:-10px;">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3" style="color:#1a3a2a">Detail Layanan</h6>

                        @foreach($booking->layanan as $l)
                            <div class="d-flex justify-content-between py-1 border-bottom" style="font-size:0.88rem">
                                <span>{{ $l->nama_layanan }}</span>
                                <span>Rp {{ number_format($l->harga, 0, ',', '.') }}</span>
                            </div>
                        @endforeach

                        @if($booking->produkTambahan->count() > 0)
                            <p class="fw-semibold mt-3 mb-2" style="color:#1a3a2a;font-size:0.9rem">
                                Tambahan
                            </p>

                            @foreach($booking->produkTambahan as $pt)
                                <div class="d-flex justify-content-between py-1 border-bottom" style="font-size:0.88rem">
                                    <span>
                                        {{ $pt->nama_item }}
                                        <small class="text-muted">({{ $pt->tipe }})</small>
                                    </span>
                                    <span>Rp {{ number_format($pt->harga, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            {{-- TRANSAKSI --}}
            <div class="col-md-6 mt-0">
                <div class="card" style="margin-top:-50px;">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3" style="color:#1a3a2a">Riwayat Transaksi</h6>

                        @forelse($booking->pembayaran as $p)
                            <div class="border rounded p-2 mb-2" style="font-size:0.82rem">
                                <div class="d-flex justify-content-between">
                                    <span class="font-monospace">{{ $p->kd_pembayaran }}</span>
                                    <span class="badge bg-success">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </div>

                                <div class="text-muted">
                                    {{ ucfirst($p->tipe) }} — {{ strtoupper($p->metode) }}
                                </div>

                                <div class="fw-bold">
                                    Rp {{ number_format($p->jumlah, 0, ',', '.') }}
                                </div>

                                <div class="text-muted">
                                    {{ $p->tgl_bayar ? $p->tgl_bayar->format('d/m/Y H:i') : '-' }}
                                </div>
                            </div>
                        @empty
                            <p class="text-muted small">Belum ada transaksi.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>

        {{-- BUTTON BACK (FIXED) --}}
        <div class="mt-3">
            <a href="/admin/pembayaran" class="btn btn-secondary">
                ← Kembali
            </a>
        </div>
    </div>

@endsection