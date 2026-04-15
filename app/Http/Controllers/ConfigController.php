<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppConfig;

class ConfigController extends Controller
{
    public function index()
    {
        $config = AppConfig::first();

        return view('admin.config.index', compact('config'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',

            'late_point' => 'required|numeric|min:0',
            'broken_point' => 'required|numeric|min:0',
            'lost_point' => 'required|numeric|min:0',

            'late_fine' => 'required|numeric|min:0|max:100',
            'broken_fine' => 'required|numeric|min:0|max:100',
            'lost_fine' => 'required|numeric|min:0|max:100',
        ]);

        $config = AppConfig::first();

        $data = [
            'name' => $request->name,
            'late_point' => $request->late_point,
            'broken_point' => $request->broken_point,
            'lost_point' => $request->lost_point,
            'late_fine' => $request->late_fine,
            'broken_fine' => $request->broken_fine,
            'lost_fine' => $request->lost_fine,
            'updated_at' => now()
        ];

        if (!$config) {
            AppConfig::create($data);
        } else {
            $config->update($data);
        }

        return back()->with('success', 'Konfigurasi berhasil disimpan');
    }
}