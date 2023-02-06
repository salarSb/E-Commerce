<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\Post;
use App\Models\Content\PostCategory;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.post.index', compact('posts'));
    }

    public function create()
    {
        $postCategories = PostCategory::all();
        return view('admin.content.post.create', compact('postCategories'));
    }

    public function store(PostRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();

        //date fix
        $realTimeStampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date('Y-m-d H:m:s', (int)$realTimeStampStart);

        //upload image
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.content.post.index')
                    ->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }
        auth()->user()->posts()->create($inputs);
        return redirect()->route('admin.content.post.index')
            ->with('swal-success', 'پست جدید با موفقیت ثبت شد');
    }

    public function show($id)
    {
        //
    }

    public function edit(Post $post)
    {
        $postCategories = PostCategory::all();
        return view('admin.content.post.edit', compact(['post', 'postCategories']));
    }

    public function update(PostRequest $request, Post $post, ImageService $imageService)
    {
        $inputs = $request->all();

        //date fix
        $realTimeStampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date('Y-m-d H:m:s', (int)$realTimeStampStart);

        if ($request->hasFile('image')) {
            if (!empty($post->image)) {
                $imageService->deleteDirectoryAndFiles($post->image['directory']);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.content.post.index')
                    ->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        } else {
            if (isset($inputs['currentImage']) && !empty($post->image)) {
                $image = $post->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }
        $post->update($inputs);
        return redirect()->route('admin.content.post.index')
            ->with('swal-success', 'پست با موفقیت ویرایش شد');
    }

    public function destroy(Post $post)
    {
        //we wont delete image in destroy method because we use soft delete
        $post->delete();
        return redirect(route('admin.content.post.index'))
            ->with('swal-success', 'پست با موفقیت حذف شد');
    }

    public function status(Post $post)
    {
        $post->status = $post->status == 0 ? 1 : 0;
        $result = $post->save();
        if ($result) {
            if ($post->status == 0) {
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

    public function commentable(Post $post)
    {
        $post->commentable = $post->commentable == 0 ? 1 : 0;
        $result = $post->save();
        if ($result) {
            if ($post->commentable == 0) {
                return response()->json([
                    'commentable' => true,
                    'checked' => false
                ]);
            } else {
                return response()->json([
                    'commentable' => true,
                    'checked' => true
                ]);
            }
        } else {
            return response()->json([
                'commentable' => false
            ]);
        }
    }
}
