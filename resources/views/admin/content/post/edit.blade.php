@extends('admin.layouts.master')
@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
    <title>ویرایش پست</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوا</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">پست ها</a></li>
            <li class="active font-size-12" aria-current="page">ویرایش پست</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش پست</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.post.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.content.post.update', $post->slug) }}" method="post"
                          enctype="multipart/form-data" id="form">
                        @csrf
                        @method('put')
                        <section class="row">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="title">عنوان پست</label>
                                    <input id="title" class="form-control form-control-sm" type="text" name="title"
                                           value="{{ old('title',$post->title) }}">
                                </div>
                                @error('title')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="category_id">انتخاب دسته</label>
                                    <select class="form-control form-control-sm" name="category_id" id="category_id">
                                        <option value="">دسته را انتخاب کنید</option>
                                        @foreach($postCategories as $postCategory)
                                            <option value="{{ $postCategory->id }}"
                                                    @if(old('category_id', $post->category_id) == $postCategory->id)
                                                    selected
                                                @endif>
                                                {{ $postCategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="image">تصویر</label>
                                    <input class="form-control form-control-sm" type="file" name="image" id="image">
                                </div>
                                @error('image')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <section class="row">
                                    @php
                                        $number = 1;
                                    @endphp
                                    @foreach($post->image['indexArray'] as $key => $value)
                                        <section class="col-md-{{ 6 / $number }}">
                                            <div class="form-check">
                                                <input type="radio" id="{{ $number }}" class="form-check-input"
                                                       value="{{ $key }}" name="currentImage"
                                                       @if($post->image['currentImage'] == $key) checked @endif>
                                                <label for="{{ $number }}" class="form-check-label">
                                                    <img src="{{ asset($value) }}" class="w-100">
                                                </label>
                                            </div>
                                        </section>
                                        @php
                                            $number++;
                                        @endphp
                                    @endforeach
                                </section>
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="1"
                                                @if(old('status', $post->status) == 1) selected @endif>
                                            فعال
                                        </option>
                                        <option value="0"
                                                @if(old('status', $post->status) == 0) selected @endif>
                                            غیر فعال
                                        </option>
                                    </select>
                                </div>
                                @error('status')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="commentable">امکان درج کامنت</label>
                                    <select name="commentable" id="commentable" class="form-control form-control-sm">
                                        <option value="1"
                                                @if(old('commentable', $post->commentable) == 1) selected @endif>
                                            فعال
                                        </option>
                                        <option value="0"
                                                @if(old('commentable', $post->commentable) == 0) selected @endif>
                                            غیر فعال
                                        </option>
                                    </select>
                                </div>
                                @error('commentable')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="published_at_view">تاریخ انتشار</label>
                                    <input id="published_at" class="form-control form-control-sm d-none" type="text"
                                           name="published_at">
                                    <input id="published_at_view" type="text" class="form-control form-control-sm">
                                </div>
                                @error('published_at')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="select-tags">برچسب ها</label>
                                    <input class="form-control form-control-sm" type="hidden" name="tags" id="tags"
                                           value="{{ old('tags', $post->tags) }}">
                                    <select class="select2 form-control form-control-sm" id="select-tags"
                                            multiple></select>
                                </div>
                                @error('tags')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="summary">خلاصه پست</label>
                                    <textarea class="form-control form-control-sm" rows="6" id="summary"
                                              name="summary">
                                        {{ old('summary',$post->summary) }}
                                    </textarea>
                                </div>
                                @error('summary')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="body">متن پست</label>
                                    <textarea class="form-control form-control-sm" rows="6" id="body"
                                              name="body">
                                        {{ old('body', $post->body) }}
                                    </textarea>
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
            </section>
        </section>
    </section>
@endsection
@section('script')
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        CKEDITOR.replace('summary')
        CKEDITOR.replace('body')
    </script>
    <script>
        $(document).ready(function () {
            $('#published_at_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#published_at'
            })
        })
    </script>
    <script>
        $(document).ready(function () {
            let tags_input = $('#tags');
            let select_tags = $('#select-tags');
            let default_tags = tags_input.val();
            let default_data = null;
            if (tags_input.val() !== null && tags_input.val().length > 0) {
                default_data = default_tags.split(',')
            }
            select_tags.select2({
                placeholder: 'لطفا تگ های خود را وارد نمایید',
                tags: true,
                data: default_data
            });
            select_tags.children('option').attr('selected', true).trigger('change');
            $('#form').submit(function () {
                if (select_tags.val() !== null && select_tags.val().length > 0) {
                    let selectedSource = select_tags.val().join(',');
                    tags_input.val(selectedSource);
                }
            });
        })
    </script>
@endsection
