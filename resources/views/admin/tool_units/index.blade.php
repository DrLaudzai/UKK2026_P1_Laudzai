@extends('layouts.app')

@section('title', 'Unit Tools')

@section('content')

    <section id="configuration">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Data Unit Tools</h4>

                        <a href="{{ route('tool-units.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Tambah Unit
                        </a>
                    </div>

                    <div class="card-body">

                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Tools</th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                    <th width="50">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($unitTools as $item)
                                    <tr>

                                        <td><strong>{{ $item->code }}</strong></td>
                                        <td>{{ $item->tool->name ?? '-' }}</td>

                                        <td>
                                            @php
                                                $statusMap = [
                                                    'available' => ['label' => 'Available', 'color' => 'success'],
                                                    'lent' => ['label' => 'Borrowed', 'color' => 'warning'],
                                                    'nonactive' => ['label' => 'Non Active', 'color' => 'secondary'],
                                                ];
                                            @endphp

                                            <span class="badge bg-{{ $statusMap[$item->status]['color'] ?? 'dark' }}">
                                                {{ $statusMap[$item->status]['label'] ?? '-' }}
                                            </span>
                                        </td>

                                        <td>{{ $item->notes ?? '-' }}</td>

                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-light" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>

                                                <div class="dropdown-menu dropdown-menu-right">

                                                    <!-- EDIT (pakai code, bukan id) -->
                                                    <a class="dropdown-item"
                                                        href="{{ route('tool-units.edit', $item->code) }}">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>

                                                    <!-- DELETE (pakai code juga) -->
                                                    <form action="{{ route('tool-units.destroy', $item->code) }}"
                                                        method="POST" onsubmit="return confirm('Yakin hapus unit ini?')">
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
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data unit</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Tools</th>
                                    <th>Status</th>
                                    <th>Notes</th>
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
