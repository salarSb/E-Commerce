<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\MenuRequest;
use App\Models\Content\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderby('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.menu.index', compact('menus'));
    }

    public function create()
    {
        $menus = Menu::where('parent_id', null)->get();
        return view('admin.content.menu.create', compact('menus'));
    }

    public function store(MenuRequest $request)
    {
        $inputs = $request->all();
        Menu::create($inputs);
        return redirect()->route('admin.content.menu.index')->with('swal-success', 'منو جدید با موفقیت ساخته شد');
    }

    public function show($id)
    {
        //
    }

    public function edit(Menu $menu)
    {
        $menus = Menu::where('parent_id', null)->get();
        return view('admin.content.menu.edit', compact(['menus', 'menu']));
    }

    public function update(MenuRequest $request, Menu $menu)
    {
        $inputs = $request->all();
        $menu->update($inputs);
        return redirect()->route('admin.content.menu.index')->with('swal-success', 'منو با موفقیت ویرایش شد');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.content.menu.index')->with('swal-success', 'منو با موفقیت حذف شد');
    }

    public function status(Menu $menu)
    {
        $menu->status = $menu->status == 0 ? 1 : 0;
        $result = $menu->save();
        if ($result) {
            if ($menu->status == 0) {
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
                'faq' => false
            ]);
        }
    }
}
