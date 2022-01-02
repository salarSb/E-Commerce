<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\AdminUserRequest;
use App\Http\Services\Image\ImageService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $admins = User::where('user_type', 1)->get();
        return view('admin.user.admin-user.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.user.admin-user.create');
    }

    public function store(AdminUserRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('profile_photo_path')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));
            if ($result === false) {
                return redirect()->route('admin.user.adminUser.index')
                    ->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }
        $inputs['user_type'] = 1;
        $inputs['password'] = Hash::make($request->input('password'));
        User::create($inputs);
        return redirect()->route('admin.user.adminUser.index')
            ->with('swal-success', 'کاربر ادمین جدید با موفقیت ساخته شد');
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        return view('admin.user.admin-user.edit', compact('user'));
    }

    public function update(AdminUserRequest $request, User $user, ImageService $imageService)
    {
        // TODO: edit admin's email and password and verify them
        $inputs = $request->all();
        if ($request->hasFile('profile_photo_path')) {
            if (!empty($user->profile_photo_path)) {
                $imageService->deleteImage($user->profile_photo_path);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
            $result = $imageService->save($request->file('profile_photo_path'));
            if ($result === false) {
                return redirect()->route('admin.user.adminUser.index')
                    ->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['profile_photo_path'] = $result;
        }
        $user->update($inputs);
        return redirect()->route('admin.user.adminUser.index')
            ->with('swal-success', 'پروفایل با موفقیت ویرایش شد');
    }

    public function destroy(User $user, ImageService $imageService)
    {
        $user->forceDelete();
        $imageService->deleteImage($user->profile_photo_path);
        return redirect(route('admin.user.adminUser.index'))
            ->with('swal-success', 'کاربر ادمین با موفقیت حذف شد');
    }

    public function status(User $user)
    {
        $user->status = $user->status == 0 ? 1 : 0;
        $result = $user->save();
        if ($result) {
            if ($user->status == 0) {
                return response()->json([
                    'status' => true,
                    'checked' => false
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'checked' => true
                ]);
            }
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function activation(User $user)
    {
        $user->activation = $user->activation == 0 ? 1 : 0;
        $result = $user->save();
        if ($result) {
            if ($user->activation == 0) {
                return response()->json([
                    'status' => true,
                    'checked' => false
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'checked' => true
                ]);
            }
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
}
