@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش مقدار فرم کالا</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">فرم کالا</a></li>
            <li class="active font-size-12" aria-current="page">ویرایش مقدار فرم کالا</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش مقدار فرم کالا</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.property.value.index', $categoryAttribute->id) }}"
                       class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form
                        action="{{ route('admin.market.property.value.update', ['categoryAttribute'=>$categoryAttribute->id,'value'=>$value->id]) }}"
                        method="post">
                        @csrf
                        @method('put')
                        <section class="row">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="product_id">انتخاب محصول</label>
                                    <select class="form-control form-control-sm" name="product_id" id="product_id">
                                        <option value="">محصول را انتخاب کنید</option>
                                        @foreach($categoryAttribute->category->products as $product)
                                            <option value="{{ $product->id }}"
                                                    @if(old('product_id',$value->product_id) == $product->id) selected @endif>
                                                {{ $product->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('product_id')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="value">مقدار</label>
                                    <input id="value" name="value"
                                           value="{{ old('value', json_decode($value->value)->value) }}"
                                           class="form-control form-control-sm" type="text">
                                </div>
                                @error('value')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="price_increase">افزایش قیمت</label>
                                    <input id="price_increase" name="price_increase"
                                           value="{{ old('price_increase', json_decode($value->value)->price_increase) }}"
                                           class="form-control form-control-sm" type="text">
                                </div>
                                @error('price_increase')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="type">نوع</label>
                                    <select name="type" id="type" class="form-control form-control-sm">
                                        <option value="0" @if(old('type', $value->type) == 0) selected @endif>ساده
                                        </option>
                                        <option value="1" @if(old('type', $value->type) == 1) selected @endif>انتخابی
                                        </option>
                                    </select>
                                </div>
                                @error('type')
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
