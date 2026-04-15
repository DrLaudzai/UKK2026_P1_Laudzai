@extends('layouts.app')

@section('title', 'Kelola Banding')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Daftar Banding</h4>
    </div>

    <div class="card-body">

        <table class="table table-bordered">
            <tr>
                <th>User</th>
                <th>Alasan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            @foreach ($appeals as $a)
            <tr>
                <td>{{ $a->user->detail->name ?? '-' }}</td>
                <td>{{ $a->reason }}</td>
                <td>{{ $a->status }}</td>
                <td>

                    @if ($a->status == 'pending')

                    <!-- APPROVE -->
                    <form action="{{ route('admin.appeals.approve', $a->id) }}" method="POST">
                        @csrf
                        <input type="number" name="credit_changed" placeholder="Tambah poin" required>
                        <button class="btn btn-success btn-sm">Approve</button>
                    </form>

                    <!-- REJECT -->
                    <form action="{{ route('admin.appeals.reject', $a->id) }}" method="POST">
                        @csrf
                        <input type="text" name="admin_notes" placeholder="Alasan" required>
                        <button class="btn btn-danger btn-sm">Reject</button>
                    </form>

                    @endif

                </td>
            </tr>
            @endforeach

        </table>

    </div>
</div>

@endsection