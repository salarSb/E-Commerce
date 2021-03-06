@extends('admin.layouts.master')
@section('head-tag')
    <title>اضافه کردن به انبار</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">انبار</a></li>
            <li class="active font-size-12" aria-current="page">اضافه کردن به انبار</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>اضافه کردن به انبار</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.store.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.market.store.store',$product->slug) }}" method="post">
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="receiver">نام تحویل گیرنده</label>
                                    <input id="receiver" name="receiver" class="form-control form-control-sm"
                                           type="text" value="{{ old('receiver') }}">
                                </div>
                                @error('receiver')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="deliverer">نام تحویل دهنده</label>
                                    <input id="deliverer" name="deliverer" class="form-control form-control-sm"
                                           type="text" value="{{ old('deliverer') }}">
                                </div>
                                @error('deliverer')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="marketable_number">تعداد</label>
                                    <input id="marketable_number" name="marketable_number"
                                           class="form-control form-control-sm"
                                           type="text" value="{{ old('marletable_number') }}">
                                </div>
                                @error('marketable_number')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="description">توضیحات</label>
                                    <textarea class="form-control form-control-sm" rows="6" id="description"
                                              name="description">{{ old('description') }}</textarea>
                                </div>
                                @error('description')
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
