@extends('admin.layouts.master')
@section('head-tag')
    <title>نظرات</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="active font-size-12" aria-current="page">نظرات</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>نظرات</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="#" class="btn btn-info btn-sm disabled">
                        ایجاد نظر
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
                            <th>کد کاربر</th>
                            <th>نویسنده نظر</th>
                            <th>کد کالا</th>
                            <th>کالا</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs ml-1"></i>تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>1</th>
                            <td>21312</td>
                            <td>سالار ثابتی</td>
                            <td>231</td>
                            <td>آیفون 12</td>
                            <td>در انتظار تایید</td>
                            <td class="width-16-rem text-left">
                                <a href="{{ route('admin.market.comment.show') }}" class="btn btn-sm btn-info mb-1">
                                    <i class="fa fa-eye ml-1"></i>نمایش
                                </a>
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check ml-1"></i>
                                    تایید
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th>2</th>
                            <td>21312</td>
                            <td>سالار ثابتی</td>
                            <td>231</td>
                            <td>آیفون 12</td>
                            <td>تایید شده</td>
                            <td class="width-16-rem text-left">
                                <a href="{{ route('admin.market.comment.show') }}" class="btn btn-sm btn-info mb-1">
                                    <i class="fa fa-eye ml-1"></i>نمایش
                                </a>
                                <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-clock ml-1"></i>
                                    عدم تایید
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
