<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appeal;
use App\Models\User;

class AdminAppealController extends Controller
{
    public function index()
    {
        $appeals = Appeal::with('user.detail')->latest()->get();

        return view('admin.appeals.index', compact('appeals'));
    }


    public function approve(Request $request, $id)
    {
        $request->validate([
            'credit_changed' => 'required|numeric|min:1|max:100'
        ]);

        $appeal = Appeal::with('user')->findOrFail($id);

        if ($appeal->status !== 'pending') {
            return back()->with('error', 'Sudah diproses');
        }

        if (!$appeal->user) {
            return back()->with('error', 'User tidak ditemukan');
        }

        $user = $appeal->user;


        $credit = $request->credit_changed;

        $user->credit_score = min(100, $user->credit_score + $credit);
        $user->save();

        $appeal->update([
            'status' => 'approved',
            'credit_changed' => $credit,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
            'admin_notes' => 'Banding diterima'
        ]);

        return back()->with('success', 'Appeal disetujui & credit dikembalikan');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'admin_notes' => 'required'
        ]);

        $appeal = Appeal::findOrFail($id);

        $appeal->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now()
        ]);

        return back()->with('success', 'Banding ditolak');
    }
}