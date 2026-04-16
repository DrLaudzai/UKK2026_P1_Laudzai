@extends('layouts.app')

@section('title', 'Cetak Laporan')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Cetak Laporan</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('petugas.reports.print') }}" method="POST" target="_blank">
            @csrf

            <div class="form-group">
                <label>Jenis Laporan</label>
                <select name="type" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="loan">Peminjaman</option>
                    <option value="violation">Pelanggaran</option>
                    <option value="settlement">Settlement</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label>Dari Tanggal</label>
                    <input type="date" name="from" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Sampai Tanggal</label>
                    <input type="date" name="to" class="form-control">
                </div>
            </div>

            <br>

            <button class="btn btn-primary">
                <i class="fa fa-print"></i> Cetak
            </button>

        </form>

    </div>
</div>

@endsection