<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
  

    // GET /api/admin/roles - Sab roles with permissions
    public function index()
    {
        $roles = Role::with('permissions')
            ->where('guard_name', 'web')
            ->where('name', '!=', 'admin')  // Admin ko edit se hide karo
            ->get()
            ->map(fn($role) => [
                'id' => $role->id,
                'name' => $role->name,
                'permissions' => $role->permissions->pluck('name'),
            ]);

        return response()->json(['success' => true, 'data' => $roles]);
    }

    // GET /api/admin/permissions - Sab available permissions
    public function allPermissions()
    {
        $permissions = Permission::where('guard_name', 'web')
            ->pluck('name')
            ->values();

        return response()->json(['success' => true, 'data' => $permissions]);
    }

    // POST /api/admin/roles/{role}/permissions - Role ki permissions update karo
    public function updateRolePermissions(Request $request, $roleId)
    {
        $request->validate([
            'permissions' => 'required|array',
        ]);

        $role = Role::where('guard_name', 'web')->findOrFail($roleId);
        
        if ($role->name === 'admin') {
            return response()->json([
                'success' => false, 
                'message' => 'Cannot modify admin'
            ], 403);
        }

        $role->syncPermissions($request->permissions);

        return response()->json([
            'success' => true,
            'message' => "Permissions updated for {$role->name}"
        ]);
    }

    // GET /api/admin/users-list - Sab users with roles
    public function users()
    {
        $users = User::with('roles')->get()->map(fn($user) => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'roles' => $user->getRoleNames(),
        ]);

        return response()->json(['success' => true, 'data' => $users]);
    }

    // POST /api/admin/users/{user}/assign-role - User ko role assign karo
    public function assignRole(Request $request, $userId)
    {
        $request->validate(['role' => 'required|string']);

        $user = User::findOrFail($userId);
        
        if ($user->hasRole('admin')) {
            return response()->json([
                'success' => false, 
                'message' => 'Cannot modify admin'
            ], 403);
        }

        $user->syncRoles([$request->role]);

        return response()->json([
            'success' => true,
            'message' => "Role assigned to {$user->name}"
        ]);
    }

    // POST /api/admin/users/create - Naya user banao
    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|string|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->role);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ]);
    }
}