@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="content-body">
    <div class="row">

        {{-- TOTAL TOOLS --}}
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card bg-primary text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4>{{ $totalTools }}</h4>
                        <span>Tools</span>
                    </div>
                    <i class="fa fa-wrench fa-2x"></i>
                </div>
            </div>
        </div>

        {{-- TOTAL BUNDLE --}}
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card bg-info text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4>{{ $totalBundle }}</h4>
                        <span>Bundle</span>
                    </div>
                    <i class="fa fa-cubes fa-2x"></i>
                </div>
            </div>
        </div>

        {{-- TOTAL UNIT --}}
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card bg-success text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4>{{ $totalUnit }}</h4>
                        <span>Unit</span>
                    </div>
                    <i class="fa fa-cube fa-2x"></i>
                </div>
            </div>
        </div>

        {{-- TOTAL USER --}}
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card bg-warning text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4>{{ $totalUser }}</h4>
                        <span>User</span>
                    </div>
                    <i class="fa fa-users fa-2x"></i>
                </div>
            </div>
        </div>

        {{-- TOTAL LOG
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card bg-dark text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4>{{ $totalLog }}</h4>
                        <span>Activity Log</span>
                    </div>
                    <i class="fa fa-history fa-2x"></i>
                </div>
            </div>
        </div> --}}

    </div>

    {{-- INFO PANEL --}}
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <h4>Selamat Datang di Sistem Inventaris</h4>
                    <p class="text-muted">
                        Gunakan menu di samping untuk mengelola Tools, Bundle, Unit, dan aktivitas sistem.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection