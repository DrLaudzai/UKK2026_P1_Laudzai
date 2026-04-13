@extends('layouts.app')

@section('title', 'Detail Tools')

@section('content')

<div class="content-body">
    <section>
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Detail Tools</h4>
                    </div>

                    <div class="card-body">

                        <div class="text-center mb-3">
                            @if ($tool->photo_path)
                                <img src="{{ asset('storage/' . $tool->photo_path) }}" width="120">
                            @endif
                        </div>

                        <table class="table table-bordered">
                            <tr>
                                <th width="200">Category</th>
                                <td>{{ $tool->category->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $tool->name }}</td>
                            </tr>
                            <tr>
                                <th>Type</th>
                                <td>
                                    @if($tool->item_type == 'bundle')
                                        <span class="badge badge-info">BUNDLE</span>
                                    @else
                                        <span class="badge badge-success">SINGLE</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>{{ $tool->price }}</td>
                            </tr>
                            <tr>
                                <th>Min Score</th>
                                <td>{{ $tool->min_credit_score }}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{ $tool->description }}</td>
                            </tr>
                        </table>

                        {{-- 🔥 KHUSUS BUNDLE --}}
                        @if ($tool->item_type === 'bundle')
                                        <tr id="bundle-{{ $tool->id }}" style="display: none;">
                                            <td colspan="7">
                                                <strong>Komponen Bundle:</strong>

                                                <table class="table table-sm mt-2">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama</th>
                                                            <th>Qty</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($bundleItems as $item)
                                                            <tr>
                                                                <td>{{ $item->name }}</td>
                                                                <td>{{ $item->qty }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                            </td>
                                        </tr>
                                    @endif

                        <div class="mt-3">
                            <a href="{{ route('tools.index') }}" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

@endsection