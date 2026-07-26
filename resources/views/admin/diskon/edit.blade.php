@extends('admin.layout')
@section('title', 'Edit Promo')
@section('content')

    <div class="card">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h4 class="mb-0">
                    Edit Promo
                </h4>

                <a href="{{ route('diskon.index') }}" class="btn btn-outline-soft">
                    Kembali
                </a>

            </div>

            <form action="{{ route('diskon.update', $diskon) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nama Diskon
                        </label>

                        <input type="text" name="nama_diskon" class="form-control" placeholder="Masukkan nama diskon"
                            value="{{ old('nama_diskon', $diskon->nama_diskon) }}">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Jenis
                        </label>

                        <select name="jenis" class="form-select" id="jenis">

                            <option value="">Pilih Jenis</option>

                            <option value="diskon" @if(old('jenis', $diskon->jenis) == 'diskon') selected @endif>

                                Diskon

                            </option>

                            <option value="event" @if(old('jenis', $diskon->jenis) == 'event') selected @endif>

                                Event

                            </option>

                            <option value="langganan" @if(old('jenis', $diskon->jenis) == 'langganan') selected @endif>

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

                        <input type="number" name="nilai" class="form-control" value="{{ old('nilai', $diskon->nilai) }}">

                    </div>

                </div>

                {{-- Event --}}

                <div id="eventField" style="display:none;">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Tanggal Mulai</label>

                            <input type="date" name="tanggal_mulai" class="form-control"
                                value="{{ old('tanggal_mulai', $diskon->tanggal_mulai?->format('Y-m-d')) }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Tanggal Selesai</label>

                            <input type="date" name="tanggal_selesai" class="form-control"
                                value="{{ old('tanggal_selesai', $diskon->tanggal_selesai?->format('Y-m-d')) }}">

                        </div>

                    </div>

                </div>

                {{-- Diskon --}}

                <div id="diskonField" style="display:none;">

                    <div class="mb-3">

                        <label>
                            Minimal Transaksi
                        </label>

                        <input type="number" name="minimal_transaksi" class="form-control"
                            value="{{ old('minimal_transaksi', $diskon->minimal_transaksi) }}">

                    </div>

                </div>

                {{-- Langganan --}}

                <div id="langgananField" style="display:none;">

                    <div class="mb-3">

                        <label>
                            Minimal Kunjungan
                        </label>

                        <input type="number" name="minimal_kunjungan" class="form-control"
                            value="{{ old('minimal_kunjungan', $diskon->minimal_kunjungan) }}">

                        <small class="text-muted">
                            Program loyalitas salon menggunakan 10 kali kunjungan.
                        </small>

                    </div>

                </div>

                <div class="mb-3">

                    <label>Status</label>

                    <select name="status" class="form-select">

                        <option value="1" @if(old('status', $diskon->status) == 1) selected @endif>

                            Aktif

                        </option>

                        <option value="0" @if(old('status', $diskon->status) == 0) selected @endif>

                            Tidak Aktif

                        </option>

                    </select>

                </div>

                <button type="submit" class="btn btn-add-soft">

                    <i class="bi bi-check-circle"></i>

                    Update Promo

                </button>

            </form>

        </div>

    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const jenis = document.getElementById('jenis');
            const eventField = document.getElementById('eventField');
            const diskonField = document.getElementById('diskonField');
            const langgananField = document.getElementById('langgananField');

            function toggleField() {

                eventField.style.display = 'none';
                diskonField.style.display = 'none';
                langgananField.style.display = 'none';

                if (jenis.value === 'event') {
                    eventField.style.display = 'block';
                }

                if (jenis.value === 'diskon') {
                    diskonField.style.display = 'block';
                }

                if (jenis.value === 'langganan') {
                    langgananField.style.display = 'block';
                }
            }

            toggleField();

            jenis.addEventListener('change', toggleField);

        });
    </script>
@endpush