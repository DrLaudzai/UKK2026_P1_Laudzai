@extends('layouts.app')

@section('title', 'Tambah Category')

@section('content')

<div class="content-body">
    <section>
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Category</h4>
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

                            <form action="{{ route('categories.store') }}" method="POST">
                                @csrf

                                <div class="form-body">

                                    <div class="form-group">
                                        <label>Nama Category</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>

                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> Simpan
                                    </button>

                                    <a href="{{ route('categories.index') }}" class="btn btn-warning mr-1">
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