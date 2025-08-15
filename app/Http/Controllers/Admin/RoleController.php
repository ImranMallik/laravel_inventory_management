<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\PermissionRegistrar;

class RoleController extends Controller
{
    public function allPermission()
    {
        $permission = Permission::all();
        return view('admin.role_permission.permission.index', compact('permission'));
    }

    public function permission()
    {
        return view('admin.role_permission.permission.create');
    }

    public function storePermission(Request $request)
    {
        // normalize inputs
        $data = $request->only(['name', 'group_name']);
        $data['name'] = trim(preg_replace('/\s+/', ' ', $data['name'] ?? ''));
        $data['group_name'] = trim($data['group_name'] ?? '');

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:191',
                // unique by name; if you want uniqueness per group_name, add Rule::unique with a where()
                Rule::unique('permissions', 'name'),
            ],
            'group_name' => ['required', 'string', 'max:191'],
        ]);

        try {
            // If you're using spatie/laravel-permission:
            $permission = Permission::create([
                'name'       => $data['name'],
                'group_name' => $data['group_name'], // ensure this column exists in your permissions table
                'guard_name' => 'web',                // required by spatie
            ]);

            // Clear spatie permission cache
            app(PermissionRegistrar::class)->forgetCachedPermissions();

            return redirect()
                ->route('admin.all.permission')
                ->with([
                    'message' => 'Permission created successfully.',
                    'alert-type' => 'success',
                ]);
        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->withErrors(['name' => 'Failed to create permission.']);
        }
    }
    public function deletePermission($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'permission deleted successfully'
        ]);
    }

    public function editPermission($id)
    {

        $permission = Permission::findOrFail($id);


        return view('admin.role_permission.permission.edit', compact('permission'));
    }

    public function updatePermission(Request $request, $id)
    {
        $data = $request->only(['name', 'group_name']);
        $data['name'] = trim(preg_replace('/\s+/', ' ', $data['name'] ?? ''));
        $data['group_name'] = trim($data['group_name'] ?? '');

        // Validate input
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:191',
                Rule::unique('permissions', 'name')->ignore($id), // Ignore current record when checking uniqueness
            ],
            'group_name' => ['required', 'string', 'max:191'],
        ]);

        try {
            // Find the existing permission
            $permission = Permission::findOrFail($id);

            // Update the record
            $permission->update([
                'name'       => $data['name'],
                'group_name' => $data['group_name'],
                'guard_name' => $permission->guard_name ?? 'web', // Keep existing guard_name
            ]);

            // Clear Spatie permission cache
            app(PermissionRegistrar::class)->forgetCachedPermissions();

            return redirect()
                ->route('admin.all.permission')
                ->with([
                    'message' => 'Permission updated successfully.',
                    'alert-type' => 'success',
                ]);
        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->withErrors(['name' => 'Failed to update permission.']);
        }
    }

    public function getAllrole()
    {
        $roles = Role::all();
        return view('admin.role_permission.role.index', compact('roles'));
    }

    public function storeRoll(Request $request)
    {
    try {
        // Validate request
        $validator = Validator::make($request->all(), [
            'roleName' => 'required|string|max:255|unique:roles,name',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        // Create role
        $role = Role::create(['name' => $request->roleName]);

        return response()->json([
            'success' => true,
            'message' => 'Role created successfully.',
            'data'    => $role
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }
}
public function deleteRole($id){
    $userRole=Role::findOrFail($id);
    $userRole->delete();
     return response()->json([
            'status' => 'success',
            'message' => 'Role deleted successfully'
     ]);
}

public function updateRole(Request $request, $id)
{
    // dd($request->all());
    try {
       
        $validator = Validator::make($request->all(), [
            'roleName' => 'required|string|max:255|unique:roles,name,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

     
        $role = Role::findOrFail($id);
        $role->name = $request->roleName;
        $role->save();

        return response()->json([
            'success' => true,
            'message' => 'Role updated successfully.',
            'data'    => $role
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }
 }
}
