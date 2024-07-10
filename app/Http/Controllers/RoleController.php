<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    // This method will show roles page
    public function index(Request $request)
    {
        $query = Role::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $roles = $query->paginate(10);
        return view('backend.admin.role.list', compact('roles'));
    }
    // This method will  create roles page
    public function create(Request $request)
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();
        return view('backend.admin.role.create', compact('permissions'));
    }
    // This method will insert a role into the database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:roles|min:3'
        ]);

        if ($validator->passes()) {
            $role = Role::create([
                'name' => $request->name
            ]);
            if (!empty($request->permission)) {
                foreach ($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }

            return redirect()->route('role.index')->with('success', 'Role created successfully');
        } else {
            return redirect()->route('role.create')->withInput()->withErrors($validator);
        }
    }
    // This method will show roles edit page
    public function edit($id)
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();
        $role = Role::findOrFail($id);
        return view('backend.admin.role.edit', compact('role', 'permissions'));
    }
    // This method will update a role in the database
    public function update(Request $request, $id)
    {
    }
    // This method will show roles page
    public function destroy($id)
    {
    }
}