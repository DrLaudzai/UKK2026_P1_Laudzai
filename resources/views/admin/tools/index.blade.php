@extends('layouts.app')

@section('title', 'Tools')

@section('content')

<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Data Tools</h4>

                    <a href="{{ route('tools.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tambah Tools
                    </a>
                </div>

                <div class="card-body">

                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Min Score</th>
                                <th width="50">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($tools as $tool)
                            <tr>

                                <td>
                                    @if($tool->photo_path)
                                    <img src="{{ asset('storage/'.$tool->photo_path) }}"
                                        width="50">
                                    @endif
                                </td>

                                <td>{{ $tool->category->name ?? '-' }}</td>
                                <td>{{ $tool->name }}</td>
                                <td>{{ $tool->item_type }}</td>
                                <td>{{ $tool->price }}</td>
                                <td>{{ $tool->min_credit_score }}</td>

                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light"
                                            data-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-right">

                                            <a class="dropdown-item"
                                                href="{{ route('tools.edit',$tool->id) }}">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>

                                            <form action="{{ route('tools.destroy',$tool->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button class="dropdown-item text-danger">
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
                                <th>Photo</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Min Score</th>
                                <th width="50">Aksi</th>
                            </tr>
                        </tfoot>

                    </table>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection