@extends('admin.layout')
@section('title', 'Data Layanan')
@section('content')
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">

                <h6 class="fw-bold mb-0">
                    Data Layanan
                </h6>

                <div class="d-flex align-items-center gap-2">

                    <form action="{{ route('layanan.index') }}" method="GET">

                        <div class="input-group">

                            <input type="text" name="search" class="form-control" placeholder="Cari nama layanan..."
                                value="{{ request('search') }}" style="width:190px; height:34px; font-size:13px;">

                            <button class="btn btn-outline-secondary" type="submit" style="height:34px; padding:0 10px;">

                                <i class="bi bi-search"></i>

                            </button>

                        </div>

                    </form>

                    <button class="btn btn-add-soft rounded-3" data-bs-toggle="modal" data-bs-target="#tambahLayananModal"
                        style="height:34px; font-size:13px; padding:0 12px;">

                        <i class="bi bi-plus-lg me-1"></i>

                        Tambah Layanan

                    </button>

                </div>

            </div>
            <table class="table custom-table align-middle">
                <thead class="text-center">

                    <tr>

                        <th style="width:70px;">
                            No
                        </th>

                        <th style="width:140px;">
                            Nama Layanan
                        </th>

                        <th style="width:140px;">
                            Harga
                        </th>

                        <th style="width:140px;">
                            Durasi
                        </th>

                        <th style="width:90px;">
                            Aksi
                        </th>

                    </tr>

                </thead>
                <tbody>

                    @forelse($layanan as $i => $l)

                        <tr>

                            <td class="text-center">

                                {{ $layanan->firstItem() + $i }}

                            </td>

                            <td>

                                {{ $l->nama_layanan }}

                            </td>

                            <td class="text-end">

                                Rp {{ number_format($l->harga, 0, ',', '.') }}

                            </td>

                            <td class="text-center">

                                {{ $l->durasi }} Menit

                            </td>

                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-warning-soft btn-sm rounded-circle btn-edit-layanan"
                                        data-bs-toggle="modal" data-bs-target="#editLayananModal" data-id="{{ $l->id }}"
                                        data-nama="{{ $l->nama_layanan }}" data-harga="{{ $l->harga }}"
                                        data-durasi="{{ $l->durasi }}" data-deskripsi="{{ $l->deskripsi_singkat }}"
                                        data-landing="{{ $l->landing }}" title="Edit" style="
                                                                                                                    width:36px;
                                                                                                                    height:36px;
                                                                                                                    display:flex;
                                                                                                                    align-items:center;
                                                                                                                    justify-content:center;
                                                                                                                ">

                                        <i class="bi bi-pencil"></i>

                                    </button>

                                    <form action="/admin/layanan/{{ $l->id }}" method="POST" class="delete-form">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger-soft btn-sm rounded-circle" title="Hapus"
                                            style="
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

                                Belum ada layanan

                            </td>

                        </tr>

                    @endforelse

                </tbody>
            </table>

        </div>
        <div class="d-flex justify-content-end mt-3">

            {{ $layanan->links() }}

        </div>
    </div>
    {{-- Modal Tambah Layanan --}}
    <div class="modal fade" id="tambahLayananModal" tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow rounded-4">

                <form action="{{ route('layanan.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="modal-header border-0">

                        <div>

                            <h5 class="fw-bold mb-1">

                                Tambah Layanan

                            </h5>

                            <small class="text-muted">

                                Tambahkan layanan baru

                            </small>

                        </div>

                        <button class="btn-close" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Nama Layanan

                            </label>

                            <input type="text" name="nama_layanan" class="form-control rounded-3" required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Harga

                            </label>

                            <input type="number" name="harga" class="form-control rounded-3" required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Durasi (Menit)

                            </label>

                            <input type="number" name="durasi" class="form-control rounded-3" required>

                        </div>

                        <hr>

                        <h6 class="fw-bold text-secondary mb-3">

                            Pengaturan Landing Page

                        </h6>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Deskripsi Singkat

                            </label>

                            <textarea name="deskripsi_singkat" class="form-control rounded-3" rows="3"
                                placeholder="Contoh: Perawatan rambut agar lebih sehat dan berkilau."></textarea>

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Gambar Layanan

                            </label>

                            <input type="file" name="gambar" class="form-control rounded-3" accept="image/*">

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">

                                    Tampilkan di Landing

                                </label>

                                <select name="landing" class="form-select rounded-3">

                                    <option value="1">

                                        Ya

                                    </option>

                                    <option value="0">

                                        Tidak

                                    </option>

                                </select>

                            </div>

                            <div class="col-md-6 mb-3">
                            </div>

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
    {{-- Modal Edit Layanan --}}
    <div class="modal fade" id="editLayananModal" tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow rounded-4">

                <form id="editLayananForm" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="modal-header border-0">

                        <div>

                            <h5 class="fw-bold mb-1">

                                Edit Layanan

                            </h5>

                            <small class="text-muted">

                                Perbarui data layanan

                            </small>

                        </div>

                        <button class="btn-close" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Nama Layanan

                            </label>

                            <input type="text" name="nama_layanan" id="editNamaLayanan" class="form-control rounded-3"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Harga

                            </label>

                            <input type="number" name="harga" id="editHarga" class="form-control rounded-3" required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Durasi (Menit)

                            </label>

                            <input type="number" name="durasi" id="editDurasi" class="form-control rounded-3" required>

                        </div>
                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Deskripsi Singkat

                            </label>

                            <textarea name="deskripsi_singkat" id="editDeskripsi" class="form-control rounded-3"
                                rows="3"></textarea>

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Gambar Layanan

                            </label>

                            <input type="file" name="gambar" class="form-control rounded-3" accept="image/*">

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">

                                    Tampilkan di Landing

                                </label>

                                <select name="landing" id="editLanding" class="form-select rounded-3">

                                    <option value="1">Ya</option>

                                    <option value="0">Tidak</option>

                                </select>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer border-0">

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

        document.querySelectorAll('.btn-edit-layanan').forEach(function (button) {

            button.addEventListener('click', function () {

                let id = this.dataset.id;

                document.getElementById('editNamaLayanan').value =
                    this.dataset.nama;

                document.getElementById('editHarga').value =
                    this.dataset.harga;

                document.getElementById('editDurasi').value =
                    this.dataset.durasi;

                document.getElementById('editLayananForm').action =
                    "/admin/layanan/" + id;

                document.getElementById('editDeskripsi').value =
                    this.dataset.deskripsi;

                document.getElementById('editLanding').value =
                    this.dataset.landing;


            });

        });

    </script>
    <script>

        document.querySelectorAll('.delete-form').forEach(function (form) {

            form.addEventListener('submit', function (e) {

                e.preventDefault();

                Swal.fire({

                    title: 'Hapus Layanan?',

                    text: 'Data layanan yang dihapus tidak dapat dikembalikan.',

                    icon: 'warning',

                    showCancelButton: true,

                    confirmButtonColor: '#dc3545',

                    cancelButtonColor: '#6c757d',

                    confirmButtonText: 'Ya, Hapus',

                    cancelButtonText: 'Batal'

                }).then((result) => {

                    if (result.isConfirmed) {

                        form.submit();

                    }

                });

            });

        });

    </script>
@endsection
