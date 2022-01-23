@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش روش ارسال</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">روش های ارسال</a></li>
            <li class="active font-size-12" aria-current="page">ویرایش روش ارسال</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش روش ارسال</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.delivery.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.market.delivery.update', $delivery->id) }}" method="post">
                        @csrf
                        @method('put')
                        <section class="row">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="name">نام روش ارسال</label>
                                    <input name="name" id="name" class="form-control form-control-sm" type="text"
                                           value="{{ old('name', $delivery->name) }}">
                                </div>
                                @error('name')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="amount">هزینه روش ارسال</label>
                                    <input name="amount" id="amount" class="form-control form-control-sm" type="text"
                                           value="{{ old('amount', $delivery->amount) }}">
                                </div>
                                @error('amount')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="delivery_time">زمان ارسال</label>
                                    <input name="delivery_time" id="delivery_time" class="form-control form-control-sm"
                                           type="text" value="{{ old('delivery_time', $delivery->delivery_time) }}">
                                </div>
                                @error('delivery_time')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="delivery_time_unit">واحد زمان ارسال</label>
                                    <input name="delivery_time_unit" id="delivery_time_unit"
                                           class="form-control form-control-sm" type="text"
                                           value="{{ old('delivery_time_unit', $delivery->delivery_time_unit) }}">
                                </div>
                                @error('delivery_time_unit')
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
