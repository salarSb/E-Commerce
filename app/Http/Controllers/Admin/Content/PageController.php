<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PageRequest;
use App\Models\Content\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.page.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.content.page.create');
    }

    public function store(PageRequest $request)
    {
        $inputs = $request->all();
        Page::create($inputs);
        return redirect()->route('admin.content.page.index')->with('swal-success', 'صفحه جدید با موفقیت ساخته شد');
    }

    public function show($id)
    {
        //
    }

    public function edit(Page $page)
    {
        return view('admin.content.page.edit', compact('page'));
    }

    public function update(PageRequest $request, Page $page)
    {
        $inputs = $request->all();
        $page->update($inputs);
        return redirect()->route('admin.content.page.index')->with('swal-success', 'صفحه جدید با موفقیت ویرایش شد');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.content.page.index')->with('swal-success', 'صفحه با موفقیت حذف شد');
    }

    public function status(Page $page)
    {
        $page->status = $page->status == 0 ? 1 : 0;
        $result = $page->save();
        if ($result) {
            if ($page->status == 0) {
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
