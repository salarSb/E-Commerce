@extends('admin.layouts.master')
@section('head-tag')
    <title>کالاها</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="active font-size-12" aria-current="page">کالاها</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>کالاها</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.product.create') }}" class="btn btn-info btn-sm">
                        ایجاد کالای جدید
                    </a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" class="form-control form-control-sm form-text">
                    </div>
                </section>
                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام کالا</th>
                            <th>تصویر کالا</th>
                            <th>قیمت</th>
                            <th>وزن کالا</th>
                            <th>دسته</th>
                            <th>فرم</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs ml-1"></i>تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>1</th>
                            <td>گوشی آیفون 12</td>
                            <td>
                                <img src="{{ asset('admin-assets/images/avatar-2.jpg') }}" alt="product image"
                                     class="max-height-2rem">
                            </td>
                            <td>12.000.000 تومان</td>
                            <td>1 کیلوگرم</td>
                            <td>کالای الکترونیکی</td>
                            <td>موبایل</td>
                            <td class="width-16-rem text-left">
                                <div class="dropdown">
                                    <a href="#" class="btn btn-success btn-sm btn-block dropdown-toggle" role="button"
                                       id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-tools"></i>
                                        عملیات
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a href="#" class="dropdown-item text-right">
                                            <i class="fa fa-images"></i>
                                            گالری
                                        </a>
                                        <a href="#" class="dropdown-item text-right">
                                            <i class="fa fa-list-ul"></i>
                                            فرم کالا
                                        </a>
                                        <a href="#" class="dropdown-item text-right">
                                            <i class="fa fa-edit"></i>
                                            ویرایش
                                        </a>
                                        <form action="" method="post">
                                            <button type="submit" class="dropdown-item text-right">
                                                <i class="fa fa-window-close"></i>
                                                حذف
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>
@endsection
