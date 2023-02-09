<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\PermissionRequest;
use App\Models\User\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.user.permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.user.permission.create');
    }

    public function store(PermissionRequest $request)
    {
        Permission::create($request->validated());
        return redirect(route('admin.user.permission.index'))->with('swal-success', 'دسترسی جدید با موفقیت ثبت شد');
    }

    public function show($id)
    {
        //
    }

    public function edit(Permission $permission)
    {
        return view('admin.user.permission.edit', compact('permission'));
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        $permission->update($request->validated());
        return redirect(route('admin.user.permission.index'))->with('swal-success', 'دسترسی با موفقیت ویرایش شد');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect(route('admin.user.permission.index'))->with('swal-success', 'دسترسی با موفقیت حذف شد');
    }

    public function status(Permission $permission)
    {
        $permission->status = $permission->status == 0 ? 1 : 0;
        $result = $permission->save();
        if ($result) {
            if ($permission->status == 0) {
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
}
