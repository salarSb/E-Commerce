@extends('admin.layouts.master')
@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
    <title>ویرایش تخفیف عمومی</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">تخفیف عمومی</a></li>
            <li class="active font-size-12" aria-current="page">ویرایش تخفیف عمومی</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش تخفیف عمومی</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.discount.commonDiscount.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.market.discount.commonDiscount.update', $commonDiscount->id) }}"
                          method="post">
                        @csrf
                        @method('put')
                        <section class="row">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="percentage">درصد تخفیف</label>
                                    <input name="percentage" id="percentage" class="form-control form-control-sm"
                                           type="text"
                                           value="{{ old('percentage', $commonDiscount->percentage) }}">
                                </div>
                                @error('percentage')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="discount_ceiling">حداکثر تخفیف</label>
                                    <input name="discount_ceiling" id="discount_ceiling"
                                           class="form-control form-control-sm" type="text"
                                           value="{{ old('discount_ceiling', $commonDiscount->discount_ceiling) }}">
                                </div>
                                @error('discount_ceiling')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="minimal_order_amount">حداقل مبلغ خرید</label>
                                    <input name="minimal_order_amount" id="minimal_order_amount"
                                           class="form-control form-control-sm" type="text"
                                           value="{{ old('minimal_order_amount', $commonDiscount->minimal_order_amount) }}">
                                </div>
                                @error('minimal_order_amount')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="title">عنوان مناسبت</label>
                                    <input name="title" id="title" class="form-control form-control-sm" type="text"
                                           value="{{ old('title', $commonDiscount->title) }}">
                                </div>
                                @error('title')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="start_date_view">تاریخ شروع</label>
                                    <input id="start_date" class="form-control form-control-sm d-none" type="text"
                                           name="start_date">
                                    <input id="start_date_view" type="text" class="form-control form-control-sm">
                                </div>
                                @error('start_date')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="end_date_view">تاریخ پایان</label>
                                    <input id="end_date" class="form-control form-control-sm d-none" type="text"
                                           name="end_date">
                                    <input id="end_date_view" type="text" class="form-control form-control-sm">
                                </div>
                                @error('end_date')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="1"
                                                @if(old('status', $commonDiscount->status) == 1) selected @endif>
                                            فعال
                                        </option>
                                        <option value="0"
                                                @if(old('status', $commonDiscount->status) == 0) selected @endif>
                                            غیر فعال
                                        </option>
                                    </select>
                                </div>
                                @error('status')
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
@section('script')
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#start_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#start_date'
            })
            $('#end_date_view').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#end_date'
            })
        })
    </script>
@endsection
