@extends('admin.layout')
@section('title', 'Tambah Promo')
@section('content')

    <div class="card">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h4 class="mb-0">
                    Tambah Promo
                </h4>

                <a href="{{ route('diskon.index') }}" class="btn btn-outline-soft">
                    Kembali
                </a>

            </div>

            <form action="{{ route('diskon.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nama Diskon
                        </label>

                        <input type="text" name="nama_diskon" class="form-control" placeholder="Masukkan nama diskon"
                            value="{{ old('nama_diskon') }}">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Jenis
                        </label>

                        <select name="jenis" class="form-select" id="jenis">

                            <option value="">Pilih Jenis</option>

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

                        <select name="tipe_potongan" class="form-select" id="tipe_potongan">

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

                        <input type="number" name="nilai" class="form-control" value="{{ old('nilai') }}">

                    </div>

                </div>

                {{-- Event --}}

                <div id="eventField" style="display:none;">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Tanggal Mulai</label>

                            <input type="date" name="tanggal_mulai" class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Tanggal Selesai</label>

                            <input type="date" name="tanggal_selesai" class="form-control">

                        </div>

                    </div>

                </div>

                {{-- Diskon --}}

                <div id="diskonField" style="display:none;">

                    <div class="mb-3">

                        <label>
                            Minimal Transaksi
                        </label>

                        <input type="number" name="minimal_transaksi" class="form-control">

                    </div>

                </div>

                {{-- Langganan --}}

                <div id="langgananField" style="display:none;">

                    <div class="mb-3">

                        <label>
                            Minimal Kunjungan
                        </label>

                        <input type="number" name="minimal_kunjungan" class="form-control" value="10" readonly>

                        <small class="text-muted">
                            Program loyalitas salon menggunakan 10 kali kunjungan.
                        </small>

                    </div>

                </div>

                <div class="mb-3">

                    <label>Status</label>

                    <select name="status" class="form-select">

                        <option value="1">
                            Aktif
                        </option>

                        <option value="0">
                            Tidak Aktif
                        </option>

                    </select>

                </div>

                <button type="submit" class="btn btn-add-soft">

                    <i class="bi bi-check-circle"></i>

                    Simpan

                </button>

            </form>

        </div>

    </div>

@endsection

@push('scripts')

    <script>

        const jenis = document.getElementById('jenis');

        const eventField = document.getElementById('eventField');
        const diskonField = document.getElementById('diskonField');
        const langgananField = document.getElementById('langgananField');

        <script>
            document.addEventListener('DOMContentLoaded', function () {

        const jenis = document.getElementById('jenis');
            const eventField = document.getElementById('eventField');
            const transaksiField = document.getElementById('transaksiField');
            const kunjunganField = document.getElementById('kunjunganField');

            function toggleField() {

                eventField.style.display = 'none';
            transaksiField.style.display = 'none';
            kunjunganField.style.display = 'none';

            if (jenis.value === 'event') {
                eventField.style.display = 'block';
            }

            if (jenis.value === 'diskon') {
                transaksiField.style.display = 'block';
            }

            if (jenis.value === 'langganan') {
                kunjunganField.style.display = 'block';
            }

        }

            toggleField();

            jenis.addEventListener('change', toggleField);

    });
    </script>

    </script>

@endpush