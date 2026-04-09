@extends('layouts.app')

@section('title', 'Categories')

@section('content')

<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Data Categories</h4>

                    <a href="{{ route('categories.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tambah Category
                    </a>
                </div>

                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">

                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th width="50">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-icon btn-light"
                                                data-toggle="dropdown">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>

                                            <div class="dropdown-menu dropdown-menu-right">

                                                <a class="dropdown-item"
                                                    href="{{ route('categories.edit',$category->id) }}">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>

                                                <form action="{{ route('categories.destroy',$category->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="dropdown-item text-danger">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </form>

                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th width="50">Aksi</th>
                                </tr>
                            </tfoot>

                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection