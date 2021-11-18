@extends('admin.layouts.master')
@section('head-tag')
    <title>انبار</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="active font-size-12" aria-current="page">انبار</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>انبار</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="#" class="btn btn-info btn-sm disabled">
                        ایجاد انبار جدید
                    </a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" class="form-control form-control-sm form-text">
                    </div>
                </section>
                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام کالا</th>
                            <th>تصویر کالا</th>
                            <th>موجودی</th>
                            <th>ورودی انبار</th>
                            <th>خروجی انبار</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs ml-1"></i>تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>1</th>
                            <td>سامسونگ LED</td>
                            <td>
                                <img src="{{ asset('admin-assets/images/avatar-2.jpg') }}" alt="product image"
                                     class="max-height-2rem">
                            </td>
                            <td>16</td>
                            <td>38</td>
                            <td>22</td>
                            <td class="width-16-rem-rem text-left">
                                <a href="{{ route('admin.market.store.addToStore') }}"
                                   class="btn btn-sm btn-primary mb-1">
                                    <i class="fa fa-edit ml-1"></i>
                                    افزایش موجودی
                                </a>
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="fa fa-trash-alt ml-1"></i>
                                    اصلاح موجودی
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>
@endsection
