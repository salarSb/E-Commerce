@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش موجودی</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">انبار</a></li>
            <li class="active font-size-12" aria-current="page">ویرایش موجودی</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش موجودی</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.store.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.market.store.update',$product->slug) }}" method="post">
                        @csrf
                        @method('put')
                        <section class="row">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="marketable_number">تعداد قابل فروش</label>
                                    <input id="marketable_number" name="marketable_number"
                                           class="form-control form-control-sm"
                                           type="text" value="{{ old('marletable_number', $product->marketable_number) }}">
                                </div>
                                @error('marketable_number')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="sold_number"> تعداد فروحته شده</label>
                                    <input id="sold_number" name="sold_number"
                                           class="form-control form-control-sm"
                                           type="text" value="{{ old('sold_number',$product->sold_number) }}">
                                </div>
                                @error('sold_number')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="frozen_number">تعداد رزرو شده</label>
                                    <input id="frozen_number" name="frozen_number"
                                           class="form-control form-control-sm"
                                           type="text" value="{{ old('frozen_number',$product->frozen_number) }}">
                                </div>
                                @error('frozen_number')
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
