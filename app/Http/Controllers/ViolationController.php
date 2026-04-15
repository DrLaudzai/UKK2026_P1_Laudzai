<?php

namespace App\Http\Controllers;

use App\Models\Violation;
use App\Models\Loan;
use App\Models\AppConfig;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViolationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $loanId)
    {
        $request->validate([
            'type' => 'required|in:late,damaged,lost',
            'description' => 'required'
        ]);

        $loan = Loan::findOrFail($loanId);

        // ambil config
        $config = AppConfig::first();

        $price = $loan->tool->price;

        if ($request->type == 'late') {
            $score = $config->late_point;
            $fine = ($config->late_fine / 100) * $price;
        } elseif ($request->type == 'damaged') {
            $score = $config->broken_point;
            $fine = ($config->broken_fine / 100) * $price;
        } elseif ($request->type == 'lost') {
            $score = $config->lost_point;
            $fine = ($config->lost_fine / 100) * $price;
        }

        // simpan violation
        Violation::create([
            'loan_id' => $loan->id,
            'user_id' => $loan->user_id,
            'return_id' => $loan->return->id ?? null,
            'type' => $request->type,
            'total_score' => $score,
            'fine' => $fine,
            'description' => $request->description,
            'status' => 'active',
            'created_at' => now()
        ]);

        // update score user
        $user = $loan->user;
        $user->credit_score += $score;
        $user->save();

        return back()->with('success', 'Pelanggaran berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Violation $violation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Violation $violation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Violation $violation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Violation $violation)
    {
        //
    }
}
