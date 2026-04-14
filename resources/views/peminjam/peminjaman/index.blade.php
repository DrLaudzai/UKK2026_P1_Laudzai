@extends('layouts.app')

@section('title', 'Peminjaman')

@section('content')

<div class="content-body">

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Data Peminjaman</h4>

            <a href="{{ route('peminjam.peminjaman.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Ajukan Peminjaman
            </a>
        </div>

        <div class="card-body">

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Alat</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Tujuan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($loans as $loan)
                        <tr>
                            <td>{{ $loan->tool->name ?? '-' }}</td>
                            <td>{{ $loan->unit_code }}</td>

                            <td>
                                @if($loan->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($loan->status == 'active')
                                    <span class="badge badge-primary">Dipinjam</span>
                                @elseif($loan->status == 'closed')
                                    <span class="badge badge-success">Selesai</span>
                                @elseif($loan->status == 'rejected')
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>

                            <td>{{ $loan->loan_date }}</td>
                            <td>{{ $loan->due_date }}</td>
                            <td>{{ $loan->purpose }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data peminjaman</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection