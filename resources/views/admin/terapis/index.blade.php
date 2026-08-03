@extends('admin.layout')
@section('title', 'Data Terapis')
@section('content')
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Data Terapis</h6>
                <button type="button" class="btn btn-add-soft rounded-3" data-bs-toggle="modal"
                    data-bs-target="#tambahTerapisModal" style="
                height:36px;
                padding:6px 14px;
                font-size:13px;
                display:flex;
                align-items:center;
                gap:6px;
            ">
                    <i class="bi bi-plus"></i>
                    Tambah Terapis
                </button>
            </div>
            <table class="table custom-table align-middle">
                <thead class="text-center">

                    <tr>

                        <th style="width:70px;">
                            No
                        </th>

                        <th style="width:180px;">
                            Nama Terapis
                        </th>

                        <th>
                            Informasi
                        </th>

                        <th style="width:120px;">
                            Status
                        </th>

                        <th style="width:90px;">
                            Aksi
                        </th>

                    </tr>

                </thead>
                <tbody>

                    @forelse($terapis as $i => $t)

                        <tr>

                            <td class="text-center">

                                {{ $terapis->firstItem() + $i }}

                            </td>

                            <td style="font-weight:500;">

                                {{ $t->nama_terapis }}

                            </td>

                            <td>

                                <div class="small text-muted">

                                    ⭐ Rating :
                                    <strong>{{ number_format($t->rating, 1) }}</strong>

                                    &nbsp;&nbsp;

                                    📅 Booking :
                                    <strong>{{ $t->booking_selesai }}</strong>

                                    &nbsp;&nbsp;

                                    💬 Review :
                                    <strong>{{ $t->total_review }}</strong>

                                </div>

                                @if($terapisUnggulan && $terapisUnggulan->id == $t->id)

                                    <span class="badge mt-2"
                                        style="
                                                                                                                                                                        background:#fff7d6;
                                                                                                                                                                        color:#8a6d1f;
                                                                                                                                                                        border:1px solid #ffe69c;
                                                                                                                                                                        ">

                                        👑 Terapis Unggulan

                                    </span>

                                @endif

                            </td>

                            <td class="text-center">

                                <span class="badge {{ $t->status === 'aktif' ? 'badge-aktif' : 'badge-batal' }}">

                                    {{ ucfirst($t->status) }}

                                </span>

                            </td>

                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-2">

                                    <button type="button" class="btn btn-warning-soft btn-sm rounded-circle btn-edit-terapis"
                                        data-bs-toggle="modal" data-bs-target="#editTerapisModal" data-id="{{ $t->id }}"
                                        data-nama="{{ $t->nama_terapis }}" data-status="{{ $t->status }}" title="Edit">

                                        <i class="bi bi-pencil"></i>

                                    </button>

                                    <form action="/admin/terapis/{{ $t->id }}" method="POST" class="delete-form">

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

                            <td colspan="5" class="text-center text-muted py-4">

                                Belum ada data terapis

                            </td>

                        </tr>

                    @endforelse

                </tbody>
            </table>
            <div class="d-flex justify-content-end mt-3">

                {{ $terapis->links() }}

            </div>
        </div>
    </div>
    {{-- Modal Tambah Terapis --}}
    <div class="modal fade" id="tambahTerapisModal" tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow rounded-4">

                <form action="/admin/terapis" method="POST">

                    @csrf

                    <div class="modal-header border-0">

                        <div>

                            <h5 class="fw-bold mb-1">
                                Tambah Terapis
                            </h5>

                            <small class="text-muted">
                                Tambahkan data terapis baru
                            </small>

                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Nama Terapis

                            </label>

                            <input type="text" name="nama_terapis" class="form-control rounded-3" required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Status

                            </label>

                            <select name="status" class="form-select rounded-3">

                                <option value="aktif">
                                    Aktif
                                </option>

                                <option value="nonaktif">
                                    Nonaktif
                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="modal-footer border-0">

                        <button type="button" class="btn btn-gray" data-bs-dismiss="modal">

                            Batal

                        </button>

                        <button class="btn btn-purple">

                            Simpan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
    {{-- Modal Edit Terapis --}}
    <div class="modal fade" id="editTerapisModal" tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow rounded-4">

                <form id="editTerapisForm" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="modal-header border-0">

                        <div>

                            <h5 class="fw-bold mb-1">

                                Edit Terapis

                            </h5>

                            <small class="text-muted">

                                Perbarui data terapis

                            </small>

                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Nama Terapis

                            </label>

                            <input type="text" id="editNamaTerapis" name="nama_terapis" class="form-control rounded-3"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Status

                            </label>

                            <select id="editStatusTerapis" name="status" class="form-select rounded-3">

                                <option value="aktif">
                                    Aktif
                                </option>

                                <option value="nonaktif">
                                    Nonaktif
                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="modal-footer border-0">

                        <button type="button" class="btn btn-gray" data-bs-dismiss="modal">

                            Batal

                        </button>

                        <button class="btn btn-purple">

                            Simpan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <script>

        document.querySelectorAll('.btn-edit-terapis').forEach(function (button) {

            button.addEventListener('click', function () {

                document.getElementById('editNamaTerapis').value =
                    this.dataset.nama;

                document.getElementById('editStatusTerapis').value =
                    this.dataset.status;

                document.getElementById('editTerapisForm').action =
                    "/admin/terapis/" + this.dataset.id;

            });

        });

    </script>
@endsection
