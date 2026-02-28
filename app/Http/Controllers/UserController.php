<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $account = User::orderByRaw(
            "FIELD(role, 'Super Admin', 'Admin')",
        )->get();
        return view("admin-account.index", compact("account"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin-account.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:tuser,email',
            'password' => 'required|min:8',
            'role'     => 'required|in:Super Admin,Admin',
        ], [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password harus diisi.',
            'email.unique' => 'Email ini sudah terdaftar!',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        $account = new User();
        $account->name = $request->name;
        $account->email = $request->email;
        $account->password = Hash::make($request->password);
        $account->role = $request->role;
        $account->save();

        return redirect()
            ->route("admin-account.index")
            ->with("SA-success", "Data Admin berhasil disimpan!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::find($id);
        return view("admin-account.edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $account = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:tuser,email,' . $id,
            'password' => 'nullable|min:6', 
            'role'     => 'required|in:Super Admin,Admin',
        ], [
            'name.required'     => 'Nama harus diisi.',
            'email.required'    => 'Email harus diisi.',
            'email.email'       => 'Format email tidak valid.',
            'email.unique'      => 'Email ini sudah terdaftar oleh pengguna lain!',
            'password.min'      => 'Password baru minimal 6 karakter.',
        ]);

        $account->name = $request->name;
        $account->email = $request->email;
        $account->role = $request->role;

        if ($request->filled('password')) {
            $account->password = Hash::make($request->password);
        }

        $account->save();

        return redirect()
            ->route("admin-account.index")
            ->with("SA-success", "Data Admin berhasil diperbarui!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $account = User::find($id);
        $account->delete();
        return redirect()
            ->route("admin-account.index")
            ->with("SA-success", "Data berhasil dihapus.");
    }
}
