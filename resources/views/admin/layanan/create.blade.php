@extends('admin.layout')
@section('title', 'Tambah Layanan')
@section('content')
    <div class="card" style="max-width:500px">
        <div class="card-body">
            <h6 class="fw-bold mb-4">Tambah Layanan</h6>
            <form action="/admin/layanan" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-500">Nama Layanan</label>
                    <input type="text" name="nama_layanan" class="form-control" value="{{ old('nama_layanan') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-500">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" value="{{ old('harga') }}" min="1000" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-500">Durasi (menit)</label>
                    <input type="number" name="durasi" class="form-control" value="{{ old('durasi') }}" min="5" required>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-purple flex-fill">Tambah</button>
                    <a href="/admin/layanan" class="btn btn-gray flex-fill">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection