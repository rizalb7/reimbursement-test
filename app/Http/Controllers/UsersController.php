<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::role(['staff','finance'])->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::whereNot('name', 'direktur')->get();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|integer|unique:users',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'jabatan' => 'required',
            'password' => 'required',
        ]);
        User::create([
            'nip' => $request->nip,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ])->assignRole($request->jabatan);
        return redirect('users');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nip' => ['integer', Rule::unique(User::class)->ignore($user->id)],
            'name' => 'required',
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);
        $data = [
            'nip' => $request->nip,
            'name' => $request->name,
            'email' => $request->email,
        ];
        if($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('users');
    }
}
