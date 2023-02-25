@extends('admin.layouts.master')
@section('head-tag')
    <title>تنظیمات</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">تنظیمات</a></li>
            <li class="active font-size-12" aria-current="page">ویرایش تنظیمات</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش تنظیمات</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.setting.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.setting.update', $setting->id) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <section class="row">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="title">عنوان سایت</label>
                                    <input class="form-control form-control-sm" type="text" name="title" id="title"
                                           value="{{ old('title', $setting->title) }}">
                                </div>
                                @error('title')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="keywords">کلمات کلیدی سایت</label>
                                    <input class="form-control form-control-sm" type="text" name="keywords"
                                           id="keywords"
                                           value="{{ old('keywords', $setting->keywords) }}">
                                </div>
                                @error('keywords')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="description">توضیحات</label>
                                    <textarea class="form-control form-control-sm" rows="6" id="description"
                                              name="description">{{ old('description', $setting->description) }}</textarea>
                                </div>
                                @error('description')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="image">لوگو</label>
                                    <input type="file" class="form-control form-control-sm" name="logo" id="image">
                                </div>
                                <img src="{{ asset($setting->logo) }}" alt="avatar" height="180"
                                     width="310">
                                @error('logo')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="icon">آیکون</label>
                                    <input class="form-control form-control-sm" type="file" name="icon" id="icon">
                                </div>
                                <img src="{{ asset($setting->icon) }}" alt="avatar" height="180"
                                     width="310">
                                @error('icon')
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
