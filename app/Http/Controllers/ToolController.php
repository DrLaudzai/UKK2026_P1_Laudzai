<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::whereIn('item_type', ['single', 'bundle'])
            ->orderBy('id', 'desc')
            ->get();

        $bundleItems = DB::table('bundle_tools')
            ->join('tools', 'bundle_tools.tool_id', '=', 'tools.id')
            ->select('bundle_tools.*', 'tools.name')
            ->get()
            ->groupBy('bundle_id');

        return view('admin.tools.index', compact('tools', 'bundleItems'));
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
        ]);

        DB::beginTransaction();

        try {
            $data = $request->all();
            $data['code_slug'] = $request->code_slug
                ? $request->code_slug
                : Str::slug($request->name);

            if ($request->hasFile('photo_path')) {
                $path = $request->file('photo_path')->store('tools', 'public');
                $data['photo_path'] = $path;
            }

            $tool = Tool::create($data);

            if ($request->item_type === 'bundle' && $request->bundle_name) {
                foreach ($request->bundle_name as $index => $name) {
                    $subTool = Tool::create([
                        'name' => $name,
                        'category_id' => $tool->category_id,
                        'item_type' => 'bundle_tool',
                        'code_slug' => Str::slug($name),
                        'photo_path' => $tool->photo_path,
                        'price' => $request->bundle_price[$index] ?? 0,
                        'description' => $request->bundle_description[$index] ?? null,
                    ]);

                    DB::table('bundle_tools')->insert([
                        'bundle_id' => $tool->id,
                        'tool_id' => $subTool->id,
                        'qty' => $request->bundle_qty[$index],
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('tools.index')
                ->with('success', 'Tools berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $tool = Tool::findOrFail($id);
        $categories = Category::all();

        // ambil bundle items
        $bundleItems = DB::table('bundle_tools')
            ->join('tools', 'bundle_tools.tool_id', '=', 'tools.id')
            ->select('bundle_tools.*', 'tools.name')
            ->where('bundle_id', $tool->id)
            ->get();

        return view('admin.tools.edit', compact('tool', 'categories', 'bundleItems'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $tool = Tool::findOrFail($id);
            $data = $request->all();

            $data['code_slug'] = $request->code_slug
                ? $request->code_slug
                : Str::slug($request->name);

            if ($request->hasFile('photo_path')) {
                $path = $request->file('photo_path')->store('tools', 'public');
                $data['photo_path'] = $path;
            }

            $tool->update($data);

            $oldItems = DB::table('bundle_tools')
                ->where('bundle_id', $tool->id)
                ->pluck('tool_id');

            Tool::whereIn('id', $oldItems)->delete();
            DB::table('bundle_tools')->where('bundle_id', $tool->id)->delete();

            if ($request->item_type === 'bundle' && $request->bundle_name) {
                foreach ($request->bundle_name as $index => $name) {
                    $subTool = Tool::create([
                        'name' => $name,
                        'category_id' => $tool->category_id,
                        'item_type' => 'bundle_tool',
                        'code_slug' => Str::slug($name),
                        'photo_path' => $tool->photo_path,
                        'price' => $request->bundle_price[$index] ?? 0,
                        'description' => $request->bundle_description[$index] ?? null,
                    ]);

                    DB::table('bundle_tools')->insert([
                        'bundle_id' => $tool->id,
                        'tool_id' => $subTool->id,
                        'qty' => $request->bundle_qty[$index],
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('tools.index')
                ->with('success', 'Tools berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $tool = Tool::findOrFail($id);

        if ($tool->units()->exists()) {
            return back()->with('error', 'Tool tidak bisa dihapus karena masih memiliki unit!');
        }

        $usedInBundle = DB::table('bundle_tools')
            ->where('tool_id', $tool->id)
            ->exists();

        if ($usedInBundle) {
            return back()->with('error', 'Tool tidak bisa dihapus karena digunakan dalam bundle!');
        }

        $subItems = DB::table('bundle_tools')
            ->where('bundle_id', $tool->id)
            ->pluck('tool_id');

        DB::table('bundle_tools')->where('bundle_id', $tool->id)->delete();
        Tool::whereIn('id', $subItems)->delete();

        $tool->delete();

        return back()->with('success', 'Tools berhasil dihapus');
    }

    public function show($id)
    {
        $tool = Tool::findOrFail($id);

        $bundleItems = DB::table('bundle_tools')
            ->join('tools', 'bundle_tools.tool_id', '=', 'tools.id')
            ->select('bundle_tools.*', 'tools.name')
            ->where('bundle_tools.bundle_id', $tool->id)
            ->get();

        return view('admin.tools.show', compact('tool', 'bundleItems'));
    }
}
