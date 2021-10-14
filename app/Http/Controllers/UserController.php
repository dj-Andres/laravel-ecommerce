<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
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
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        try {
            $user = User::create($request->all());
            $user->update(['password'=> Hash::make($request->password)]);
            $user->roles()->sync($request->roles);
            return response()->json(['status' => 'ok', 'code'=>200, 'message'=>'Usuario fue creado correctamente.','data' => $user],200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'code'=>400, 'message'=>$e->getMessage()]);
        }
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
        $user->roles()->sync($request->roles);
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }
}
