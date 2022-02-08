@extends('admin.layouts.master')
@section('head-tag')
    <title>نمایش نظر</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">نظرات</a></li>
            <li class="active font-size-12" aria-current="page">نمایش نظر</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>نمایش نظر</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.comment.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section class="card mb-3">
                    <section class="card-header text-white bg-custom-yellow">
                        {{ $comment->user->full_name }} - {{ $comment->author_id }}
                    </section>
                    <section class="card-body">
                        <h5 class="card-title">نام کالا:
                            {{ $comment->commentable->name }} -
                            کد کالا:
                            {{ $comment->commentable_id }}
                        </h5>
                        <p class="card-text">
                            {{ $comment->body }}
                        </p>
                    </section>
                </section>
                @if(!$comment->parent_id)
                    <section>
                        <form action="{{ route('admin.market.comment.answer', $comment->id) }}" method="post">
                            @csrf
                            <section class="row">
                                <section class="col-12 my-2">
                                    <div class="form-group">
                                        <label for="body">پاسخ ادمین</label>
                                        <textarea id="body" class="form-control form-control-sm" rows="4"
                                                  name="body"></textarea>
                                    </div>
                                    @error('body')
                                    <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </section>
                            </section>
                            <button class="btn btn-sm btn-primary">ثبت</button>
                        </form>
                    </section>
                @endif
            </section>
        </section>
    </section>
@endsection
