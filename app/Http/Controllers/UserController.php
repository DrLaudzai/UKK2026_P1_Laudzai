<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('detail')->get(); // biar relasi kebaca
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,petugas,peminjam',

            'nik' => 'required|unique:user_details,nik',
            'name' => 'required',
            'no_hp' => 'required',
            'address' => 'required',
            'birth_date' => 'required|date',
        ]);
        DB::beginTransaction();

        try {
            // 1. users
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'credit_score' => 100,  
                'is_restricted' => 0
            ]);

            // 2. user_details
            $user->detail()->create([
                'nik' => $request->nik,
                'name' => $request->name,
                'no_hp' => $request->no_hp,
                'address' => $request->address,
                'birth_date' => $request->birth_date,
            ]);

            DB::commit();

            return redirect()->route('users.index')
                ->with('success', 'User berhasil ditambahkan');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        $user = User::with('detail')->findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:Admin,Petugas,Peminjam',

            // detail
            'nik' => 'required',
            'name' => 'required',
            'no_hp' => 'required',
            'address' => 'required',
            'birth_date' => 'required|date',
        ]);

        DB::beginTransaction();

        try {
            // 1. update users
            $user->update([
                'email' => $request->email,
                'role' => $request->role
            ]);

            // 2. update / create detail
            $user->detail()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nik' => $request->nik,
                    'name' => $request->name,
                    'no_hp' => $request->no_hp,
                    'address' => $request->address,
                    'birth_date' => $request->birth_date,
                ]
            );

            DB::commit();

            return redirect()->route('users.index')
                ->with('success', 'User berhasil diupdate');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // 1. Cek relasi (kecuali detail)
        $hasRelations = DB::table('loans')->where('user_id', $id)->orWhere('employee_id', $id)->exists() ||
                        DB::table('returns')->where('employee_id', $id)->exists() ||
                        DB::table('violations')->where('user_id', $id)->exists() ||
                        DB::table('settlements')->where('employee_id', $id)->exists() ||
                        DB::table('appeals')->where('user_id', $id)->orWhere('reviewed_by', $id)->exists() ||
                        DB::table('activity_logs')->where('user_id', $id)->exists();

        if ($hasRelations) {
            return redirect('/users')->with('error', 'User tidak dapat dihapus karena masih memiliki relasi dengan data lain');
        }

        DB::beginTransaction();

        try {
            // 2. Jika tidak ada, hapus relasi ke detail dulu
            $user->detail()->delete();

            // 3. Sesudah nya baru hapus user
            $user->delete();

            DB::commit();

            return redirect('/users')->with('success', 'User dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/users')->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }
    
}
