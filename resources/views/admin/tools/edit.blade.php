@extends('layouts.app')

@section('title', 'Edit Tools')

@section('content')

<div class="content-body">
    <section>
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Tools</h4>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('tools.update',$tool->id) }}"
                            method="POST"
                            enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Category</label>
                                <select name="category_id" class="form-control">

                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $tool->category_id == $category->id ? 'selected' : '' }}>
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
                                    value="{{ $tool->name }}">
                            </div>

                            <div class="form-group">
                                <label>Item Type</label>
                                <select name="item_type" class="form-control" disabled>

                                    <option value="single"
                                        {{ $tool->item_type == 'single' ? 'selected' : '' }}>
                                        Single
                                    </option>

                                    <option value="bundle"
                                        {{ $tool->item_type == 'bundle' ? 'selected' : '' }}>
                                        Bundle
                                    </option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Price</label>
                                <input type="number"
                                    name="price"
                                    class="form-control"
                                    value="{{ $tool->price }}">
                            </div>

                            <div class="form-group">
                                <label>Min Credit Score</label>
                                <input type="number"
                                    name="min_credit_score"
                                    class="form-control"
                                    value="{{ $tool->min_credit_score }}">
                            </div>

                            <div class="form-group">
                                <label>Code</label>
                                <input type="text"
                                    name="code_slug"
                                    class="form-control"
                                    value="{{ $tool->code_slug }}">
                            </div>

                            <div class="form-group">
                                <label>Photo</label>
                                <input type="file" name="photo_path" class="form-control">

                                @if($tool->photo_path)
                                <br>
                                <img src="{{ asset('storage/'.$tool->photo_path) }}"
                                    width="80">
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description"
                                    class="form-control">{{ $tool->description }}</textarea>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>

                                <a href="{{ route('tools.index') }}"
                                    class="btn btn-warning">
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