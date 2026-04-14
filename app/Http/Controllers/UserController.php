<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', auth()->user()->role)->get();
        
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,staff',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt('temp_password'),
        ]);

        $autoPassword = substr($request->email, 0, 4) . $user->id;
        $user->update(['password' => bcrypt($autoPassword)]);

        return redirect()->route('users.index')->with('success', "Akun berhasil dibuat. Password otomatis: $autoPassword");
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,staff',
            'new_password' => 'nullable|string|min:4',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('new_password')) {
            $user->password = bcrypt($request->new_password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Akun berhasil diperbarui.');
    }

    public function resetPassword(User $user)
    {
        $autoPassword = substr($user->email, 0, 4) . $user->id;
        $user->update(['password' => bcrypt($autoPassword)]);

        return redirect()->route('users.index')->with('success', "Password akun {$user->name} berhasil di-reset menjadi: $autoPassword");
    }

    public function destroy(User $user)
    {
        if (auth()->user()->role == 'staff' && $user->role == 'admin') {
            return redirect()->route('users.index')->with('error', 'Staff tidak dapat menghapus akun Admin!');
        }

        if (auth()->id() == $user->id) {
            return redirect()->route('users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Akun berhasil dihapus.');
    }


public function export()
{
    $filename = "users_export_" . date('Y_m_d_H_i_s') . ".xlsx";
    return Excel::download(new UserExport, $filename);
}
}
