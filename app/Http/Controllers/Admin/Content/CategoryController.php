<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostCategoryRequest;
use App\Models\Content\PostCategory;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $postCategories = PostCategory::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.category.index', compact('postCategories'));
    }

    public function create()
    {
        return view('admin.content.category.create');
    }

    public function store(PostCategoryRequest $request)
    {
        $inputs = $request->all();
        $inputs['slug'] = str_replace(' ', '-', $inputs['name']) . '-' . Str::random(5);
        $inputs['image'] = 'image';
        PostCategory::create($inputs);
        return redirect()->route('admin.content.category.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(PostCategory $postCategory)
    {
        return view('admin.content.category.edit', compact('postCategory'));
    }

    public function update(PostCategoryRequest $request, PostCategory $postCategory)
    {
        $inputs = $request->all();
        $inputs['image'] = 'image';
        $postCategory->update($inputs);
        return redirect()->route('admin.content.category.index');
    }

    public function destroy(PostCategory $postCategory)
    {
        $postCategory->delete();
        return redirect(route('admin.content.category.index'));
    }
}
