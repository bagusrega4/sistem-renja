<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;

class ManageUserController extends Controller
{
    public function index()
    {
        // Ambil semua data user
        $users = User::all();

        // Kirim data ke view 'manage.user.index'
        return view('manage.user.index', compact('users'));
    }

    //Controller User
    // public function user()
    // {
    //     $users = User::all();
    //     return view('manage.user.index', [
    //         'users' => $users
    //     ]);
    // }

    public function create()
    {
        return view('manage.user.create');
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nip_lama' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'email'    => 'required|string|max:255',
            'role'     => 'required|string|max:255',
        ]);

        // Menambahkan data user baru ke database
        User::create([
            'nip_lama' => $request->nip_lama,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => $request->password,
            'role'     => $request->role,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('manage.user.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function updateRoleUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'Role Users berhasil diperbarui.');
    }
}
