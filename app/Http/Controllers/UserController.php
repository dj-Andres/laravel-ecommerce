<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:users.index')->only(['index']);
        $this->middleware('can:users.create')->only(['create','store']);
        $this->middleware('can:users.edit')->only(['edit','update']);
        $this->middleware('can:users.destroy')->only(['destroy']);
    }

    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    public function create()
    {
        $rols = Role::get();
        return view('admin.users.create', compact('rols'));
    }
    public function store(Request $request)
    {
        $user = User::create($request->all());
        $user->update(['password'=> Hash::make($request->password)]);
        $user->roles()->sync($request->get('roles'));

        return redirect()->route('users.index');
    }
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $rols = Role::get();
        return view('admin.users.edit', compact('user', 'rols'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        $user->update(['password'=> Hash::make($request->password)]);
        $user->roles()->sync($request->get('roles'));
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }
}
