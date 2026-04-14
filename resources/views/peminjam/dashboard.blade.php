@extends('layouts.app')

@section('title', 'Dashboard Peminjam')

@section('content')

<div class="content-body">
    <div class="row">

        {{-- TOTAL PINJAMAN --}}
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card bg-primary text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4>{{ $totalPinjam }}</h4>
                        <span>Total Pinjaman</span>
                    </div>
                    <i class="fa fa-box fa-2x"></i>
                </div>
            </div>
        </div>

        {{-- SEDANG DIPINJAM --}}
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card bg-warning text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4>{{ $dipinjam }}</h4>
                        <span>Sedang Dipinjam</span>
                    </div>
                    <i class="fa fa-clock fa-2x"></i>
                </div>
            </div>
        </div>

        {{-- SUDAH DIKEMBALIKAN --}}
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card bg-success text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4>{{ $dikembalikan }}</h4>
                        <span>Dikembalikan</span>
                    </div>
                    <i class="fa fa-check fa-2x"></i>
                </div>
            </div>
        </div>

        {{-- TERLAMBAT --}}
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card bg-danger text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4>{{ $terlambat }}</h4>
                        <span>Terlambat</span>
                    </div>
                    <i class="fa fa-exclamation-triangle fa-2x"></i>
                </div>
            </div>
        </div>

    </div>

    {{-- PEMINJAMAN AKTIF --}}
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Peminjaman Aktif</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Alat</th>
                                <th>Tanggal Pinjam</th>
                                <th>Deadline</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($activeLoans as $item)
                                <tr>
                                    <td>{{ $item->tool->name }}</td>
                                    <td>{{ $item->tanggal_pinjam }}</td>
                                    <td>{{ $item->tanggal_kembali }}</td>
                                    <td>
                                        @if($item->is_terlambat)
                                            <span class="badge bg-danger">Terlambat</span>
                                        @else
                                            <span class="badge bg-warning">Dipinjam</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- WELCOME --}}
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <h4>Selamat Datang</h4>
                    <p class="text-muted">
                        Silakan ajukan peminjaman alat atau lihat riwayat Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection