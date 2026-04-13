<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToolUnit;
use App\Models\Tool;

class ToolUnitController extends Controller
{
    public function index()
    {
        $unitTools = ToolUnit::with('tool')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.tool_units.index', compact('unitTools'));
    }

    public function create()
    {
        $tools = Tool::all();
        return view('admin.tool_units.create', compact('tools'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tool_id' => 'required|exists:tools,id',
            'notes' => 'nullable|string'
        ]);

        $tool = Tool::findOrFail($request->tool_id);

        if (!$tool->code_slug) {
            dd('ERROR: code_slug kosong!');
        }

        $prefix = strtoupper($tool->code_slug);

        $lastUnit = ToolUnit::where('code', 'like', $prefix . '-%')
            ->orderByDesc('code')
            ->first();

        if ($lastUnit) {
            $lastNumber = (int) substr($lastUnit->code, -3);
            $count = $lastNumber + 1;
        } else {
            $count = 1;
        }

        $code = $prefix . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);

        // HAPUS INI KALAU SUDAH TEST
// dd($code);

        ToolUnit::create([
            'code' => $code,
            'tool_id' => $tool->id,
            'status' => $request->status,
            'notes' => $request->notes
        ]);

        return redirect()->route('tool-units.index')
            ->with('success', 'Unit berhasil dibuat');
    }

    // 🔥 pakai MODEL BINDING (code otomatis)
    public function edit(ToolUnit $tool_unit)
    {
        $tools = Tool::all();

        return view('admin.tool_units.edit', [
            'unit' => $tool_unit,
            'tools' => $tools
        ]);
    }

    public function update(Request $request, ToolUnit $tool_unit)
    {
        $request->validate([
            'tool_id' => 'required|exists:tools,id',
            'status' => 'required|in:available,nonactive,lent',
            'notes' => 'nullable|string'
        ]);

        $tool_unit->update([
            'tool_id' => $request->tool_id,
            'status' => $request->status,
            'notes' => $request->notes
        ]);

        return redirect()->route('tool-units.index')
            ->with('success', 'Unit berhasil diupdate');
    }

    public function destroy(ToolUnit $tool_unit)
    {
        try {
            $tool_unit->delete();

            return back()->with('success', 'Data berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with('error', 'Data tidak bisa dihapus karena masih digunakan!');
        }
    }
}