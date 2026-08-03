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
                    <button type="submit" class="btn btn-purple flex-fill">Simpan</button>
                    <a href="/admin/terapis" class="btn btn-gray flex-fill">Batal</a>
                </div>
            </form>
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

                        <button class="btn-close" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Nama Terapis

                            </label>

                            <input type="text" name="nama_terapis" id="editNamaTerapis" class="form-control rounded-3"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Status

                            </label>

                            <select name="status" id="editStatus" class="form-select rounded-3" required>

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

                        <button type="submit" class="btn btn-purple">

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

                let id = this.dataset.id;

                document.getElementById('editNamaTerapis').value =
                    this.dataset.nama;

                document.getElementById('editStatus').value =
                    this.dataset.status;

                document.getElementById('editTerapisForm').action =
                    "/admin/terapis/" + id;

            });

        });

    </script>
@endsection
