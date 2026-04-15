@extends('layouts.app')

@section('title', 'Banding')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Ajukan Banding</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('peminjam.appeals.store') }}" method="POST">
            @csrf

            <label>Alasan Banding</label>
            <textarea name="reason" class="form-control" required></textarea>

            <br>
            <button class="btn btn-primary">Ajukan</button>
        </form>

        <hr>

        <h5>Riwayat Banding</h5>

        <table class="table">
            <tr>
                <th>Alasan</th>
                <th>Status</th>
            </tr>

            @foreach ($appeals as $a)
            <tr>
                <td>{{ $a->reason }}</td>
                <td>
                    @if ($a->status == 'pending')
                        <span class="badge badge-warning">Pending</span>
                    @elseif($a->status == 'approved')
                        <span class="badge badge-success">Disetujui</span>
                    @else
                        <span class="badge badge-danger">Ditolak</span>
                    @endif
                </td>
            </tr>
            @endforeach

        </table>

    </div>
</div>

@endsection