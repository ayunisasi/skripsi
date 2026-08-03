@extends('admin.layout')
@section('title', 'Data Users')
@section('content')
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Data Users</h6>
                <form class="d-flex gap-2" method="GET" action="/admin/users">
                    <input type="text" name="search" class="form-control form-control-sm"
                        placeholder="Cari username / nama..." value="{{ request('search') }}"
                        style="border-radius:8px; width:220px;">
                    <button class="btn btn-sm" style="
                                                        background:#f5f3ff;
                                                        color:#7c3aed;
                                                        border:1px solid #d8b4fe;
                                                        font-weight:600;
                                                        ">
                        Cari
                    </button>
                </form>
            </div>
            <table class="table custom-table align-middle">
                <thead class="text-center">
                    <tr>

                        <th style="width:60px;" class="text-center">
                            No
                        </th>

                        <th style="width:120px;" class="text-center">
                            Username
                        </th>

                        <th style="width:170px;" class="text-center">
                            Nama Lengkap
                        </th>

                        <th style="width:220px;" class="text-center">
                            Email
                        </th>

                        <th style="width:130px;" class="text-center">
                            No. Telepon
                        </th>

                        <th style="width:90px;" class="text-center">
                            Aksi
                        </th>

                    </tr>
                </thead>
                <tbody>

                    @forelse($users as $i => $u)

                        <tr>

                            <td>

                                {{ $users->firstItem() + $i }}

                            </td>

                            <td>

                                {{ $u->username }}

                            </td>

                            <td>

                                {{ $u->nama_lengkap }}

                            </td>

                            <td>

                                {{ $u->email }}

                            </td>

                            <td>

                                {{ $u->no_telp }}

                            </td>

                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-2">

                                    <button type="button" class="btn btn-warning-soft btn-sm rounded-circle btn-edit-user"
                                        data-bs-toggle="modal" data-bs-target="#editUserModal" data-id="{{ $u->id }}"
                                        data-username="{{ $u->username }}"
                                        data-nama="{{ $u->nama_lengkap }}" data-email="{{ $u->email }}"
                                        data-telp="{{ $u->no_telp }}" title="Edit">

                                        <i class="bi bi-pencil"></i>

                                    </button>

                                    <form
    action="/admin/users/{{ $u->id }}"
    method="POST"
    class="delete-form">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger-soft btn-sm rounded-circle" title="Hapus" style="
                                                                                                    width:36px;
                                                                                                    height:36px;
                                                                                                    display:flex;
                                                                                                    align-items:center;
                                                                                                    justify-content:center;
                                                                                                ">

                                            <i class="bi bi-trash3"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center text-muted py-4">

                                Belum ada data user

                            </td>

                        </tr>

                    @endforelse

                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
    {{-- Modal Edit User --}}
    <div class="modal fade" id="editUserModal" tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <form id="editUserForm" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="modal-header">

                        <h5 class="modal-title">

                            Edit User

                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <div class="mb-3">

                            <label class="form-label">

                                Username

                            </label>

                            <input type="text" name="username" id="editUsername" class="form-control" required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Nama Lengkap

                            </label>

                            <input type="text" name="nama_lengkap" id="editNama" class="form-control" required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Email

                            </label>

                            <input type="email" name="email" id="editEmail" class="form-control" required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                No. Telepon

                            </label>

                            <input type="text" name="no_telp" id="editTelp" class="form-control" required>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-gray" data-bs-dismiss="modal">

                            Batal

                        </button>

                        <button type="submit" class="btn btn-purple">

                            Simpan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
    <script>

        document.querySelectorAll('.btn-edit-user').forEach(function (button) {

            button.addEventListener('click', function () {

                let id = this.dataset.id;

                document.getElementById('editUsername').value = this.dataset.username;

                document.getElementById('editNama').value = this.dataset.nama;

                document.getElementById('editEmail').value = this.dataset.email;

                document.getElementById('editTelp').value = this.dataset.telp;

                document.getElementById('editUserForm').action =
                    "/admin/users/" + id;

            });

        });

    </script>
@endsection
