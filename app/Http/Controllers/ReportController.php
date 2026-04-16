<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Violation;
use App\Models\Settlement;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    // ================= HALAMAN PILIH LAPORAN =================
    public function index()
    {
        return view('petugas.reports.index');
    }

    // ================= PRINT / EXPORT =================
    public function print(Request $request)
    {
        $request->validate([
            'type' => 'required|in:loan,violation,settlement'
        ]);

        $type = $request->type;
        $from = $request->from;
        $to = $request->to;

        // ================= QUERY + FIELD TANGGAL =================
        if ($type == 'loan') {
            $query = Loan::with('user.detail', 'tool');
            $dateField = 'created_at';

        } elseif ($type == 'violation') {
            $query = Violation::with('user.detail', 'loan.tool');
            $dateField = 'created_at';

        } elseif ($type == 'settlement') {
            $query = Settlement::with(
                'violation.user.detail',
                'violation.loan.tool' // 
            );
            $dateField = 'settled_at';
        }

        // ================= FILTER TANGGAL =================
        if ($from && $to) {
            $query->whereBetween($dateField, [$from, $to]);
        }

        // ================= AMBIL DATA =================
        $data = $query->orderBy($dateField, 'desc')->get();

        // ================= TOTAL DENDA =================
        $totalFine = 0;

        if ($type == 'violation') {
            $totalFine = $data->sum('fine');
        }

        if ($type == 'settlement') {
            $totalFine = $data->sum(function ($s) {
                return $s->violation->fine ?? 0;
            });
        }
        

        // ================= EXPORT PDF =================
        if ($request->export == 'pdf') {
            $pdf = Pdf::loadView(
                "petugas.reports.print.$type",
                compact('data', 'totalFine', 'from', 'to')
            );

            return $pdf->download("laporan-$type.pdf");
        }

        // ================= PRINT BIASA =================
        return view(
            "petugas.reports.print.$type",
            compact('data', 'totalFine', 'from', 'to')
        );
    }
}