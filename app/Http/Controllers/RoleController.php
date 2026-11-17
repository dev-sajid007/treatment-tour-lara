<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    // Create a new role
    public function createRole(Request $request)
    {
        // Validate role name
        $request->validate([
            'role' => 'required|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        // Create the new role
        $role = Role::create(['name' => $request->role]);

        // Assign permissions if any are selected
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions); // Sync permissions to the role
        }

        return redirect()->back()->with('success', 'Role created and permissions assigned successfully.');
    }

    // Create a new permission
    public function createPermission(Request $request)
    {
        $validated = $request->validate([
            'permission' => 'required|string|max:255',
        ]);

        // Create the permission
        $permission = Permission::create(['name' => $validated['permission']]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Permission created successfully');
    }

    // Assign a permission to a role
   public function assignPermissionToRole(Request $request, $roleName)
    {
        $request->validate([
            'permission' => 'required|array',  // Accept an array of permissions
            'permission.*' => 'string|max:255', // Validate each permission
        ]);

        $role = Role::findByName($roleName);

        if ($role) {
            // Assign the selected permissions to the role
            $role->syncPermissions($request->permission); // Use sync to update permissions
            return redirect()->back()->with('success', 'Permissions assigned to role successfully.');
        }

        return redirect()->back()->with('error', 'Role not found.');
    }

    // Remove a permission from a role
    public function removePermissionFromRole(Request $request, $roleName)
    {
        $request->validate([
            'permission' => 'required|string|max:255',
        ]);

        $role = Role::findByName($roleName);
        $permission = Permission::findByName($request->permission);

        if ($role && $permission) {
            $role->revokePermissionTo($permission);
            return redirect()->back()->with('success', 'Permission removed from role successfully.');
        }

        return redirect()->back()->with('error', 'Role or permission not found.');
    }

    // Assign a role to a user
    public function assignRoleToUser(Request $request, $userId)
    {
        $request->validate([
            'role' => 'required|string|max:255',
        ]);

        $user = User::find($userId);
        $role = Role::findByName($request->role);

        if ($user && $role) {
            $user->assignRole($role);
            return redirect()->back()->with('success', 'Role assigned to user successfully.');
        }

        return redirect()->back()->with('error', 'User or role not found.');
    }

    // Remove a role from a user
    public function removeRoleFromUser(Request $request, $userId)
    {
        $request->validate([
            'role' => 'required|string|max:255',
        ]);

        $user = User::find($userId);
        $role = Role::findByName($request->role);

        if ($user && $role) {
            $user->removeRole($role);
            return redirect()->back()->with('success', 'Role removed from user successfully.');
        }

        return redirect()->back()->with('error', 'User or role not found.');
    }

    // Assign a permission to a user
    public function assignPermissionToUser(Request $request, $userId)
    {
        $request->validate([
            'permission' => 'required|string|max:255',
        ]);

        $user = User::find($userId);
        $permission = Permission::findByName($request->permission);

        if ($user && $permission) {
            $user->givePermissionTo($permission);
            return redirect()->back()->with('success', 'Permission assigned to user successfully.');
        }

        return redirect()->back()->with('error', 'User or permission not found.');
    }

    // Remove a permission from a user
    public function removePermissionFromUser(Request $request, $userId)
    {
        $request->validate([
            'permission' => 'required|string|max:255',
        ]);

        $user = User::find($userId);
        $permission = Permission::findByName($request->permission);

        if ($user && $permission) {
            $user->revokePermissionTo($permission);
            return redirect()->back()->with('success', 'Permission removed from user successfully.');
        }

        return redirect()->back()->with('error', 'User or permission not found.');
    }

    // Get all roles (optional)
    public function getAllRoles()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('roles.index', compact('roles', 'permissions')); // Assuming you have a view for this
    }

    // Get all permissions (optional)
    public function getAllPermissions()
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions')); // Assuming you have a view for this
    }

    // Delete a role
    public function deleteRole($roleName)
    {
        $role = Role::findByName($roleName);

        if ($role) {
            $role->delete();
            return redirect()->back()->with('success', 'Role deleted successfully.');
        }

        return redirect()->back()->with('error', 'Role not found.');
    }

    // Delete a permission
    public function deletePermission($permissionName)
    {
        $permission = Permission::findByName($permissionName);

        if ($permission) {
            $permission->delete();
            return redirect()->back()->with('success', 'Permission deleted successfully.');
        }

        return redirect()->back()->with('error', 'Permission not found.');
    }


     public function editPermissions($roleName)
    {
        // Find the role by name
        $role = Role::findByName($roleName);
        $permissions = Permission::all();

        // Pass the role and all permissions to the view
        return view('roles.edit_permissions', compact('role', 'permissions'));
    }

    // PUT method to update permissions for the role
    public function updatePermissions(Request $request, $roleName)
    {
        // Validate that permissions is an array
        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'string|max:255',
        ]);

        // Find the role by name
        $role = Role::findByName($roleName);

        if ($role) {
            // Sync the selected permissions
            $role->syncPermissions($request->permissions);

            return redirect()->back()->with('success', 'Permissions updated successfully.');
        }

        return redirect()->back()->with('error', 'Role not found.');
    }



}
