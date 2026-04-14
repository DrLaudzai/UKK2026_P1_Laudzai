@extends('layouts.app')

@section('title', 'Dashboard Petugas')

@section('content')

<div class="row">

    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h4>{{ $pending }}</h4>
                <span>Pending</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h4>{{ $active }}</h4>
                <span>Sedang Dipinjam</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h4>{{ $menungguReturn }}</h4>
                <span>Belum Dikembalikan</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h4>{{ $returned }}</h4>
                <span>Sudah Dikembalikan</span>
            </div>
        </div>
    </div>

</div>

<div class="card mt-2">
    <div class="card-body text-center">
        <h4>Selamat Datang, Petugas 👨‍🔧</h4>
        <p class="text-muted">
            Kelola peminjaman, approval, dan pengembalian alat di sini.
        </p>
    </div>
</div>

@endsection