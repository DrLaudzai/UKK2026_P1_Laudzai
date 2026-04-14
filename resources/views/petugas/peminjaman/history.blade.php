@extends('layouts.app')

@section('title', 'History Peminjaman')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>History Semua Peminjaman</h4>
    </div>

    <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Alat</th>
                    <th>Unit</th>
                    <th>Status</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                </tr>
            </thead>

            <tbody>
                @foreach($loans as $loan)
                <tr>
                    <td>{{ $loan->user->detail->name ?? '-' }}</td>
                    <td>{{ $loan->tool->name ?? '-' }}</td>
                    <td>{{ $loan->unit_code }}</td>

                    <td>
                        @if($loan->status == 'closed')
                            <span class="badge badge-success">Selesai</span>

                        @elseif($loan->status == 'rejected')
                            <span class="badge badge-danger">Ditolak</span>
                        @endif
                    </td>

                    <td>{{ $loan->loan_date }}</td>
                    <td>{{ $loan->due_date }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

@endsection
