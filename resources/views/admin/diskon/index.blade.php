@extends('admin.layout')
@section('title', 'Data Promo')
@section('content')

    <div class="card shadow-sm border-0 rounded-4">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h6 class="fw-bold mb-0">

                    Data Promo

                </h6>
                <button type="button" class="btn btn-add-soft rounded-3 px-2 py-1" data-bs-toggle="modal"
                    data-bs-target="#tambahPromoModal" style="font-size:13px;">

                    <i class="bi bi-plus me-1"></i>

                    Tambah Promo

                </button>

            </div>

            @if($diskons->count())

                <div class="table-responsive">

                    <table class="table custom-table align-middle">

                        <thead class="text-center">

                            <tr>

                                <th style="width:60px;">
                                    No
                                </th>

                                <th style="width:180px;">
                                    Nama Promo
                                </th>

                                <th style="width:100px;">
                                    Jenis
                                </th>

                                <th style="width:150px;">
                                    Potongan
                                </th>

                                <th>
                                    Ketentuan
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

                            @foreach($diskons as $diskon)

                                <tr>

                                    <td class="text-center">

                                        {{ $loop->iteration }}

                                    </td>

                                    <td>{{ $diskon->nama_diskon }}</td>

                                    <td class="text-center">

                                        {{ ucfirst($diskon->jenis) }}

                                    </td>

                                    <td class="text-center">

                                        @if($diskon->tipe_potongan == 'persen')

                                            {{ rtrim(rtrim(number_format($diskon->nilai, 2, '.', ''), '0'), '.') }}%

                                        @else

                                            Rp {{ number_format($diskon->nilai, 0, ',', '.') }}

                                        @endif

                                    </td>
                                    <td class="text-center">

                                        @if($diskon->jenis == 'event')

                                            <div>

                                                {{ \Carbon\Carbon::parse($diskon->tanggal_mulai)->format('d M Y') }}
                                                -
                                                {{ \Carbon\Carbon::parse($diskon->tanggal_selesai)->format('d M Y') }}

                                            </div>

                                        @elseif($diskon->jenis == 'diskon')

                                            <small class="text-muted">

                                                Minimal transaksi

                                            </small>

                                            <div>

                                                Rp {{ number_format($diskon->minimal_transaksi, 0, ',', '.') }}

                                            </div>

                                        @elseif($diskon->jenis == 'langganan')

                                            <small class="text-muted">

                                                Minimal kunjungan

                                            </small>

                                            <div>

                                                {{ $diskon->minimal_kunjungan }} kali

                                            </div>

                                        @endif

                                    </td>

                                    <td class="text-center">

                                        @if($diskon->status)

                                            <span class="badge badge-aktif">

                                                Aktif

                                            </span>

                                        @else

                                            <span class="badge badge-batal">

                                                Tidak Aktif

                                            </span>

                                        @endif

                                    </td>

                                    <td class="text-center">

                                        <div class="d-flex justify-content-center gap-2">

                                            <button type="button" class="btn btn-warning-soft btn-sm rounded-circle btn-edit-promo"
                                                data-bs-toggle="modal" data-bs-target="#editPromoModal" data-id="{{ $diskon->id }}"
                                                data-nama="{{ $diskon->nama_diskon }}" data-jenis="{{ $diskon->jenis }}"
                                                data-tipe="{{ $diskon->tipe_potongan }}" data-nilai="{{ $diskon->nilai }}"
                                                data-status="{{ $diskon->status }}"
                                                data-transaksi="{{ $diskon->minimal_transaksi }}"
                                                data-kunjungan="{{ $diskon->minimal_kunjungan }}"
                                                data-mulai="{{ optional($diskon->tanggal_mulai)->format('Y-m-d') }}"
                                                data-selesai="{{ optional($diskon->tanggal_selesai)->format('Y-m-d') }}"
                                                title="Edit" style="
                                                width:36px;
                                                height:36px;
                                                display:flex;
                                                align-items:center;
                                                justify-content:center;
                                            ">

                                                <i class="bi bi-pencil"></i>

                                            </button>

                                            <form action="{{ route('diskon.destroy', $diskon) }}" method="POST" class="delete-form">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger-soft btn-sm rounded-circle"
                                                    title="Hapus"
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

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="d-flex justify-content-end mt-3">

                    {{ $diskons->links() }}

                </div>

            @else

                <div class="text-center py-5">

                    <h5>

                        Belum ada data promo.

                    </h5>

                </div>

            @endif

        </div>

    </div>
    {{-- Modal Tambah Promo --}}
    <div class="modal fade" id="tambahPromoModal" tabindex="-1">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content border-0 shadow rounded-4">

                <form action="{{ route('diskon.store') }}" method="POST">

                    @csrf

                    <div class="modal-header border-0">

                        <div>

                            <h5 class="fw-bold mb-1">

                                Tambah Promo

                            </h5>

                            <small class="text-muted">

                                Tambahkan data promo baru

                            </small>

                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Nama Promo

                                </label>

                                <input type="text" name="nama_diskon" class="form-control rounded-3" required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Jenis

                                </label>

                                <select name="jenis" class="form-select rounded-3" id="jenisTambah">

                                    <option value="">

                                        Pilih Jenis

                                    </option>

                                    <option value="diskon">

                                        Diskon

                                    </option>

                                    <option value="event">

                                        Event

                                    </option>

                                    <option value="langganan">

                                        Langganan

                                    </option>

                                </select>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Tipe Potongan

                                </label>

                                <select name="tipe_potongan" class="form-select rounded-3">

                                    <option value="nominal">

                                        Nominal

                                    </option>

                                    <option value="persen">

                                        Persen

                                    </option>

                                </select>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Nilai Potongan

                                </label>

                                <input type="number" name="nilai" class="form-control rounded-3">

                            </div>

                        </div>

                        {{-- EVENT --}}

                        <div id="eventTambah" style="display:none;">

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label>

                                        Tanggal Mulai

                                    </label>

                                    <input type="date" name="tanggal_mulai" class="form-control">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>

                                        Tanggal Selesai

                                    </label>

                                    <input type="date" name="tanggal_selesai" class="form-control">

                                </div>

                            </div>

                        </div>

                        {{-- DISKON --}}

                        <div id="diskonTambah" style="display:none;">

                            <div class="mb-3">

                                <label>

                                    Minimal Transaksi

                                </label>

                                <input type="number" name="minimal_transaksi" class="form-control">

                            </div>

                        </div>

                        {{-- LANGGANAN --}}

                        <div id="langgananTambah" style="display:none;">

                            <div class="mb-3">

                                <label>

                                    Minimal Kunjungan

                                </label>

                                <input type="number" name="minimal_kunjungan" class="form-control" value="10" readonly>

                            </div>

                        </div>

                        <div class="mb-3">

                            <label>

                                Status

                            </label>

                            <select name="status" class="form-select rounded-3">

                                <option value="1">

                                    Aktif

                                </option>

                                <option value="0">

                                    Tidak Aktif

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

    {{-- Modal Edit Promo --}}
    <div class="modal fade" id="editPromoModal" tabindex="-1">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content border-0 shadow rounded-4">

                <form id="editPromoForm" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="modal-header border-0">

                        <div>

                            <h5 class="fw-bold mb-1">

                                Edit Promo

                            </h5>

                            <small class="text-muted">

                                Perbarui data promo

                            </small>

                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Nama Promo

                                </label>

                                <input type="text" id="editNamaPromo" name="nama_diskon" class="form-control rounded-3"
                                    required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Jenis

                                </label>

                                <select id="editJenis" name="jenis" class="form-select rounded-3">

                                    <option value="diskon">Diskon</option>
                                    <option value="event">Event</option>
                                    <option value="langganan">Langganan</option>

                                </select>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Tipe Potongan

                                </label>

                                <select id="editTipe" name="tipe_potongan" class="form-select rounded-3">

                                    <option value="nominal">Nominal</option>
                                    <option value="persen">Persen</option>

                                </select>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Nilai Potongan

                                </label>

                                <input type="number" id="editNilai" name="nilai" class="form-control rounded-3">

                            </div>

                        </div>

                        {{-- EVENT --}}
                        <div id="editEventField" style="display:none;">

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label>Tanggal Mulai</label>

                                    <input type="date" id="editMulai" name="tanggal_mulai" class="form-control">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>Tanggal Selesai</label>

                                    <input type="date" id="editSelesai" name="tanggal_selesai" class="form-control">

                                </div>

                            </div>

                        </div>

                        {{-- DISKON --}}
                        <div id="editDiskonField" style="display:none;">

                            <div class="mb-3">

                                <label>Minimal Transaksi</label>

                                <input type="number" id="editTransaksi" name="minimal_transaksi" class="form-control">

                            </div>

                        </div>

                        {{-- LANGGANAN --}}
                        <div id="editLanggananField" style="display:none;">

                            <div class="mb-3">

                                <label>Minimal Kunjungan</label>

                                <input type="number" id="editKunjungan" name="minimal_kunjungan" class="form-control">

                            </div>

                        </div>

                        <div class="mb-3">

                            <label>Status</label>

                            <select id="editStatus" name="status" class="form-select">

                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>

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

        document.addEventListener('DOMContentLoaded', function () {

            /* ===========================
               MODAL TAMBAH
            =========================== */

            const jenisTambah = document.getElementById('jenisTambah');

            const eventTambah = document.getElementById('eventTambah');
            const diskonTambah = document.getElementById('diskonTambah');
            const langgananTambah = document.getElementById('langgananTambah');

            function toggleTambah() {

                eventTambah.style.display = "none";
                diskonTambah.style.display = "none";
                langgananTambah.style.display = "none";

                if (jenisTambah.value == "event") {
                    eventTambah.style.display = "block";
                }

                if (jenisTambah.value == "diskon") {
                    diskonTambah.style.display = "block";
                }

                if (jenisTambah.value == "langganan") {
                    langgananTambah.style.display = "block";
                }

            }

            jenisTambah.addEventListener("change", toggleTambah);

            toggleTambah();



            /* ===========================
               MODAL EDIT
            =========================== */

            const jenisEdit = document.getElementById('editJenis');

            const eventEdit = document.getElementById('editEventField');
            const diskonEdit = document.getElementById('editDiskonField');
            const langgananEdit = document.getElementById('editLanggananField');

            function toggleEdit() {

                eventEdit.style.display = "none";
                diskonEdit.style.display = "none";
                langgananEdit.style.display = "none";

                if (jenisEdit.value == "event") {
                    eventEdit.style.display = "block";
                }

                if (jenisEdit.value == "diskon") {
                    diskonEdit.style.display = "block";
                }

                if (jenisEdit.value == "langganan") {
                    langgananEdit.style.display = "block";
                }

            }

            jenisEdit.addEventListener("change", toggleEdit);



            document.querySelectorAll(".btn-edit-promo").forEach(function (btn) {

                btn.addEventListener("click", function () {

                    document.getElementById("editPromoForm").action =
                        "/admin/diskon/" + this.dataset.id;

                    document.getElementById("editNamaPromo").value =
                        this.dataset.nama;

                    document.getElementById("editJenis").value =
                        this.dataset.jenis;

                    document.getElementById("editTipe").value =
                        this.dataset.tipe;

                    document.getElementById("editNilai").value =
                        this.dataset.nilai;

                    document.getElementById("editStatus").value =
                        this.dataset.status;

                    document.getElementById("editTransaksi").value =
                        this.dataset.transaksi;

                    document.getElementById("editKunjungan").value =
                        this.dataset.kunjungan;

                    document.getElementById("editMulai").value =
                        this.dataset.mulai;

                    document.getElementById("editSelesai").value =
                        this.dataset.selesai;

                    toggleEdit();

                });

            });

        });

    </script>
@endsection
