@extends('layouts.app')

@section('title', 'Log Aktivitas')

@section('content')

<div class="content-body">
    <section>
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Log Aktivitas</h4>
                    </div>

                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Module</th>
                                    <th>Action</th>
                                    <th>Deskripsi</th>
                                    <th>IP</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($logs as $log)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $log->module }}</td>
                                    <td>
                                        <span class="badge badge-info">
                                            {{ $log->action }}
                                        </span>
                                    </td>
                                    <td>{{ $log->description }}</td>
                                    <td>{{ $log->ip_address }}</td>
                                    <td>{{ $log->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

@endsection