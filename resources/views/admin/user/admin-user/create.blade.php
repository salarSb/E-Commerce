@extends('admin.layouts.master')
@section('head-tag')
    <title>ایجاد ادمین</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">کاربران ادمین</a></li>
            <li class="active font-size-12" aria-current="page">ایجاد ادمین</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ایجاد ادمین</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.adminUser.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.user.adminUser.store') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="first_name">نام</label>
                                    <input id="first_name" name="first_name" class="form-control form-control-sm"
                                           type="text" value="{{ old('first_name') }}">
                                </div>
                                @error('first_name')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="last_name">نام خانوادگی</label>
                                    <input id="last_name" name="last_name" class="form-control form-control-sm"
                                           type="text" value="{{ old('last_name') }}">
                                </div>
                                @error('last_name')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="email">ایمیل</label>
                                    <input id="email" name="email" class="form-control form-control-sm" type="text"
                                           value="{{ old('email') }}">
                                </div>
                                @error('email')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="mobile">شماره موبایل</label>
                                    <input id="mobile" name="mobile" class="form-control form-control-sm" type="text"
                                           value="{{ old('mobile') }}">
                                </div>
                                @error('mobile')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="password">کلمه عبور</label>
                                    <input id="password" name="password" class="form-control form-control-sm"
                                           type="password" value="{{ old('password') }}">
                                </div>
                                @error('password')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="password_confirmation">تکرار کلمه عبور</label>
                                    <input id="password_confirmation" name="password_confirmation"
                                           class="form-control form-control-sm" type="password"
                                           value="{{ old('password_confirmation') }}">
                                </div>
                                @error('password_confirmation')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="profile_photo_path">عکس پروفایل</label>
                                    <input id="profile_photo_path" name="profile_photo_path" type="file"
                                           class="form-control form-control-sm">
                                </div>
                                @error('profile_photo_path')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="national_code">کد ملی</label>
                                    <input id="national_code" name="national_code" class="form-control form-control-sm"
                                           type="text"
                                           value="{{ old('national_code') }}">
                                </div>
                                @error('national_code')
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
