@extends('admin.layout')
@section('title', 'Data Terapis')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Data Terapis</h6>
                <a href="/admin/terapis/create" class="btn btn-add btn-sm">+ Tambah</a>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Terapis</th>
                        <th>Informasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($terapis as $i => $t)
                        <tr>
                            <td>{{ $terapis->firstItem() + $i }}</td>
                            <td>{{ $t->nama_terapis }}</td>
                            <td style="font-size:0.82rem">

                                <div class="mb-1">
                                    ⭐ <strong>{{ number_format($t->rating, 1) }}</strong>
                                    &nbsp; | &nbsp;
                                    📅 <strong>{{ $t->booking_selesai }}</strong>
                                    &nbsp; | &nbsp;
                                    💬 <strong>{{ $t->total_review }}</strong>
                                </div>

                                @if($terapisUnggulan && $terapisUnggulan->id == $t->id)
                                    <span class="badge" style="background:#fff3cd;color:#856404;">
                                        👑 Terapis Unggulan
                                    </span>
                                @endif

                            </td>
                            <td>
                                <span class="badge {{ $t->status === 'aktif' ? 'badge-aktif' : 'badge-batal' }}">
                                    {{ ucfirst($t->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="/admin/terapis/{{ $t->id }}/edit" class="btn btn-warning btn-sm rounded-3">Edit</a>
                                <form action="/admin/terapis/{{ $t->id }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin hapus?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm rounded-3">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Belum ada terapis</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $terapis->links() }}
        </div>
    </div>
@endsection