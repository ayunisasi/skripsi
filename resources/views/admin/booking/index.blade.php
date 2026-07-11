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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Pelanggan</th>
                            <th>Layanan</th>
                            <th>Terapis</th>
                            <th>Tanggal</th>

                            <th>No. Antrian</th>
                            <th>Status Bayar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $b)
                            <tr>
                                <td><small class="font-monospace">{{ $b->kd_booking }}</small></td>
                                <td>{{ $b->user->nama_lengkap }}</td>
                                <td><small>{{ $b->layanan->pluck('nama_layanan')->join(', ') }}</small></td>
                                <td>{{ $b->terapis->nama_terapis ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($b->tgl_booking)->format('d/m/Y') }}</td>

                                <td>
                                    @if($b->nomor_antrian)
                                        <strong style="color:#b5485a">{{ $b->nomor_antrian }}</strong>
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
                                        <span class="badge badge-aktif">Aktif</span>
                                    @elseif($b->status === 'selesai')
                                        <span class="badge badge-selesai">Selesai</span>
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
       class="btn btn-detail-soft btn-sm px-3 py-1 rounded-3">
        Detail
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
        <form action="/admin/booking/{{ $b->id }}" method="POST"
          onsubmit="return confirm('Yakin hapus data booking {{ $b->kd_booking }}?')">
        @csrf
        @method('DELETE')

        <button type="submit"
                class="btn btn-danger-soft btn-sm px-3 py-1 rounded-3">
            <i class="bi bi-trash3"></i> Hapus
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
