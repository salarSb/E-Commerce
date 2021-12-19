<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\SettingRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Setting\Setting;
use Database\Seeders\SettingSeeder;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        if ($setting === null) {
            $default = new SettingSeeder();
            $default->run();

            //to find setting after creating it and prevent the null object compacting in view
            $setting = Setting::first();
        }
        return view('admin.setting.index', compact('setting'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit(Setting $setting)
    {
        return view('admin.setting.edit', compact('setting'));
    }

    public function update(SettingRequest $request, Setting $setting, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('logo')) {
            if (!empty($setting->logo)) {
                $imageService->deleteDirectoryAndFiles($setting->logo);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'setting');
            $imageService->setImageName('logo');
            $result = $imageService->save($request->file('logo'));
            if ($result === false) {
                return redirect()->route('admin.setting.index')->with('swal-error', 'آپلود لوگو با خطا مواجه شد');
            }
            $inputs['logo'] = $result;
        }
        if ($request->hasFile('icon')) {
            if (!empty($setting->icon)) {
                $imageService->deleteDirectoryAndFiles($setting->icon);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'setting');
            $imageService->setImageName('icon');
            $result = $imageService->save($request->file('icon'));
            if ($result === false) {
                return redirect()->route('admin.setting.index')->with('swal-error', 'آپلود آیکون با خطا مواجه شد');
            }
            $inputs['icon'] = $result;
        }
        $setting->update($inputs);
        return redirect()->route('admin.setting.index')->with('swal-success', 'تنظیمات سایت  شما با موفقیت ویرایش شد');
    }

    public function destroy($id)
    {
        //
    }
}
