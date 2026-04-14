<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Tool;
use App\Models\ToolUnit;
use App\Models\ReturnModel;

class LoanController extends Controller
{
    // ================= PEMINJAMAN =================
    public function index()
    {
        $loans = Loan::with('tool')
            ->where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'active'])
            ->whereDoesntHave('return') // ⛔ buang yang sudah return
            ->latest()
            ->get();

        return view('peminjam.peminjaman.index', compact('loans'));
    }

    // ================= CREATE =================
    public function create()
    {
        $tools = Tool::whereIn('item_type', ['single', 'bundle'])->get();

        $usedUnits = Loan::where('status', 'active')->pluck('unit_code');

        $units = ToolUnit::with('tool')
            ->whereNotIn('code', $usedUnits)
            ->get();

        return view('peminjam.peminjaman.create', compact('tools', 'units'));
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'tool_id' => 'required',
            'unit_code' => 'required',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:loan_date',
            'purpose' => 'required'
        ]);

        Loan::create([
            'user_id' => auth()->id(),
            'tool_id' => $request->tool_id,
            'unit_code' => $request->unit_code,
            'status' => 'pending',
            'loan_date' => $request->loan_date,
            'due_date' => $request->due_date,
            'purpose' => $request->purpose,
        ]);

        return redirect()->route('peminjam.peminjaman.index')
            ->with('success', 'Pengajuan berhasil');
    }

    // ================= HISTORY =================
    public function history()
    {
        $loans = Loan::with('tool')
            ->where('user_id', auth()->id())
            ->where(function ($q) {
                $q->whereIn('status', ['rejected', 'closed'])
                  ->orWhereHas('return'); // 🔥 masukin yg sudah return
            })
            ->latest()
            ->get();

        return view('peminjam.peminjaman.history', compact('loans'));
    }

    // ================= PENGEMBALIAN =================
    public function pengembalian()
    {
        $loans = Loan::with(['tool', 'return'])
            ->where('user_id', auth()->id())
            ->where('status', 'active')
            ->whereDoesntHave('return') // ⛔ jangan tampil yg sudah diajukan
            ->get();

        return view('peminjam.pengembalian.index', compact('loans'));
    }

    // ================= AJUKAN RETURN =================
    public function requestReturn(Request $request, $id)
    {
        $request->validate([
            'proof' => 'required|image|max:2048'
        ]);

        $loan = Loan::where('user_id', auth()->id())
            ->where('status', 'active')
            ->findOrFail($id);

        if ($loan->return) {
            return back()->with('error', 'Sudah diajukan sebelumnya');
        }

        // upload gambar
        $path = $request->file('proof')->store('returns', 'public');

        // simpan return
        $return = ReturnModel::create([
            'loan_id' => $loan->id,
            'return_date' => now(),
            'proof' => $path,
            'notes' => 'Diajukan oleh peminjam'
        ]);

        return back()->with('success', 'Pengembalian diajukan');
    }
}
