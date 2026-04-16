<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Violation;
use App\Models\AppConfig;

use App\Models\UnitCondition;

class PetugasLoanController extends Controller
{
    // ================= LIST =================
    public function index()
    {
        $loans = Loan::with(['tool', 'user.detail', 'return'])
            ->whereIn('status', ['pending', 'active']) 
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
    public function confirmReturn(Request $request, $id)
    {
        $request->validate([
            'return_condition' => 'required|in:safe,problem',
            'notes' => 'nullable',
            'violation_type' => 'nullable|in:late,damaged,lost',
            'violation_description' => 'nullable'
        ]);

        $loan = Loan::where('status', 'active')->findOrFail($id);

        if (!$loan->return) {
            return back()->with('error', 'Belum ada pengajuan return');
        }

        if ($loan->return->employee_id) {
            return back()->with('error', 'Sudah dikonfirmasi');
        }

        // ================== TENTUKAN KONDISI ==================
        $conditionValue = 'good';

        if ($request->return_condition == 'problem') {
            $conditionValue = 'broken'; // default kalau bermasalah
        }

        // ================== UNIT CONDITION ==================
        $condition = UnitCondition::create([
            'id' => uniqid(),
            'unit_code' => $loan->unit_code,
            'conditions' => $conditionValue,
            'notes' => 'Dari petugas',
            'recorded_at' => now(),
            'return_id' => null
        ]);

        // ================== UPDATE RETURN ==================
        $loan->return->update([
            'employee_id' => auth()->id(),
            'condition_id' => $condition->id,
            'notes' => $request->notes ?? 'Dikonfirmasi petugas'
        ]);

        // update balik relasi
        $condition->update([
            'return_id' => $loan->return->id
        ]);

        // ================== VIOLATION ==================
        if ($request->return_condition == 'problem') {

            $config = AppConfig::first();
            $type = $request->violation_type ?? 'damaged';

            $price = $loan->tool->price ?? 0;

            if ($type == 'late') {
                $score = $config->late_point;
                $fine = ($config->late_fine / 100) * $price;

            } elseif ($type == 'damaged') {
                $score = $config->broken_point;
                $fine = ($config->broken_fine / 100) * $price;

            } elseif ($type == 'lost') {
                $score = $config->lost_point;
                $fine = $price; 
            }

            $fine = round($fine);

            Violation::create([
                'loan_id' => $loan->id,
                'user_id' => $loan->user_id,
                'return_id' => $loan->return->id,
                'type' => $type,
                'total_score' => $score,
                'fine' => $fine,
                'description' => $request->violation_description ?? 'Pelanggaran saat pengembalian',
                'status' => 'active',
                'created_at' => now()
            ]);

            // ================== UPDATE SCORE USER ==================
            $user = $loan->user;
            $user->credit_score = max(0, $user->credit_score - $score);
            $user->save();
        }

        // ================== TUTUP LOAN ==================
        $loan->update([
            'status' => 'closed'
        ]);

        return back()->with('success', 'Pengembalian berhasil diproses');
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
