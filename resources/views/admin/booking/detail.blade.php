@extends('admin.layout')
@section('title', 'Detail Booking')
@section('content')

    <div class="row g-4">
        {{-- Info Booking --}}
        <div class="col-md-7">
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3" style="color:#b5485a">
                        <i class="bi bi-info-circle me-2"></i>Data Booking & Pelanggan
                    </h6>
                    <div class="row g-2" style="font-size:0.88rem">
                        <div class="col-5 text-muted">Kode Booking</div>
                        <div class="col-7 font-monospace fw-semibold">{{ $booking->kd_booking }}</div>
                        <div class="col-5 text-muted">Nama Pelanggan</div>
                        <div class="col-7">{{ $booking->user->nama_lengkap }}</div>
                        <div class="col-5 text-muted">No. Telepon</div>
                        <div class="col-7">{{ $booking->user->no_telp }}</div>
                        <div class="col-5 text-muted">Terapis</div>
                        <div class="col-7">{{ $booking->terapis->nama_terapis ?? '-' }}</div>
                        <div class="col-5 text-muted">Tanggal</div>
                        <div class="col-7">{{ \Carbon\Carbon::parse($booking->tgl_booking)->isoFormat('dddd, D MMMM Y') }}
                        </div>


                        <div class="col-5 text-muted">Nomor Antrian</div>
                        <div class="col-7">
                            <strong style="color:#b5485a;font-size:1.2rem">
                                {{ $booking->nomor_antrian ?? '-' }}
                            </strong>
                        </div>
                        <div class="col-5 text-muted">Estimasi Dilayani</div>
                        <div class="col-7">{{ $booking->estimasi_jam ?? '-' }}</div>
                        <div class="col-5 text-muted">Status Booking</div>
                        <div class="col-7">
                            <span
                                class="badge badge-{{ $booking->status === 'aktif' ? 'aktif' : ($booking->status === 'selesai' ? 'selesai' : 'batal') }}">
                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Detail Layanan --}}
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3" style="color:#b5485a">
                        <i class="bi bi-scissors me-2"></i>Detail Layanan
                    </h6>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Layanan</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($booking->layanan as $i => $l)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $l->nama_layanan }}</td>
                                    <td>Rp {{ number_format($l->harga, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Produk/Layanan Tambahan --}}
                    @if($booking->produkTambahan->count() > 0)
                        <div class="mt-3">
                            <p class="fw-semibold small mb-2" style="color:#b5485a">
                                Produk/Layanan Tambahan di Lokasi:
                            </p>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Item</th>
                                        <th>Tipe</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($booking->produkTambahan as $i => $pt)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $pt->nama_item }}</td>
                                            <td><span class="badge"
                                                    style="background:#f3e5f5;color:#6a1b9a">{{ ucfirst($pt->tipe) }}</span></td>
                                            <td>Rp {{ number_format($pt->harga, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Tambah Item --}}
            @if(!in_array($booking->status, ['selesai', 'dibatalkan', 'dibatalkan_sistem']))
                <div class="card mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3" style="color:#b5485a">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Layanan/Produk di Lokasi
                        </h6>
                        <form action="/admin/booking/{{ $booking->id }}/tambah-item" method="POST">
                            @csrf
                            <div class="row g-2">
                                <div class="col-md-5">
                                    <input type="text" name="nama_item" class="form-control form-control-sm"
                                        placeholder="Nama layanan/produk" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="harga" class="form-control form-control-sm"
                                        placeholder="Harga (Rp)" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="durasi" class="form-control form-control-sm"
                                        placeholder="Durasi (mnt)">
                                </div>
                                <div class="col-md-2">
                                    <select name="tipe" class="form-select form-select-sm">
                                        <option value="layanan">Layanan</option>
                                        <option value="produk">Produk</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <input type="text" name="catatan" class="form-control form-control-sm"
                                        placeholder="Catatan (opsional)">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-sm btn-pink">
                                        + Tambah Item
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        {{-- Ringkasan Pembayaran --}}
        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3" style="color:#b5485a">
                        <i class="bi bi-cash-coin me-2"></i>Ringkasan Pembayaran
                    </h6>
                    <div style="font-size:0.88rem">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Total Tagihan</span>
                            <span class="fw-semibold">
                                Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Sudah Dibayar</span>
                            <span class="fw-semibold text-success">
                                Rp {{ number_format($booking->jumlah_dibayar, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Metode Awal</span>
                            <span>{{ strtoupper($booking->jenis_pembayaran) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">Sisa Bayar</span>
                            <span class="fw-bold" style="color:#b5485a;font-size:1.1rem">
                                Rp {{ number_format($booking->sisaBayar(), 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-muted">Status Bayar</span>
                            @if($booking->status_pembayaran === 'lunas')
                                <span class="badge badge-aktif">Lunas</span>
                            @elseif($booking->status_pembayaran === 'dp_lunas')
                                <span class="badge" style="background:#e3f2fd;color:#1565c0">DP Lunas</span>
                            @else
                                <span class="badge badge-menunggu">Belum Lunas</span>
                            @endif
                        </div>
                    </div>

                    {{-- Tombol Konfirmasi Pelunasan --}}
                    @if($booking->sisaBayar() > 0 && $booking->antrian && $booking->antrian->status === 'selesai')
                        <div class="mt-3 pt-3 border-top">
                            <form action="/admin/booking/{{ $booking->id }}/konfirmasi-cash" method="POST"
                                onsubmit='return confirm("Konfirmasi pelunasan tunai Rp {{ number_format($booking->sisaBayar(), 0, ",", ".") }}?")'
                                @csrf <button type="submit" class="btn btn-success w-100 rounded-3">
                                <i class="bi bi-cash me-1"></i>
                                Konfirmasi Lunas (Tunai)
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Riwayat Pembayaran --}}
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3" style="color:#b5485a">
                        <i class="bi bi-receipt me-2"></i>Riwayat Pembayaran
                    </h6>
                    @forelse($booking->pembayaran as $p)
                        <div class="border rounded-3 p-2 mb-2" style="font-size:0.82rem">
                            <div class="d-flex justify-content-between">
                                <span class="font-monospace">{{ $p->kd_pembayaran }}</span>
                                <span class="badge {{ $p->status === 'lunas' ? 'badge-aktif' : 'badge-menunggu' }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </div>
                            <div class="text-muted">
                                {{ ucfirst($p->tipe) }} — {{ strtoupper($p->metode) }}
                            </div>
                            <div class="fw-semibold">
                                Rp {{ number_format($p->jumlah, 0, ',', '.') }}
                            </div>
                        </div>
                    @empty
                        <p class="text-muted small">Belum ada riwayat pembayaran.</p>
                    @endforelse
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="d-flex gap-2">
                <a href="/admin/booking" class="btn btn-secondary flex-fill">← Kembali</a>
                @if(!in_array($booking->status, ['selesai', 'dibatalkan', 'dibatalkan_sistem']))
                    <form action="/admin/booking/{{ $booking->id }}/batalkan" method="POST" class="flex-fill"
                        onsubmit="return confirm('Yakin batalkan booking ini?')">
                        @csrf
                        <input type="hidden" name="alasan" value="Dibatalkan oleh admin">
                        <button type="submit" class="btn btn-danger w-100 rounded-3">Batalkan</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection