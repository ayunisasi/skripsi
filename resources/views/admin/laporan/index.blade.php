@extends('admin.layout')
@section('title', 'Laporan')
@section('content')

    <style>
        .custom-table {
            border: 2px solid #6C757D;
            border-collapse: collapse;
        }

        .custom-table th {
            border: 1.5px solid #6C757D !important;
        }

        .custom-table td {
            border: 1.5px solid #8B8B8B !important;
        }
    </style>

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h3 class="mb-1">Laporan Pendapatan</h3>
                <small class="text-muted">
                    Menampilkan laporan transaksi berdasarkan periode yang dipilih.
                </small>
            </div>

        </div>

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <form method="GET">

                    <div class="row">

                        <div class="col-md-4">

                            <label class="form-label">
                                Tanggal Awal
                            </label>

                            <input type="date" name="tanggal_awal" class="form-control"
                                value="{{ request('tanggal_awal') }}">

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">
                                Tanggal Akhir
                            </label>

                            <input type="date" name="tanggal_akhir" class="form-control"
                                value="{{ request('tanggal_akhir') }}">

                        </div>

                        <div class="col-md-4 d-flex align-items-end">

                            <button type="submit" class="btn btn-primary me-2">
                                Tampilkan
                            </button>

                            <a href="{{ route('admin.laporan.pdf', request()->all()) }}" class="btn btn-success"
                                target="_blank">
                                <i class="fas fa-file-pdf"></i> Cetak PDF
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

                <table class="table table-bordered custom-table align-middle mb-0">

                    <thead class="table-light text-center">

                        <tr>

                            <th width="60">No</th>
                            <th>Tanggal</th>
                            <th>Kode Booking</th>
                            <th>Pelanggan</th>
                            <th>Layanan</th>
                            <th>Terapis</th>
                            <th class="text-end">Total Pembayaran</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($booking as $item)

                            <tr>

                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($item->tgl_booking)->format('d-m-Y') }}
                                </td>

                                <td>{{ $item->kd_booking }}</td>

                                <td>{{ $item->user->username ?? '-' }}</td>

                                <td style="max-width: 280px; word-wrap: break-word; white-space: normal;">
                                    {{ $item->layanan->pluck('nama_layanan')->implode(', ') }}
                                </td>

                                <td>{{ $item->terapis->nama_terapis ?? '-' }}</td>

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

        <div class="ms-4 mb-3">

            <p class="mb-2">
                <strong>Jumlah Transaksi :</strong>
                {{ $totalBooking }}
            </p>

            <p class="mb-0">
                <strong>Total Pendapatan :</strong>
                <span class="text-success fw-bold">
                    Rp{{ number_format($totalPendapatan, 0, ',', '.') }}
                </span>
            </p>

        </div>

    </div>

    </div>

@endsection