@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

    <div class="content-body">
        <section>
            <div class="row justify-content-center">
                <div class="col-md-6">

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah User</h4>
                        </div>

                        <div class="card-content collapse show">
                            <div class="card-body">

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('users.store') }}" method="POST">
                                    @csrf

                                    <div class="form-body">

                                        {{-- EMAIL --}}
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>

                                        {{-- PASSWORD --}}
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control" required>
                                        </div>

                                        {{-- ROLE --}}
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select name="role" class="form-control" required>
                                                <option value="">-- Pilih Role --</option>
                                                <option value="admin">Admin</option>
                                                <option value="petugas">Petugas</option>
                                                <option value="peminjam">Peminjam</option>
                                            </select>
                                        </div>

                                        <hr>
                                        <h5>Detail User</h5>

                                        <div class="form-group">
                                            <label>NIK</label>
                                            <input type="text" name="nik" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>No HP</label>
                                            <input type="text" name="no_hp" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" name="address" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" name="birth_date" class="form-control" required>
                                        </div>

                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Simpan
                                        </button>
                                        <a href="{{ route('users.index') }}" class="btn btn-warning mr-1">
                                            <i class="feather icon-x"></i> Batal
                                        </a>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

@endsection
