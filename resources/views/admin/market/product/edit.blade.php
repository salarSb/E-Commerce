@extends('admin.layouts.master')
@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
    <title>ویرایش کالا</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">کالاها</a></li>
            <li class="active font-size-12" aria-current="page">ویرایش کالا</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش کالا</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.product.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.market.product.update',$product->slug) }}" method="post" id="form"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <section class="row">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="name">نام کالا</label>
                                    <input id="name" name="name" value="{{ old('name', $product->name) }}"
                                           class="form-control form-control-sm" type="text">
                                </div>
                                @error('name')
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
                                        @foreach($productCategories as $productCategory)
                                            <option value="{{ $productCategory->id }}"
                                                    @if(old('category_id', $product->category_id) == $productCategory->id) selected @endif>
                                                {{ $productCategory->name }}
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
                                    <label for="brand_id">انتخاب برند</label>
                                    <select class="form-control form-control-sm" name="brand_id" id="brand_id">
                                        <option value="">برند را انتخاب کنید</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                    @if(old('brand_id',$product->brand_id) == $brand->id) selected @endif>
                                                {{ $brand->persian_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('brand_id')
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
                                    @foreach($product->image['indexArray'] as $key => $value)
                                        <section class="col-md-{{ 6 / $number }}">
                                            <div class="form-check">
                                                <input type="radio" id="{{ $number }}" class="form-check-input"
                                                       value="{{ $key }}" name="currentImage"
                                                       @if($product->image['currentImage'] == $key) checked @endif>
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
                                    <label for="weight">وزن</label>
                                    <input id="weight" name="weight" value="{{ old('weight', $product->weight) }}"
                                           class="form-control form-control-sm" type="text">
                                </div>
                                @error('weight')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="length">طول</label>
                                    <input id="length" name="length" value="{{ old('length', $product->length) }}"
                                           class="form-control form-control-sm" type="text">
                                </div>
                                @error('length')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="width">عرض</label>
                                    <input id="width" name="width" value="{{ old('width', $product->width) }}"
                                           class="form-control form-control-sm" type="text">
                                </div>
                                @error('width')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="height">ارتفاع</label>
                                    <input id="height" name="height" value="{{ old('height', $product->height) }}"
                                           class="form-control form-control-sm" type="text">
                                </div>
                                @error('height')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="price">قیمت</label>
                                    <input id="price" name="price" value="{{ old('price', $product->price) }}"
                                           class="form-control form-control-sm" type="text">
                                </div>
                                @error('price')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="1" @if(old('status', $product->status) == 1) selected @endif>
                                            فعال
                                        </option>
                                        <option value="0" @if(old('status', $product->status) == 0) selected @endif>غیر
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
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="marketable">قابل فروش</label>
                                    <select name="marketable" id="marketable" class="form-control form-control-sm">
                                        <option value="1"
                                                @if(old('marketable', $product->marketable) == 1) selected @endif>
                                            فعال
                                        </option>
                                        <option value="0"
                                                @if(old('marketable', $product->marketable) == 0) selected @endif>
                                            غیر فعال
                                        </option>
                                    </select>
                                </div>
                                @error('marketable')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="select-tags">برچسب ها</label>
                                    <input class="form-control form-control-sm" type="hidden" name="tags" id="tags"
                                           value="{{ old('tags', $product->tags) }}">
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
                                    <label for="published_at_view">تاریخ انتشار</label>
                                    <input id="published_at" class="form-control form-control-sm d-none" type="text"
                                           name="published_at">
                                    <input id="published_at_view" type="text" class="form-control form-control-sm"
                                           value="{{ old('published_at', $product->published_at) }}">
                                </div>
                                @error('published_at')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="introduction">توضیحات</label>
                                    <textarea class="form-control form-control-sm" rows="6" id="introduction"
                                              name="introduction">{{ old('introduction', $product->introduction) }}</textarea>
                                </div>
                                @error('introduction')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 border-top border-bottom py-3 mb-3">
                                @foreach($product->metas as $meta)
                                    <section class="row">
                                        <section class="col-6 col-md-3">
                                            <div class="form-group">
                                                <input class="form-control form-control-sm" type="text"
                                                       name="meta_key[{{ $meta->id }}]" value="{{ $meta->meta_key }}">
                                            </div>
                                            @error('meta_key.*')
                                            <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </section>
                                        <section class="col-6 col-md-3">
                                            <div class="form-group">
                                                <input class="form-control form-control-sm" type="text"
                                                       name="meta_value[]" value="{{ $meta->meta_value }}">
                                            </div>
                                            @error('meta_value.*')
                                            <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </section>
                                    </section>
                                @endforeach
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
        $(document).ready(function () {
            $("#category_id").select2();
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#brand_id").select2();
        });
    </script>
    <script>
        CKEDITOR.replace('introduction')
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
    <script>
        $(function () {
            $('#btn-copy').on('click', function () {
                let ele = $(this).parent().prev().clone(true);
                $(this).before(ele);
            })
        })
    </script>
@endsection
