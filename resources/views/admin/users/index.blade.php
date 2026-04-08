@extends('layouts.app')

@section('title', 'Users')

@section('content')

    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">

                        <h4 class="card-title mb-0">Data Users</h4>

                        <a href="{{ route('users.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Tambah User
                        </a>

                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">

                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Credit Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->detail->name ?? '-' }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>{{ $user->credit_score }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-icon btn-light" type="button"
                                                        data-toggle="dropdown">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>

                                                    <div class="dropdown-menu dropdown-menu-right">


                                                        <!-- Edit -->
                                                        <a class="dropdown-item"
                                                            href="{{ route('users.edit', $user->id) }}">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>

                                                        <!-- Hapus -->
                                                        <form action="{{ route('users.destroy', $user->id) }}"
                                                            method="POST" class="delete-user-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger">
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Credit Score</th>
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
