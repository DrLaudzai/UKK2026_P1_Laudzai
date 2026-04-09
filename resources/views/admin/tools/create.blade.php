@extends('layouts.app')

@section('title', 'Tambah Tools')

@section('content')

<div class="content-body">
    <section>
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Tools</h4>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('tools.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>Category</label>
                                <select name="category_id" class="form-control" required>

                                    <option value="">-- Pilih Category --</option>

                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nama Tools</label>
                                <input type="text"
                                    name="name"
                                    class="form-control"
                                    value="{{ old('name') }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Item Type</label>
                                <select name="item_type" class="form-control" required>

                                    <option value="">-- Pilih Type --</option>

                                    <option value="single">Single</option>
                                    <option value="bundle">Bundle</option>
                                    <option value="bundle_tool">Bundle Tool</option>


                                </select>
                            </div>

                            <div class="form-group">
                                <label>Price</label>
                                <input type="number"
                                    name="price"
                                    class="form-control"
                                    value="{{ old('price') }}">
                            </div>

                            <div class="form-group">
                                <label>Min Credit Score</label>
                                <input type="number"
                                    name="min_credit_score"
                                    class="form-control"
                                    value="{{ old('min_credit_score') }}">
                            </div>

                            <div class="form-group">
                                <label>Code</label>
                                <input type="text"
                                    name="code_slug"
                                    class="form-control"
                                    value="{{ old('code_slug') }}">
                            </div>

                            <div class="form-group">
                                <label>Photo</label>
                                <input type="file" name="photo_path" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description"
                                    class="form-control">{{ old('description') }}</textarea>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Simpan
                                </button>

                                <a href="{{ route('tools.index') }}" class="btn btn-warning">
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