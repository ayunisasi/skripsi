@extends('admin.layout')
@section('title', 'Data Booking')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">

    <h6 class="fw-bold mb-0">Data Booking</h6>

    <div class="dropdown">

    <button
    class="btn btn-light border rounded-3 dropdown-toggle px-3 py-1"
    type="button"
    data-bs-toggle="dropdown"
    style="
        font-size:14px;
        font-weight:500;
        min-width:170px;
    ">

        <i class="bi bi-funnel-fill me-1"></i>

        @if(request('terapis_id'))

            {{ optional($terapis->firstWhere('id', request('terapis_id')))->nama_terapis }}

        @else

            Semua Terapis

        @endif

    </button>

    <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-1 filter-dropdown">

        <li>

            <a class="dropdown-item"
               href="{{ url('/admin/booking') }}">

                Semua Terapis

            </a>

        </li>

        <li><hr class="dropdown-divider"></li>

        @foreach($terapis as $t)

            <li>

                <a
                    class="dropdown-item"
                    href="{{ url('/admin/booking?terapis_id='.$t->id) }}">

                    {{ $t->nama_terapis }}

                </a>

            </li>

        @endforeach

    </ul>

</div>

</div>
            <div class="table-responsive">
                <table class="table custom-table align-middle">
                    <thead class="text-center">
                        <tr>
                            <th>Kode</th>
                            <th>Pelanggan</th>
                           <th style="width:110px;">
                            Layanan
                        </th>
                            <th>Terapis</th>
                            <th style="min-width:110px;">Tanggal</th>

                            <th class="text-center" style="width:95px;">
                            Antrian
                        </th>
                            <th>Status Bayar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $b)
                            <tr>
                                <td style="min-width:120px;">

                                <span class="fw-semibold text-dark">
                                    {{ $b->kd_booking }}
                                </span>

                            </td>
                                <td>{{ $b->user->nama_lengkap }}</td>
                                <td style="width:140px;">

                                <div>
                                    {{ $b->layanan->first()->nama_layanan ?? '-' }}
                                </div>

                                @if($b->layanan->count() > 1)

                                    <small class="text-muted">
                                        +{{ $b->layanan->count() - 1 }} layanan lainnya
                                    </small>

                                @endif

                            </td>
                                <td style="min-width:110px;">

                                <span>

                                    {{ $b->terapis->nama_terapis ?? '-' }}

                                </span>

                            </td>
                                <td>

                                <div>
                                    {{ \Carbon\Carbon::parse($b->tgl_booking)->translatedFormat('d M Y') }}
                                </div>

                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($b->tgl_booking)->translatedFormat('l') }}
                                </small>

                            </td>

                               <td class="text-center">

                            @if($b->nomor_antrian)

                                <span style="
                                    display:inline-block;
                                    min-width:26px;
                                    padding:3px 8px;
                                    border-radius:999px;
                                    background:#F3E8FF;
                                    color:#7C3AED;
                                    font-weight:700;
                                    font-size:11px;
                                ">
                                    {{ $b->nomor_antrian }}
                                </span>

                            @else

                                <span class="text-muted">-</span>

                            @endif

                        </td>
                                <td>
                                    @if($b->status_pembayaran === 'lunas')
                                        <span class="badge badge-aktif">Lunas</span>
                                    @elseif($b->status_pembayaran === 'dp_lunas')
                                        <span class="badge" style="background:#e3f2fd;color:#1565c0">DP Lunas</span>
                                    @elseif($b->status_pembayaran === 'refund')
                                        <span class="badge badge-batal">Refund</span>
                                    @else
                                        <span class="badge badge-menunggu">Belum Bayar</span>
                                    @endif
                                </td>
                                <td>
                                    @if($b->status === 'aktif')
                                    <span class="badge"
                                    style="
                                    background:#F3E8FF;
                                    color:#7C3AED;
                                    border:1px solid #D8B4FE;
                                    padding:6px 12px;
                                    border-radius:20px;
                                    font-weight:600;
                                    ">

                                    Aktif

                                    </span>
                                    @elseif($b->status === 'selesai')
                                        <span class="badge"
                                        style="
                                        background:#DCFCE7;
                                        color:#15803D;
                                        border:1px solid #86EFAC;
                                        padding:6px 12px;
                                        border-radius:20px;
                                        font-weight:600;
                                        ">

                                        Selesai

                                        </span>
                                    @elseif($b->status === 'dibatalkan_sistem')
    <span class="badge badge-batal">
        Dibatalkan Sistem
    </span>

@elseif($b->status === 'dibatalkan')
    <span class="badge badge-batal">
        Dibatalkan
    </span>
                                    @else
                                        <span class="badge badge-menunggu">{{ ucfirst(str_replace('_', ' ', $b->status)) }}</span>
                                    @endif
                                </td>
                                <td>
    <div style="display:flex;gap:6px;align-items:center;">

    <a href="/admin/booking/{{ $b->id }}/detail"
   class="btn btn-detail-soft btn-sm rounded-circle"
   style="
        width:30px;
        height:30px;
        display:flex;
        align-items:center;
        justify-content:center;
   "
   title="Detail">

    <i class="bi bi-eye"></i>

</a>

        {{-- @if($b->status === 'menunggu_pembayaran')
        <form action="/admin/booking/{{ $b->id }}/setujui" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-sm rounded-3 fw-semibold"class="btn btn-success-soft rounded-3">
                Setujui
            </button>
        </form>
        @endif --}}

        {{-- ✅ TOMBOL HAPUS --}}
        <form
    action="/admin/booking/{{ $b->id }}"
    method="POST"
    class="delete-form">
        @csrf
        @method('DELETE')

        <button
    type="submit"
    class="btn btn-danger-soft btn-sm rounded-circle"
    style="
        width:30px;
        height:30px;
        display:flex;
        align-items:center;
        justify-content:center;
    "
    title="Hapus">

    <i class="bi bi-trash3"></i>

</button>
    </form>

</div>
</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    Belum ada data booking
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
