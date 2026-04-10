<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;
use App\Models\Category;
use Illuminate\Support\Str;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::orderBy('id', 'desc')->get();
        return view('admin.tools.index', compact('tools'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.tools.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'item_type' => 'required',
            'price' => 'nullable|numeric',
            'min_credit_score' => 'nullable|numeric',
            'photo_path' => 'nullable|image'
        ]);

        $data = $request->all();

        // slug (boleh tetap ada)
        if (!$request->code_slug) {
            $data['code_slug'] = Str::slug($request->name);
        }

        // 🔥 INI YANG PENTING (CODE UNTUK UNIT)
        $data['code'] = strtoupper(str_replace(' ', '-', $request->name));

        // upload photo
        if ($request->hasFile('photo_path')) {
            $file = $request->file('photo_path');
            $path = $file->store('tools', 'public');
            $data['photo_path'] = $path;
        }

        Tool::create($data);

        return redirect()->route('tools.index')
            ->with('success', 'Tools berhasil ditambahkan');

    }

    public function edit($id)
    {
        $tool = Tool::findOrFail($id);
        $categories = Category::all();

        return view('admin.tools.edit', compact('tool', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'item_type' => 'required',
            'price' => 'nullable|numeric',
            'min_credit_score' => 'nullable|numeric',
            'photo_path' => 'nullable|image'
        ]);

        $tool = Tool::findOrFail($id);
        $data = $request->all();

        // slug otomatis kalau kosong saja
        if (!$request->code_slug) {
            $data['code_slug'] = Str::slug($request->name);
        }

        // update photo
        if ($request->hasFile('photo_path')) {
            $file = $request->file('photo_path');
            $path = $file->store('tools', 'public');
            $data['photo_path'] = $path;
        }

        $tool->update($data);

        return redirect()->route('tools.index')
            ->with('success', 'Tools berhasil diupdate');
    }

    public function destroy($id)
    {
        $tool = Tool::findOrFail($id);
        $tool->delete();

        return back()->with('success', 'Tools berhasil dihapus');
    }
}