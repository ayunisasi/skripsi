@extends('admin.layout')
@section('title', 'Data Promo')
@section('content')

    <div class="card">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h4 class="mb-0">
                    Data Promo
                </h4>

                <a href="{{ route('diskon.create') }}" class="btn btn-add-soft btn-sm px-3">

                    <i class="bi bi-plus-circle me-1"></i>
                    Tambah Promo

                </a>

            </div>

            @if($diskons->count())

                <div class="table-responsive">

                    <table class="table">

                        <thead>

                            <tr>

                                <th>No</th>

                                <th>Nama Promo</th>
                                <th>Jenis</th>
                                <th>Potongan</th>
                                <th>Ketentuan</th>
                                <th>Status</th>
                                <th>Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($diskons as $diskon)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $diskon->nama_diskon }}</td>

                                    <td>{{ ucfirst($diskon->jenis) }}</td>

                                    <td>

                                        @if($diskon->tipe_potongan == 'persen')

                                            {{ rtrim(rtrim(number_format($diskon->nilai, 2, '.', ''), '0'), '.') }}%

                                        @else

                                            Rp {{ number_format($diskon->nilai, 0, ',', '.') }}

                                        @endif

                                    </td>
                                    <td>

                                        @if($diskon->jenis == 'event')

                                            {{ \Carbon\Carbon::parse($diskon->tanggal_mulai)->format('d-m-Y') }}
                                            <br>
                                            s/d
                                            <br>
                                            {{ \Carbon\Carbon::parse($diskon->tanggal_selesai)->format('d-m-Y') }}

                                        @elseif($diskon->jenis == 'diskon')

                                            Minimal Transaksi
                                            <br>
                                            Rp {{ number_format($diskon->minimal_transaksi, 0, ',', '.') }}

                                        @elseif($diskon->jenis == 'langganan')

                                            {{ $diskon->minimal_kunjungan }} Kali Kunjungan

                                        @endif

                                    </td>

                                    <td>

                                        @if($diskon->status)

                                            <span class="badge badge-aktif">

                                                Aktif

                                            </span>

                                        @else

                                            <span class="badge badge-batal">

                                                Tidak Aktif

                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        <a href="{{ route('diskon.edit', $diskon) }}" class="btn btn-warning-soft">

                                            Edit

                                        </a>

                                        <form action="{{ route('diskon.destroy', $diskon) }}" method="POST" class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger-soft"
                                                onclick="return confirm('Yakin ingin menghapus promo ini?')">

                                                Hapus

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">

                    {{ $diskons->links() }}

                </div>

            @else

                <div class="text-center py-5">

                    <h5>

                        Belum ada data promo.

                    </h5>

                </div>

            @endif

        </div>

    </div>

@endsection
@section('title', 'Data Diskon')
@section('content')

    <div class="card">

        <div class="card-body">

            <h4>Data Promo</h4>

            <p>Halaman Data Promo berhasil dibuat.</p>

        </div>

    </div>

@endsection