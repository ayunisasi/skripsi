@extends('admin.layout')
@section('title', 'Data Pembayaran')
@section('content')

    {{-- Summary --}}
    <div class="row g-4 mb-4">

        {{-- Pendapatan Hari Ini --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center p-4">

                    <div>
                        <small class="text-muted d-block mb-2">
                            Pendapatan Hari Ini
                        </small>

                        <h2 class="fw-bold mb-1" style="font-size:26px;">
                            Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}
                        </h2>

                        <small style="color:#7c4dff">
                            Pendapatan transaksi hari ini
                        </small>
                    </div>

                    <div class="rounded-4 d-flex align-items-center justify-content-center"
                        style="width:70px;height:70px;background:#f4efff;">
                        <i class="bi bi-wallet2" style="font-size:32px;color:#7c4dff;"></i>
                    </div>

                </div>
            </div>
        </div>

        {{-- Pendapatan Bulan Ini --}}
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center p-4">

                    <div>
                        <small class="text-muted d-block mb-2">
                            Pendapatan Bulan Ini
                        </small>

                        <h2 class="fw-bold mb-1" style="font-size:26px;">
                            Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}
                        </h2>

                        <small style="color:#7c4dff">
                            Pendapatan transaksi bulan ini
                        </small>
                    </div>

                    <div class="rounded-4 d-flex align-items-center justify-content-center"
                        style="width:70px;height:70px;background:#f4efff;">
                        <i class="bi bi-calendar-check" style="font-size:32px;color:#7c4dff;"></i>
                    </div>

                </div>
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
                                    <a href="/admin/pembayaran/{{ $booking->id }}" class="btn btn-detail-soft">
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