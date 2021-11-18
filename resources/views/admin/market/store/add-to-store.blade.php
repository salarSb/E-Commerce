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
                    <form action="" method="">
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>نام تحویل گیرنده</label>
                                    <input class="form-control form-control-sm" type="text">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>نام تحویل دهنده</label>
                                    <input class="form-control form-control-sm" type="text">
                                </div>
                            </section>
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>تعداد</label>
                                    <input class="form-control form-control-sm" type="text">
                                </div>
                            </section>
                            <section class="col-12">
                                <div class="form-group">
                                    <label>توضیحات</label>
                                    <textarea class="form-control form-control-sm" rows="4"></textarea>
                                </div>
                            </section>
                        </section>
                        <button class="btn btn-sm btn-primary">ثبت</button>
                    </form>
                </section>
            </section>
        </section>
    </section>
@endsection
