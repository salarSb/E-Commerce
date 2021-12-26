@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش فایل اطلاعیه ایمیلی</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">اطلاعیه ایمیلی</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">فایل های اطلاعیه ایمیلی</a></li>
            <li class="active font-size-12" aria-current="page">ویرایش فایل اطلاعیه ایمیلی</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش فایل اطلاعیه ایمیلی</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.notify.email-file.index', $file->email->id) }}"
                       class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.notify.email-file.update', $file->id) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <section class="row">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="file">فایل</label>
                                    <input class="form-control form-control-sm" type="file" name="file" id="file">
                                </div>
                                @error('file')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="1" @if(old('status', $file->status) == 1) selected @endif>
                                            فعال
                                        </option>
                                        <option value="0" @if(old('status', $file->status) == 0) selected @endif>
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
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="public" name="file_path"
                                               class="custom-control-input" value="public"
                                               @if(!old('file_path')) checked @endif>
                                        <label class="custom-control-label" for="public">
                                            اضافه شدن فایل به پوشه public
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="storage" name="file_path"
                                               class="custom-control-input" value="storage"
                                               @if(old('file_path')) checked @endif>
                                        <label class="custom-control-label" for="storage">
                                            اضافه شدن فایل به پوشه storage
                                        </label>
                                    </div>
                                </div>
                                @error('file_path')
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
