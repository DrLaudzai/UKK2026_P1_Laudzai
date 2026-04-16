<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Violation;
use App\Models\Settlement;

class SettlementController extends Controller
{

    public function index()
    {
        $violations = \App\Models\Violation::with(['user', 'loan', 'settlement'])
            ->latest()
            ->get();

        return view('petugas.settlements.index', compact('violations'));
    }
    public function store(Request $request, $id)
    {
        $request->validate([
            'description' => 'required'
        ]);

        $violation = Violation::findOrFail($id);


        if ($violation->status == 'settled') {
            return back()->with('error', 'Pelanggaran sudah diselesaikan');
        }

        // ================== SIMPAN ==================
        Settlement::create([
            'violation_id' => $violation->id,
            'employee_id' => auth()->id(),
            'description' => $request->description,
            'settled_at' => now()
        ]);

        // ================== UPDATE VIOLATION ==================
        $violation->update([
            'status' => 'settled'
        ]);

        // ================== UNBLOCK USER ==================
        $user = $violation->user;
        if ($user) {
            $user->is_restricted = 0;
            $user->save();
        }

        return back()->with('success', 'Pelanggaran berhasil diselesaikan');
    }
}