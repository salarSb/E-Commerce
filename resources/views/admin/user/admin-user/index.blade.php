@extends('admin.layouts.master')
@section('head-tag')
    <title>کاربران ادمین</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="active font-size-12" aria-current="page">کاربران ادمین</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>کاربران ادمین</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.adminUser.create') }}" class="btn btn-info btn-sm">
                        ایجاد ادمین جدید
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
                            <th>ایمیل</th>
                            <th>شماره موبایل</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>نقش</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs ml-1"></i>تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>1</th>
                            <td>salar@local.com</td>
                            <td>09121112233</td>
                            <td>سالار</td>
                            <td>ثابتی</td>
                            <td>سوپر ادمین</td>
                            <td class="width-22-rem text-left">
                                <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-edit ml-1"></i>نقش</a>
                                <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-edit ml-1"></i>ویرایش</a>
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt ml-1"></i>
                                    حذف
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
