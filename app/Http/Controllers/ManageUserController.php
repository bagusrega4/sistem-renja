<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageUserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        $roles = Role::all();
        return view('manage.user.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('manage.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip_lama' => 'required|string|max:255|unique:users,nip_lama',
            'nip_baru' => 'required|string|max:255|unique:pegawai,nip_baru',
            'jabatan' => 'required',
            'golongan' => 'required',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'id_role' => 'required|exists:role,id',
        ]);

        Pegawai::create([
            'nama' => $request->nama,
            'nip_lama' => $request->nip_lama,
            'nip_baru' => $request->nip_baru,
            'jabatan' => $request->jabatan,
            'kode_wilayah' => "3100",
            'nama_wilayah' => "BPS Provinsi DKI Jakarta",
            'golongan' => $request->golongan
        ]);

        User::create([
            'nip_lama' => $request->nip_lama,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'id_role'  => $request->id_role,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('manage.user.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('manage.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $rules = [
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email'    => 'required|string|email|max:255|unique:users,email,' . $id,
            'id_role'  => 'required|exists:role,id',
        ];

        // Jika password diisi, tambahkan validasi password
        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:6';
        }

        $request->validate($rules);

        // Update data
        $userData = [
            'username' => $request->username,
            'email'    => $request->email,
            'id_role'  => $request->id_role,
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return redirect()->route('manage.user.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function updateRoleUser(Request $request, $id)
    {
        $request->validate([
            'id_role' => 'required|exists:role,id',
        ]);

        $user = User::findOrFail($id);
        $user->id_role = $request->id_role;
        $user->save();

        return redirect()->back()->with('success', 'Role Users berhasil diperbarui.');
    }
}
