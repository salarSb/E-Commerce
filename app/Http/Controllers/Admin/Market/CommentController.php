<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\CommentRequest;
use App\Models\Content\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::productComments()->orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.market.comment.index', compact('comments'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Comment $comment)
    {
        $unSeenComment = Comment::find($comment->id);
        $unSeenComment->seen = 1;
        $unSeenComment->save();
        return view('admin.market.comment.show', compact('comment'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function status(Comment $comment)
    {
        $comment->status = $comment->status == 0 ? 1 : 0;
        $result = $comment->save();
        if ($result) {
            if ($comment->status == 0) {
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

    public function approved(Comment $comment)
    {
        $comment->approved = $comment->approved == 0 ? 1 : 0;
        $result = $comment->save();
        if ($result) {
            return redirect()->route('admin.market.comment.index')->with('swal-success', 'وضعیت تایید نظر با موفقیت تغییر کرد');
        } else {
            return redirect()->route('admin.market.comment.index')->with('swal-error', 'تغییر وضعیت تایید نظر با خطا مواجه شد');
        }
    }
    public function answer(CommentRequest $request, Comment $comment)
    {
        if (!$comment->parent_id) {
            $inputs = $request->all();
            $inputs['author_id'] = 1;
            $inputs['parent_id'] = $comment->id;
            $inputs['commentable_id'] = $comment->commentable_id;
            $inputs['commentable_type'] = $comment->commentable_type;
            $inputs['approved'] = 1;
            $inputs['status'] = 1;
            Comment::create($inputs);
            return redirect()->route('admin.market.comment.index')->with('swal-success', 'پاسخ شما با موفقیت ثبت شد');
        } else {
            return redirect()->route('admin.market.comment.index')->with('swal-error', 'پاسخ به نظری که پاسخ نظر دیگریست ممکن نیست');
        }
    }
}
