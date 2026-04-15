@extends('layouts.app')

@section('title', 'Settlement Pelanggaran')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Daftar Pelanggaran</h4>
    </div>

    <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Alat</th>
                    <th>Tipe</th>
                    <th>Denda</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($violations as $v)
                    <tr>
                        <td>{{ $v->user->detail->name ?? '-' }}</td>
                        <td>{{ $v->loan->tool->name ?? '-' }}</td>
                        <td>
                            <span class="badge badge-warning">
                                {{ strtoupper($v->type) }}
                            </span>
                        </td>

                        <td>
                            Rp {{ number_format($v->fine, 0, ',', '.') }}
                        </td>

                        <td>
                            @if ($v->status == 'active')
                                <span class="badge badge-danger">Belum Selesai</span>
                            @else
                                <span class="badge badge-success">Selesai</span>
                            @endif
                        </td>

                        <td>
                            @if ($v->status == 'active')
                                <button class="btn btn-success btn-sm"
                                    data-toggle="modal"
                                    data-target="#settleModal{{ $v->id }}">
                                    Selesaikan
                                </button>
                            @else
                                <span class="text-success">✔</span>
                            @endif
                        </td>
                    </tr>

                    <!-- MODAL -->
                    <div class="modal fade" id="settleModal{{ $v->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <form action="{{ route('settlements.store', $v->id) }}" method="POST">
                                    @csrf

                                    <div class="modal-header">
                                        <h5 class="modal-title">Selesaikan Pelanggaran</h5>
                                    </div>

                                    <div class="modal-body">
                                        <p><b>User:</b> {{ $v->user->detail->name ?? '-' }}</p>
                                        <p><b>Denda:</b> Rp {{ number_format($v->fine, 0, ',', '.') }}</p>

                                        <label>Deskripsi</label>
                                        <textarea name="description" class="form-control" required
                                            placeholder="Contoh: bayar denda / ganti alat"></textarea>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-success">Konfirmasi</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>

                @endforeach
            </tbody>

        </table>

    </div>
</div>

@endsection