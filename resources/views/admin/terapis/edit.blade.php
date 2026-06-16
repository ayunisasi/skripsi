@extends('admin.layout')
@section('title', 'Edit Terapis')
@section('content')
    <div class="card" style="max-width:500px">
        <div class="card-body">
            <h6 class="fw-bold mb-4">Edit Terapis</h6>
            <form action="/admin/terapis/{{ $terapis->id }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-500">Nama Terapis</label>
                    <input type="text" name="nama_terapis" class="form-control"
                        value="{{ old('nama_terapis', $terapis->nama_terapis) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-500">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="aktif" {{ $terapis->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ $terapis->status === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-pink flex-fill">Simpan</button>
                    <a href="/admin/terapis" class="btn btn-secondary flex-fill">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection