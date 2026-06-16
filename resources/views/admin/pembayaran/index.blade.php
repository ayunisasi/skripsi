@extends('admin.layout')
@section('title', 'Data Pembayaran')
@section('content')

    {{-- Summary --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card p-3 text-center">
                <div style="font-size:1.5rem">💰</div>
                <div class="fw-bold mt-1" style="color:#b5485a">
                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                </div>
                <small class="text-muted">Total Pendapatan</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 text-center">
                <div style="font-size:1.5rem">📥</div>
                <div class="fw-bold mt-1" style="color:#1565c0">
                    Rp {{ number_format($totalDP, 0, ',', '.') }}
                </div>
                <small class="text-muted">Total DP Masuk</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 text-center">
                <div style="font-size:1.5rem">🏦</div>
                <div class="fw-bold mt-1" style="color:#388e3c">
                    Rp {{ number_format($totalPelunasan, 0, ',', '.') }}
                </div>
                <small class="text-muted">Total Pelunasan</small>
            </div>
        </div>

    </div>

    {{-- Tabel --}}
    <div class="card">
        <div class="card-body">
            <h6 class="fw-bold mb-4">Riwayat Pembayaran</h6>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Kode Booking</th>
                            <th>Pelanggan</th>
                            <th>Layanan</th>
                            <th>Total</th>
                            <th>Status Pembayaran</th>
                            <th>Tanggal Booking</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                            <tr>
                                <td>
                                    <small class="font-monospace">
                                        {{ $booking->kd_booking }}
                                    </small>
                                </td>

                                <td>
                                    {{ $booking->user->nama_lengkap }}
                                </td>

                                <td>
                                    <small>
                                        {{ $booking->layanan->pluck('nama_layanan')->join(', ') }}
                                    </small>
                                </td>

                                <td class="fw-semibold">
                                    Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                                </td>

                                <td>
                                    @if($booking->status_pembayaran == 'lunas')
                                        <span class="badge badge-aktif">Lunas</span>
                                    @elseif($booking->status_pembayaran == 'dp_lunas')
                                        <span class="badge badge-menunggu">DP Lunas</span>
                                    @else
                                        <span class="badge badge-batal">Belum Lunas</span>
                                    @endif
                                </td>

                                <td>
                                    <small>
                                        {{ $booking->created_at->format('d/m/Y H:i') }}
                                    </small>
                                </td>

                                <td>
                                    <a href="/admin/pembayaran/{{ $booking->id }}" class="btn btn-sm btn-pink">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Belum ada data pembayaran
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $bookings->links() }}
        </div>
    </div>
@endsection