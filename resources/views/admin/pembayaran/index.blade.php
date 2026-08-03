@extends('admin.layout')
@section('title', 'Data Pembayaran')
@section('content')

    {{-- Summary --}}
    <div class="row g-4 mb-4">
        {{-- Tabel --}}
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">
                <h6 class="fw-bold mb-4">Riwayat Pembayaran</h6>
                <div class="table-responsive">
                    <table class="table custom-table align-middle">
                        <thead class="text-center">

                            <tr>

                                <th style="width:130px;">
                                    Kode Booking
                                </th>

                                <th style="width:170px;">
                                    Pelanggan
                                </th>

                                <th>
                                    Layanan
                                </th>

                                <th style="width:150px;">
                                    Total
                                </th>

                                <th style="width:150px;">
                                    Status Pembayaran
                                </th>

                                <th style="width:140px;">
                                    Tanggal Booking
                                </th>

                                <th style="width:90px;">
                                    Aksi
                                </th>

                            </tr>

                        </thead>
                        <tbody>

                            @forelse($bookings as $booking)

                                                        <tr>

                                                            <td class="text-center">

                                                                <span class="font-monospace fw-semibold">
    {{ $booking->kd_booking }}
</span>

                                                            </td>

                                                            <td>

                                                                {{ $booking->user->nama_lengkap }}

                                                            </td>
                                                            <td style="max-width:220px;">

    {{ $booking->layanan->first()->nama_layanan }}

    @if($booking->layanan->count() > 1)

        <br>

        <small class="text-muted">

            +{{ $booking->layanan->count() - 1 }} layanan lainnya

        </small>

    @endif

</td>



                                                            <td class="text-end">

                                                                <strong>

                                                                    Rp {{ number_format($booking->total_harga, 0, ',', '.') }}

                                                                </strong>

                                                            </td>

                                                            <td class="text-center">

                                                                @if($booking->status_pembayaran == 'lunas')

                                                                    <span class="badge badge-aktif">

                                                                        Lunas

                                                                    </span>

                                                                @elseif($booking->status_pembayaran == 'dp_lunas')

                                                                    <span class="badge badge-menunggu">

                                                                        DP Lunas

                                                                    </span>

                                                                @else

                                                                    <span class="badge badge-batal">

                                                                        Belum Lunas

                                                                    </span>

                                                                @endif

                                                            </td>

                                                            <td class="text-center">

                                                                {{ $booking->created_at->translatedFormat('d M Y') }}

                                                            </td>

                                                            <td class="text-center">

                                                                <a href="/admin/pembayaran/{{ $booking->id }}"
                                                                    class="btn btn-detail-soft btn-sm rounded-circle" style="
                                        width:36px;
                                        height:36px;
                                        display:inline-flex;
                                        align-items:center;
                                        justify-content:center;
                                   ">
                                                                    <i class="bi bi-eye"></i>
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
                <div class="d-flex justify-content-end mt-3">

                    {{ $bookings->links() }}

                </div>
            </div>
        </div>
@endsection
