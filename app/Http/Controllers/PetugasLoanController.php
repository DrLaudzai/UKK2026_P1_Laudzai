<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;

class PetugasLoanController extends Controller
{
    // ================= LIST =================
    public function index()
    {
        $loans = Loan::with(['tool', 'user.detail', 'return'])
            ->whereIn('status', ['pending', 'active']) // ❗ cukup ini
            ->latest()
            ->get();

        return view('petugas.peminjaman.index', compact('loans'));
    }



    // ================= APPROVE =================
    public function approve(Request $request, $id)
    {
        $loan = Loan::where('status', 'pending')->findOrFail($id);

        $loan->update([
            'status' => 'active',
            'employee_id' => auth()->id(),
            'notes' => $request->notes
        ]);

        return back()->with('success', 'Disetujui');
    }

    // ================= REJECT =================
    public function reject(Request $request, $id)
    {
        $request->validate([
            'notes' => 'required'
        ]);

        $loan = Loan::where('status', 'pending')->findOrFail($id);

        $loan->update([
            'status' => 'rejected',
            'employee_id' => auth()->id(),
            'notes' => $request->notes
        ]);

        return back()->with('success', 'Ditolak');
    }

    // ================= KONFIRMASI RETURN =================
    public function confirmReturn($id)
    {
        $loan = Loan::where('status', 'active')->findOrFail($id);

        if (!$loan->return) {
            return back()->with('error', 'Belum ada pengajuan return');
        }

        if ($loan->return->employee_id) {
            return back()->with('error', 'Sudah dikonfirmasi');
        }

        $loan->return->update([
            'employee_id' => auth()->id(),
            'notes' => 'Dikonfirmasi petugas'
        ]);

        $loan->update([
            'status' => 'closed'
        ]);

        return back()->with('success', 'Return dikonfirmasi');
    }

    public function returnRequests()
    {
        $loans = Loan::with(['tool', 'user.detail', 'return'])
            ->where('status', 'active')
            ->whereHas('return')
            ->latest()
            ->get();

        return view('petugas.peminjaman.return', compact('loans'));
    }


    // ================= HISTORY =================
    public function history()
    {
        $loans = Loan::with(['tool', 'user.detail', 'return'])
            ->where(function ($q) {
                $q->whereIn('status', ['rejected', 'closed']);
            })
            ->latest()
            ->get();

        return view('petugas.peminjaman.history', compact('loans'));
    }

}
