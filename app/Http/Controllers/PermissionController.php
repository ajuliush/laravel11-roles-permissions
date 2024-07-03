<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Permission::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $permissions = $query->paginate(10);
        return view('backend.admin.permission.list', compact('permissions'));
    }

    /**
     * This method will show create permission page.
     */
    public function create()
    {
        return view('backend.admin.permission.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:permissions|min:3'
        ]);
        if ($validator->passes()) {
            Permission::create([
                'name' => $request->name
            ]);
            return redirect()->route('permission.index')->with('success', 'Permissions created successfully');
        } else {
            return redirect()->route('permission.create')->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    }
}