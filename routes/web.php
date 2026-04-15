<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\ToolUnitController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\PetugasLoanController;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\SettlementController;
use App\Http\Controllers\PeminjamAppealController;
use App\Http\Controllers\AdminAppealController;


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return redirect('/dashboard');
    }

    return back()->with('error', 'Login gagal');
});

Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN (CRUD)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tools', ToolController::class);
    Route::resource('tool-units', ToolUnitController::class);

    Route::get('/logs', [ActivityLogController::class, 'index'])->name('logs.index');
});

/*
|--------------------------------------------------------------------------
| PEMINJAM
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('peminjam')->name('peminjam.')->group(function () {

    // 🔹 DAFTAR ALAT (VIEW ONLY)
    Route::get('/tools', [ToolController::class, 'index'])->name('tools.index');

    // 🔹 PEMINJAMAN
    Route::get('/peminjaman', [LoanController::class, 'index'])->name('peminjaman.index');

    Route::get('/peminjaman/create', [LoanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [LoanController::class, 'store'])->name('peminjaman.store');

    // 🔹 RIWAYAT
    Route::get('/riwayat', [LoanController::class, 'history'])->name('history.index');

    // 🔹 PENGEMBALIAN
    Route::get('/pengembalian', [LoanController::class, 'pengembalian'])->name('pengembalian.index');

    Route::post('/pengembalian/{id}', [LoanController::class, 'requestReturn'])
        ->name('pengembalian.request');


});
/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {


        Route::get('/peminjaman', [PetugasLoanController::class, 'index'])
            ->name('peminjaman.index');

        Route::post('/peminjaman/{id}/approve', [PetugasLoanController::class, 'approve'])
            ->name('peminjaman.approve');

        Route::post('/peminjaman/{id}/reject', [PetugasLoanController::class, 'reject'])
            ->name('peminjaman.reject');

        Route::post('/peminjaman/{id}/confirm-return', [PetugasLoanController::class, 'confirmReturn'])
            ->name('peminjaman.confirmReturn');

        Route::get('/peminjaman/history', [PetugasLoanController::class, 'history'])
            ->name('peminjaman.history');


    });

Route::post('/violation/{loan}', [ViolationController::class, 'store'])
    ->name('petugas.violation.store');

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/config', [ConfigController::class, 'index'])
        ->name('config.index');

    Route::post('/admin/config', [ConfigController::class, 'update'])
        ->name('config.update');

    Route::get('/petugas/settlements', [SettlementController::class, 'index'])
        ->name('settlements.index');

    Route::post('/petugas/settlements/{id}', [SettlementController::class, 'store'])
        ->name('settlements.store');

    // PEMINJAM
    Route::prefix('peminjam')->middleware(['auth'])->group(function () {
        Route::get('appeals', [PeminjamAppealController::class, 'index'])->name('peminjam.appeals.index');
        Route::post('appeals', [PeminjamAppealController::class, 'store'])->name('peminjam.appeals.store');
    });

    // ADMIN
    Route::prefix('admin')->middleware(['auth'])->group(function () {
        Route::get('appeals', [AdminAppealController::class, 'index'])->name('admin.appeals.index');
        Route::post('appeals/{id}/approve', [AdminAppealController::class, 'approve'])->name('admin.appeals.approve');
        Route::post('appeals/{id}/reject', [AdminAppealController::class, 'reject'])->name('admin.appeals.reject');
    });

});