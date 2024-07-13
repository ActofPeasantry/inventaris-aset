<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_data = User::all();
        $role_data = Role::all();
        // dd($user_data[0]->roles->pluck('nama_role'));
        return view('backend.user_role.index', compact('user_data', 'role_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->roles);
        $validatedData = $request->validate([
            'nik' => ['required', 'string', 'max:255', Rule::unique('users', 'nik')],
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'nik' => $validatedData['nik'],
            'password' => Hash::make($validatedData['password']),
        ]);

        foreach ($request->roles as $newRole) {
            UserRole::create(['user_id' => $user->id, 'role_id' => $newRole]);
        }

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserRole $userRole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $user_role = UserRole::where('user_id', $id)->get();
        $data = [
            'user' => $user,
            'user_role' => $user_role
        ];
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // dd($request->all());
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'username' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users,email,' . $request->user_id,
        //     'current_password' => 'nullable|required_with:new_password',
        //     'new_password' => 'nullable|min:8|max:12|required_with:current_password',
        //     'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password'
        // ]);


        // $user = User::findOrFail($request->user_id);
        // $user->name = $request->input('name');
        // $user->email = $request->input('email');
        // $user->username = $request->input('username');

        // if (!is_null($request->input('current_password'))) {
        //     if (Hash::check($request->input('current_password'), $user->password)) {
        //         $user->password = $request->input('new_password');
        //     } else {
        //         return redirect()->back()->withInput();
        //     }
        // }

        // $user->save();
        $user->findOrfail($request->user_id)->roles()->sync($request->roles);
        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::findOrfail($id)->delete();
        return redirect()->back()->with('success', 'Data Berhasil dihapus');
    }
}
