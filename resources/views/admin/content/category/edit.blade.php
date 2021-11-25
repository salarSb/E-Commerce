@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش دسته بندی</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوا</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">دسته بندی</a></li>
            <li class="active font-size-12" aria-current="page">ویرایش دسته بندی</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش دسته بندی</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.category.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.content.category.update', $postCategory->id) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <section class="row">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="name">نام دسته</label>
                                    <input class="form-control form-control-sm" type="text" name="name" id="name"
                                           value="{{ old('name', $postCategory->name) }}">
                                </div>
                                @error('name')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="tags">تگ ها</label>
                                    <input class="form-control form-control-sm" type="text" name="tags" id="tags"
                                           value="{{ old('tags', $postCategory->tags) }}">
                                </div>
                                @error('tags')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="1"
                                                @if(old('status', $postCategory->status) == 1) selected @endif>
                                            فعال
                                        </option>
                                        <option value="0"
                                                @if(old('status', $postCategory->status) == 0) selected @endif>
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
                                    <label for="image">تصویر</label>
                                    <input class="form-control form-control-sm" type="file" name="image" id="image">
                                </div>
                                @error('image')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="description">توضیحات</label>
                                    <textarea class="form-control form-control-sm" rows="6" id="description"
                                              name="description">
                                        {{ old('description', $postCategory->description) }}
                                    </textarea>
                                </div>
                                @error('description')
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
    <script>
        CKEDITOR.replace('description')
    </script>
@endsection
