<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id','desc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        // VALIDASI (tidak boleh duplikat)
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        // OPTIONAL: rapihin format
        $data = $request->all();
        $data['name'] = ucfirst(strtolower($data['name']));

        Category::create($data);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // VALIDASI (tidak boleh sama dengan yang lain, tapi boleh sama dengan dirinya sendiri)
        $request->validate([
            'name' => [
                'required',
                Rule::unique('categories', 'name')->ignore($id),
            ],
        ]);

        $category = Category::findOrFail($id);

        // OPTIONAL: rapihin format
        $data = $request->all();
        $data['name'] = ucfirst(strtolower($data['name']));

        $category->update($data);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return back()->with('success', 'Kategori berhasil dihapus');
    }
}