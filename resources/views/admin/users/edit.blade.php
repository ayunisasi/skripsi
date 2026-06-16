@extends('admin.layout')
@section('title', 'Edit User')
@section('content')
    <div class="card" style="max-width:500px">
        <div class="card-body">
            <h6 class="fw-bold mb-4">Edit User</h6>
            <form action="/admin/users/{{ $user->id }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-500">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control"
                        value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-500">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-500">No. Telepon</label>
                    <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $user->no_telp) }}"
                        required>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-pink flex-fill">Simpan</button>
                    <a href="/admin/users" class="btn btn-secondary flex-fill">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection