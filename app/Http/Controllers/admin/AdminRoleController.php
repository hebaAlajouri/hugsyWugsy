<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRole;
use App\Models\User;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    public function index()
    {
        $adminRoles = AdminRole::with('user')->get();
        return view('admin.admin_roles.index', compact('adminRoles'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.admin_roles.create', compact('users'));
    }

    public function store(Request $request)
    {
        AdminRole::create($request->all());
        return redirect()->route('admin.admin_roles.index')->with('success', 'Admin role created.');
    }

    public function edit(AdminRole $admin_role)
    {
        $users = User::all();
        return view('admin.admin_roles.edit', compact('admin_role', 'users'));
    }

    public function update(Request $request, AdminRole $admin_role)
    {
        $admin_role->update($request->all());
        return redirect()->route('admin.admin_roles.index')->with('success', 'Admin role updated.');
    }

    public function destroy(AdminRole $admin_role)
    {
        $admin_role->delete();
        return redirect()->route('admin.admin_roles.index')->with('success', 'Admin role deleted.');
    }
}
