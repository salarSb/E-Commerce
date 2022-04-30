@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش بنر</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوا</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بنرها</a></li>
            <li class="active font-size-12" aria-current="page">ویرایش بنر</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش بنر</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.banner.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.content.banner.update', $banner->id) }}" method="post"
                          enctype="multipart/form-data" id="form">
                        @csrf
                        @method('put')
                        <section class="row">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="title">عنوان</label>
                                    <input class="form-control form-control-sm" type="text" name="title" id="title"
                                           value="{{ old('title', $banner->title) }}">
                                </div>
                                @error('title')
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
                                    @foreach($banner->image['indexArray'] as $key => $value)
                                        <section class="col-md-{{ 6 / $number }}">
                                            <div class="form-check">
                                                <input type="radio" id="{{ $number }}" class="form-check-input"
                                                       value="{{ $key }}" name="currentImage"
                                                       @if($banner->image['currentImage'] == $key) checked @endif>
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
                                    <label for="url">آدرس</label>
                                    <input class="form-control form-control-sm" type="text" name="url" id="url"
                                           value="{{ old('url', $banner->url) }}">
                                </div>
                                @error('url')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="position">موقیعت</label>
                                    <input class="form-control form-control-sm" type="text" name="position"
                                           id="position"
                                           value="{{ old('position', $banner->position) }}">
                                </div>
                                @error('position')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="1" @if(old('status', $banner->status) == 1) selected @endif>
                                            فعال
                                        </option>
                                        <option value="0" @if(old('status', $banner->status) == 0) selected @endif>غیر
                                            فعال
                                        </option>
                                    </select>
                                </div>
                                @error('status')
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
