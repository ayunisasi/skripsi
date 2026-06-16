@extends('admin.layout')
@section('title', 'Data Layanan')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Data Layanan</h6>
                <a href="/admin/layanan/create" class="btn btn-pink btn-sm">+ Tambah</a>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Layanan</th>
                        <th>Harga</th>
                        <th>Durasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($layanan as $i => $l)
                        <tr>
                            <td>{{ $layanan->firstItem() + $i }}</td>
                            <td>{{ $l->nama_layanan }}</td>
                            <td>Rp {{ number_format($l->harga, 0, ',', '.') }}</td>
                            <td>{{ $l->durasi }} menit</td>
                            <td>
                                <a href="/admin/layanan/{{ $l->id }}/edit" class="btn btn-warning btn-sm rounded-3">Edit</a>
                                <form action="/admin/layanan/{{ $l->id }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin hapus?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm rounded-3">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada layanan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-end mt-3">
                {{ $layanan->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection