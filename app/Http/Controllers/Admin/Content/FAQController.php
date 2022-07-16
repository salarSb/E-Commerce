<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\FaqRequest;
use App\Models\Content\Faq;

class FAQController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderby('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.content.faq.create');
    }

    public function store(FaqRequest $request)
    {
        $inputs = $request->all();
        Faq::create($inputs);
        return redirect()->route('admin.content.faq.index')->with('swal-success', 'پرسش جدید با موفقیت ساخته شد');
    }

    public function show($id)
    {
        //
    }

    public function edit(Faq $faq)
    {
        return view('admin.content.faq.edit', compact('faq'));
    }

    public function update(FaqRequest $request, Faq $faq)
    {
        $inputs = $request->all();
        $faq->update($inputs);
        return redirect()->route('admin.content.faq.index')->with('swal-success', 'پرسش با موفقیت ویرایش شد');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.content.faq.index')->with('swal-success', 'پرسش با موفقیت حذف شد');
    }

    public function status(Faq $faq)
    {
        $faq->status = $faq->status == 0 ? 1 : 0;
        $result = $faq->save();
        if ($result) {
            if ($faq->status == 0) {
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
