@extends('admin.layouts.master')
@section('head-tag')
    <title>ایجاد دسترسی</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">دسترسی ها</a></li>
            <li class="active font-size-12" aria-current="page">ایجاد دسترسی</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ایجاد دسترسی</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.permission.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.user.permission.store') }}" method="post">
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-5 my-2">
                                <div class="form-group">
                                    <label for="name">عنوان دسترسی</label>
                                    <input id="name" name="name" class="form-control form-control-sm" type="text"
                                           value="{{ old('name') }}">
                                </div>
                                @error('name')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-5 my-2">
                                <div class="form-group">
                                    <label for="description">توضیح دسترسی</label>
                                    <input id="description" name="description" class="form-control form-control-sm"
                                           type="text" value="{{ old('description') }}">
                                </div>
                                @error('description')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-2 my-2">
                                <button class="btn btn-sm btn-primary mt-4">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>
            </section>
        </section>
    </section>
@endsection
