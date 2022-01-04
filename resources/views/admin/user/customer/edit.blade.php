@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش کاربر</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">مشتریان</a></li>
            <li class="active font-size-12" aria-current="page">ویرایش کاربر</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش کاربر</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.customer.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.user.customer.update',$user->slug) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <section class="row">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="first_name">نام</label>
                                    <input id="first_name" name="first_name" class="form-control form-control-sm"
                                           type="text" value="{{ old('first_name',$user->first_name) }}">
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
                                           type="text" value="{{ old('last_name',$user->last_name) }}">
                                </div>
                                @error('last_name')
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
                                @if($user->profile_photo_path)
                                    <img src="{{ asset($user->profile_photo_path) }}" alt="avatar" height="180"
                                         width="310">
                                @endif
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
                                           value="{{ old('national_code',$user->national_code) }}">
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
