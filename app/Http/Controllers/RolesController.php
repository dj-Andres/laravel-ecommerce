<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:roles.index')->only(['index']);
        $this->middleware('can:roles.create')->only(['create','store']);
        $this->middleware('can:roles.edit')->only(['edit','update']);
        $this->middleware('can:roles.destroy')->only(['destroy']);
    }

    public function index()
    {
        $rols = Role::all();
        return view('admin.role.index', compact('rols'));
    }
    public function create()
    {
        $permissions = Permission::all()->pluck('name','id');
        return view('admin.role.create', compact('permissions'));
    }
    public function store(Request $request)
    {
        try {
            $role = Role::create($request->all());
            $role->permissions()->sync($request->input('permisions',[]));
            return response()->json(['status' => 'ok', 'code'=>200, 'message'=>'El Rol se Guardo exitosamente','data' => $role],200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'code'=>400, 'message'=>$e->getMessage()]);
        }
    }
    public function show(Role $role)
    {
        $permissions = Permission::all()->pluck('name','id');
        $role->load('permissions');
        return view('admin.role.show', compact('role','permissions'));
    }
    public function edit(Role $role)
    {
        $permissions = Permission::all()->pluck('name','id');
        $role->load('permissions');
        return view('admin.role.edit', compact('role', 'permissions'));
    }
    public function update(Request $request, Role $role)
    {
        $role->update($request->all());
        $role->permissions()->sync($request->input('permisions',[]));
        return redirect()->route('roles.index');
    }
    public function destroy(Role $role)
    {
        $role->delete();
        return back();
    }
}
