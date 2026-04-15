<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appeal;

class PeminjamAppealController extends Controller
{
    public function index()
    {
        $appeals = Appeal::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('peminjam.appeals.index', compact('appeals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required'
        ]);

        Appeal::create([
            'user_id' => auth()->id(),
            'reason' => $request->reason,
            'status' => 'pending',
            'created_at' => now()
        ]);

        return back()->with('success', 'Banding diajukan');
    }
}