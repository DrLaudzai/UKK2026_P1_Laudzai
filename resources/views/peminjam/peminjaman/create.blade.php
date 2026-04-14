@extends('layouts.app')

@section('title', 'Ajukan Peminjaman')

@section('content')

<div class="content-body">

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Ajukan Peminjaman</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('peminjam.peminjaman.store') }}" method="POST">
                @csrf

                {{-- TOOL --}}
                <div class="form-group">
                    <label>Alat</label>
                    <select name="tool_id" class="form-control" required>
                        <option value="">-- Pilih Alat --</option>
                        @foreach($tools as $tool)
                            <option value="{{ $tool->id }}">{{ $tool->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- UNIT --}}
                <div class="form-group">
                    <label>Unit</label>
                    <select name="unit_code" class="form-control" required>
                        <option value="">-- Pilih Unit --</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->code }}">
                                {{ $unit->code }} - {{ $unit->tool->name ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- TANGGAL --}}
                <div class="form-group">
                    <label>Tanggal Pinjam</label>
                    <input type="date" name="loan_date" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Kembali</label>
                    <input type="date" name="due_date" class="form-control" required>
                </div>

                {{-- TUJUAN --}}
                <div class="form-group">
                    <label>Tujuan</label>
                    <textarea name="purpose" class="form-control" rows="3" required></textarea>
                </div>

                {{-- BUTTON --}}
                <div class="mt-2">
                    <button class="btn btn-success">
                        <i class="fa fa-save"></i> Ajukan
                    </button>

                    <a href="{{ route('peminjam.peminjaman.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection