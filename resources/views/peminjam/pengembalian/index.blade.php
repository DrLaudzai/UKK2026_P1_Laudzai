@extends('layouts.app')

@section('title', 'Pengembalian')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Pengembalian Alat</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Alat</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($loans as $loan)
                        <tr>
                            <td>{{ $loan->tool->name }}</td>
                            <td>{{ $loan->unit_code }}</td>

                            <td>
                                @if ($loan->return)
                                    <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                @else
                                    <span class="badge badge-primary">Dipinjam</span>
                                @endif
                            </td>

                            <td>
                                @if (!$loan->return)
                                    <form action="{{ route('peminjam.pengembalian.request', $loan->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <select name="condition" class="form-control" required>
                                            <option value="">Pilih Kondisi</option>
                                            <option value="good">Baik</option>
                                            <option value="broken">Rusak</option>
                                            <option value="maintenance">Maintenance</option>
                                        </select>


                                        <input type="file" name="proof" class="form-control mb-1" required>

                                        <button class="btn btn-sm btn-danger">
                                            Ajukan Pengembalian
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>
                                        Menunggu Petugas
                                    </button>
                                @endif
                            </td>


                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

@endsection
