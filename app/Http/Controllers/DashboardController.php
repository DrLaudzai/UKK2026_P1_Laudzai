<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tool;
use App\Models\User;
use App\Models\ActivityLog;
use App\Models\ToolUnit;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalTools' => Tool::where('item_type', 'single')->count(),
            'totalBundle' => Tool::where('item_type', 'bundle')->count(),
            'totalUnit' => ToolUnit::count(),
            'totalUser' => User::count(),
            'totalLog' => ActivityLog::count(),
        ]);
    }
}
