@extends('layouts.app')

@section('title', 'Tambah Unit Tools')

@section('content')

<div class="content-body">
    <section>
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Unit Tools</h4>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('tool-units.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label>Tools</label>
                                <select name="tool_id" class="form-control" required>
                                    <option value="">-- Pilih Tools --</option>

                                    @foreach($tools as $tool)
                                    <option value="{{ $tool->id }}"
                                        {{ old('tool_id') == $tool->id ? 'selected' : '' }}>
                                        {{ $tool->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="nonactive" {{ old('status') == 'nonactive' ? 'selected' : '' }}>Non-active</option>
                                    <option value="lent" {{ old('status') == 'lent' ? 'selected' : '' }}>Borrowed</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Notes</label>
                                <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Simpan
                                </button>

                                <a href="{{ route('tool-units.index') }}" class="btn btn-warning">
                                    Batal
                                </a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

@endsection