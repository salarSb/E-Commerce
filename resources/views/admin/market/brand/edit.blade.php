@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش برند</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">برند</a></li>
            <li class="active font-size-12" aria-current="page">ویرایش برند</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش برند</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.brand.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.market.brand.update', $brand->slug) }}" method="post"
                          enctype="multipart/form-data" id="form">
                        @csrf
                        @method('put')
                        <section class="row">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="persian_name">نام فارسی</label>
                                    <input name="persian_name" id="persian_name" class="form-control form-control-sm"
                                           type="text"
                                           value="{{ old('persian_name', $brand->persian_name) }}">
                                </div>
                                @error('persian_name')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="original_name">نام اصلی</label>
                                    <input name="original_name" id="original_name" class="form-control form-control-sm"
                                           type="text"
                                           value="{{ old('original_name', $brand->original_name) }}">
                                </div>
                                @error('original_name')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="logo">لوگو</label>
                                    <input class="form-control form-control-sm" type="file" name="logo" id="logo">
                                </div>
                                @error('logo')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <section class="row">
                                    @php
                                        $number = 1;
                                    @endphp
                                    @foreach($brand->logo['indexArray'] as $key => $value)
                                        <section class="col-md-{{ 6 / $number }}">
                                            <div class="form-check">
                                                <input type="radio" id="{{ $number }}" class="form-check-input"
                                                       value="{{ $key }}" name="currentImage"
                                                       @if($brand->logo['currentImage'] == $key) checked @endif>
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
                                        <option value="1" @if(old('status', $brand->status) == 1) selected @endif>
                                            فعال
                                        </option>
                                        <option value="0" @if(old('status', $brand->status) == 0) selected @endif>
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
                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="select-tags">برچسب ها</label>
                                    <input class="form-control form-control-sm" type="hidden" name="tags" id="tags"
                                           value="{{ old('tags', $brand->tags) }}">
                                    <select class="select2 form-control form-control-sm" id="select-tags"
                                            multiple></select>
                                </div>
                                @error('tags')
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
