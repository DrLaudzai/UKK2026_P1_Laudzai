<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;
use App\Models\User;
use App\Models\ActivityLog;
use App\Models\ToolUnit;
use App\Models\Loan;
use App\Models\ReturnModel;

class DashboardController extends Controller
{
    public function index()
    {
        $role = strtolower(auth()->user()->role);

        return match ($role) {
            'admin' => $this->adminDashboard(),
            'petugas' => $this->petugasDashboard(),
            'peminjam' => $this->peminjamDashboard(),
            default => abort(403),
        };
    }

    // ================= ADMIN =================
    private function adminDashboard()
    {
        return view('admin.dashboard', [
            'totalTools' => Tool::where('item_type', 'single')->count(),
            'totalBundle' => Tool::where('item_type', 'bundle')->count(),
            'totalUnit' => ToolUnit::count(),
            'totalUser' => User::count(),
            'totalLog' => ActivityLog::count(),
        ]);
    }

    // ================= PEMINJAM =================
    private function peminjamDashboard()
    {
        $userId = auth()->id();

        $totalPinjam = Loan::where('user_id', $userId)->count();

        $dipinjam = Loan::where('user_id', $userId)
            ->where('status', 'active')
            ->count();

        $dikembalikan = Loan::where('user_id', $userId)
            ->where('status', 'closed')
            ->count();

        $terlambat = Loan::where('user_id', $userId)
            ->where('status', 'active')
            ->whereDate('due_date', '<', now())
            ->count();

        $activeLoans = Loan::with('tool')
            ->where('user_id', $userId)
            ->where('status', 'active')
            ->latest()
            ->get();

        return view('peminjam.dashboard', compact(
            'totalPinjam',
            'dipinjam',
            'dikembalikan',
            'terlambat',
            'activeLoans'
        ));
    }

    private function petugasDashboard()
    {
        return view('petugas.dashboard', [
            'pending' => Loan::where('status', 'pending')->count(),

            'active' => Loan::where('status', 'active')
                ->whereDoesntHave('return')
                ->count(),

            'menungguReturn' => Loan::where('status', 'active')
                ->whereDoesntHave('return')
                ->count(),

            'returned' => ReturnModel::count(),
        ]);
    }
}