<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
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
}
