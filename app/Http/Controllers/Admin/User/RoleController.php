<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\RoleRequest;
use App\Models\User\Permission;
use App\Models\User\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.user.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.user.role.create', compact('permissions'));
    }

    public function store(RoleRequest $request)
    {
        $inputs = $request->except('permissions');
        $role = Role::create($inputs);
        if ($request->filled('permissions')) {
            $role->permissions()->sync($request->input('permissions'));
        }
        return redirect(route('admin.user.role.index'))->with('swal-success', 'نقش جدید با موفقیت ثبت شد');
    }

    public function show($id)
    {
        //
    }

    public function edit(Role $role)
    {
        return view('admin.user.role.edit', compact('role'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $inputs = $request->all();
        $role->update($inputs);
        return redirect(route('admin.user.role.index'))->with('swal-success', 'نقش با موفقیت ویرایش شد');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect(route('admin.user.role.index'))->with('swal-success', 'نقش با موفقیت حذف شد');
    }
    public function status(Role $role)
    {
        $role->status = $role->status == 0 ? 1 : 0;
        $result = $role->save();
        if ($result) {
            if ($role->status == 0) {
                return response()->json([
                    'status' => true,
                    'checked' => false
                ]);
            }
            return response()->json([
                'status' => true,
                'checked' => true
            ]);
        }
        return response()->json([
            'status' => false
        ]);
    }
    public function permissionForm(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.user.role.set-permission', compact(['role', 'permissions']));
    }

    public function permissionUpdate(RoleRequest $request, Role $role)
    {
        $role->permissions()->sync($request->input('permissions'));
        return redirect(route('admin.user.role.index'))->with('swal-success', 'دسترسی های نقش با موفقیت ویرایش شدند');
    }
}
