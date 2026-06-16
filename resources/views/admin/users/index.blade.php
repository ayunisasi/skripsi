@extends('admin.layout')
@section('title', 'Data Users')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Data Users</h6>
                <form class="d-flex gap-2" method="GET" action="/admin/users">
                    <input type="text" name="search" class="form-control form-control-sm"
                        placeholder="Cari username / nama..." value="{{ request('search') }}"
                        style="border-radius:8px; width:220px;">
                    <button class="btn btn-sm btn-pink">Cari</button>
                </form>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $i => $u)
                        <tr>
                            <td>{{ $users->firstItem() + $i }}</td>
                            <td>{{ $u->username }}</td>
                            <td>{{ $u->nama_lengkap }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->no_telp }}</td>
                            <td>
                                <a href="/admin/users/{{ $u->id }}/edit" class="btn btn-warning btn-sm rounded-3">Edit</a>
                                <form action="/admin/users/{{ $u->id }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin hapus user ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm rounded-3">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada data user</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
@endsection