@extends('admin.layouts.master')
@section('head-tag')
    <title>دسته بندی</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوا</a></li>
            <li class="active font-size-12" aria-current="page">دسته بندی</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>دسته بندی</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.category.create') }}" class="btn btn-info btn-sm">
                        ایجاد دسته بندی
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
                            <th>نام دسته</th>
                            <th>دسته والد</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs ml-1"></i>تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>1</th>
                            <td>نمایشگر</td>
                            <td>کالای الکترونیکی</td>
                            <td class="width-16-rem text-left">
                                <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-edit ml-1"></i>ویرایش</a>
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt ml-1"></i>
                                    حذف
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th>2</th>
                            <td>موبایل</td>
                            <td>کالای الکترونیکی</td>
                            <td class="width-16-rem text-left">
                                <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-edit ml-1"></i>ویرایش</a>
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt ml-1"></i>
                                    حذف
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th>3</th>
                            <td>لوازم جانبی</td>
                            <td>کالای الکترونیکی</td>
                            <td class="width-16-rem text-left">
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
