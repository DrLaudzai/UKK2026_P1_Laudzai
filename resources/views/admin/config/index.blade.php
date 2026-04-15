@extends('layouts.app')

@section('title', 'Konfigurasi Aplikasi')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Konfigurasi Aplikasi</h4>
        </div>

        <div class="card-body">



            <form action="{{ route('config.update') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nama Aplikasi</label>
                    <input type="text" name="name" class="form-control" value="{{ $config->name ?? '' }}" required>
                </div>

                <hr>

                <h5>Poin Penalty</h5>

                <div class="row">
                    <div class="col-md-4">
                        <label>Poin Keterlambatan</label>
                        <input type="number" name="late_point" class="form-control" value="{{ $config->late_point ?? 0 }}"
                            required>
                    </div>

                    <div class="col-md-4">
                        <label>Poin Kerusakan</label>
                        <input type="number" name="broken_point" class="form-control"
                            value="{{ $config->broken_point ?? 0 }}" required>
                    </div>

                    <div class="col-md-4">
                        <label>Poin Kehilangan</label>
                        <input type="number" name="lost_point" class="form-control" value="{{ $config->lost_point ?? 0 }}"
                            required>
                    </div>
                </div>

                <hr>

                <h5>Denda (%)</h5>

                <div class="row">
                    <div class="col-md-4">
                        <label>Denda Keterlambatan (%)</label>
                        <div class="input-group">
                            <input type="number" name="late_fine" class="form-control"
                                value="{{ $config->late_fine ?? 0 }}" required>
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label>Denda Kerusakan (%)</label>
                        <div class="input-group">
                            <input type="number" name="broken_fine" class="form-control"
                                value="{{ $config->broken_fine ?? 0 }}" required>
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label>Denda Kehilangan (%)</label>
                        <div class="input-group">
                            <input type="number" name="lost_fine" class="form-control"
                                value="{{ $config->lost_fine ?? 0 }}" required>
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <small class="text-muted">
                    Denda dihitung berdasarkan persentase dari harga barang.
                </small>

                <br>

                <button class="btn btn-success">Simpan</button>

            </form>

        </div>
    </div>

@endsection
