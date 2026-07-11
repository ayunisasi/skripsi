@extends('admin.layout')
@section('title', 'Edit Layanan')
@section('content')
    <div class="card" style="max-width:500px">
        <div class="card-body">
            <h6 class="fw-bold mb-4">Edit Layanan</h6>
            <form action="/admin/layanan/{{ $layanan->id }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-500">Nama Layanan</label>
                    <input type="text" name="nama_layanan" class="form-control"
                        value="{{ old('nama_layanan', $layanan->nama_layanan) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-500">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" value="{{ old('harga', $layanan->harga) }}"
                        required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-500">Durasi (menit)</label>
                    <input type="number" name="durasi" class="form-control" value="{{ old('durasi', $layanan->durasi) }}"
                        required>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-purple flex-fill">Simpan</button>
                    <a href="/admin/layanan" class="btn btn-gray flex-fill">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection