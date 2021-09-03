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
        $permisions = Permission::get();
        return view('admin.role.create', compact('permisions'));
    }
    public function store(Request $request)
    {
        $role = Role::create($request->all());
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index');
    }
    public function show(Role $rols)
    {
        return view('admin.role.show', compact('rols'));
    }
    public function edit(Role $role)
    {
        $permisions = Permission::get();
        return view('admin.role.edit', compact('role', 'permisions'));
    }
    public function update(Request $request, Role $rols)
    {
        $rols->update($request->all());
        $rols->syncPermissions($request->permissions);
        return redirect()->route('roles.index');
    }
    public function destroy(Role $role)
    {
        $role->delete();
        return back();
    }
}
