@extends('admin.layout')
@section('title', 'Laporan')
@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="mb-1">Laporan Pendapatan</h4>
                <small class="text-muted">
                    Menampilkan laporan transaksi berdasarkan periode yang dipilih.
                </small>
            </div>

        </div>

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <form method="GET">

                    <div class="row">

                        <div class="col-md-2">

                            <label class="form-label mb-1" style="font-size:13px; font-weight:500;">
                                Tanggal Awal
                            </label>

                            <input type="date" name="tanggal_awal" class="form-control form-control-sm"
                                style="font-size:12px; height:36px;" value="{{ request('tanggal_awal') }}">

                        </div>

                        <div class="col-md-4">

                            <label class="form-label mb-1" style="font-size:13px; font-weight:500;">
                                Tanggal Akhir
                            </label>

                            <input type="date" name="tanggal_akhir" class="form-control form-control-sm"
                                style="font-size:12px; height:36px;" class="form-control"
                                value="{{ request('tanggal_akhir') }}">

                        </div>

                        <div class="col-md-4 d-flex align-items-end gap-2">

                            <button type="submit" class="btn btn-primary"
                                style="height:36px; font-size:13px; padding:6px 14px;">
                                Tampilkan
                            </button>

                            <a href="{{ route('admin.laporan.pdf', request()->all()) }}"
                                class="btn btn-success d-inline-flex align-items-center" target="_blank"
                                style="font-size:13px; padding:6px 14px;">

                                <i class="fas fa-file-pdf me-1"></i>

                                Cetak PDF

                            </a>

                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div>
    <div class="card mt-4 shadow-sm border-0">
        <div class="card-body">

            <div class="table-responsive">

                <table class="table custom-table align-middle">

                    <thead class="text-center">

                        <tr>

                            <th style="width:60px;">
                                No
                            </th>

                            <th style="width:110px;">
                                Tanggal
                            </th>

                            <th style="width:140px;">
                                Kode Booking
                            </th>

                            <th style="width:170px;">
                                Pelanggan
                            </th>

                            <th>
                                Layanan
                            </th>

                            <th style="width:150px;">
                                Terapis
                            </th>

                            <th style="width:170px;">
                                Total Pembayaran
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($booking as $item)

                            <tr>

                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="text-center">

                                    {{ \Carbon\Carbon::parse($item->tgl_booking)->translatedFormat('d M Y') }}

                                </td>
                                <td class="text-center">

                                    <span class="font-monospace">

                                        {{ $item->kd_booking }}

                                    </span>

                                </td>

                                <td>{{ $item->user->nama_lengkap ?? '-' }}</td>

                                <td style="max-width:220px;">

                                    {{ $item->layanan->first()->nama_layanan }}

                                    @if($item->layanan->count() > 1)

                                        <br>

                                        <small class="text-muted">

                                            +{{ $item->layanan->count() - 1 }} layanan lainnya

                                        </small>

                                    @endif

                                </td>
                                <td class="text-center">

                                    {{ $item->terapis->nama_terapis ?? '-' }}

                                </td>

                                <td class="text-end">

                                    Rp{{ number_format($item->jumlah_dibayar, 0, ',', '.') }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center">

                                    Tidak ada data.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>
        </div> {{-- penutup table-responsive --}}

        <hr class="mb-2">

        <div class="row px-3 pb-3">

            <div class="col-md-3">

                <div class="border rounded-3 p-2">

                    <small class="text-muted" style="font-size:12px;">

                        Jumlah Transaksi

                    </small>

                    <h6 class="fw-bold mb-0">

                        {{ $totalBooking }}

                    </h6>

                </div>

            </div>

            <div class="col-md-3">

                <div class="border rounded-3 p-2">

                    <small class="text-muted" style="font-size:12px;">

                        Total Pendapatan

                    </small>

                    <h6 class="fw-bold text-success mb-0">

                        Rp{{ number_format($totalPendapatan, 0, ',', '.') }}

                    </h6>

                </div>

            </div>

        </div>

    </div>


@endsection