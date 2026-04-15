@extends('layouts.app')

@section('title', 'Tambah Tools')

@section('content')

    <div class="content-body">
        <section>
            <div class="row justify-content-center">
                <div class="col-md-8">

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
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Nama Tools</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Item Type</label>
                                    <select name="item_type" id="item_type" class="form-control" required>
                                        <option value="">-- Pilih Type --</option>
                                        <option value="single">Single</option>
                                        <option value="bundle">Bundle</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" name="price" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Min Credit Score</label>
                                    <input type="number" name="min_credit_score" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" name="code_slug" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Photo</label>
                                    <input type="file" name="photo_path" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control"></textarea>
                                </div>

                                {{-- BUNDLE --}}
                                <div id="bundle-section" style="display:none;">
                                    <hr>
                                    <h5>Komponen Bundle</h5>

                                    <div id="bundle-items"></div>

                                    <button type="button" class="btn btn-success mt-2" onclick="addBundleItem()">
                                        + Tambah Item
                                    </button>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('tools.index') }}" class="btn btn-warning">Batal</a>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <script>
        const itemType = document.getElementById('item_type');
        const bundleSection = document.getElementById('bundle-section');

        itemType.addEventListener('change', function() {
            bundleSection.style.display = (this.value === 'bundle') ? 'block' : 'none';
        });

        function addBundleItem() {
            let html = `
    <div class="row mb-2">
        <div class="col-md-3">
            <input type="text" name="bundle_name[]" class="form-control" placeholder="Nama Item" required>
        </div>
        <div class="col-md-2">
            <input type="number" name="bundle_qty[]" class="form-control" placeholder="Qty" required>
        </div>
        <div class="col-md-2">
            <input type="number" name="bundle_price[]" class="form-control" placeholder="Price">
        </div>
        <div class="col-md-2">
            <input type="number" name="bundle_min_credit_score[]" class="form-control" placeholder="Min Credit Score">
        </div>
        <div class="col-md-3">
            <input type="text" name="bundle_description[]" class="form-control" placeholder="Deskripsi">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-danger" onclick="removeItem(this)">X</button>
        </div>
    </div>
    `;
            document.getElementById('bundle-items').insertAdjacentHTML('beforeend', html);
        }


        function removeItem(btn) {
            btn.parentElement.parentElement.remove();
        }
    </script>

@endsection
