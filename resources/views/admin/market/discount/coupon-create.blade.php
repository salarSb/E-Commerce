@extends('admin.layouts.master')
@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
    <title>ایجاد کوپن تخفیف</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">کوپن تخفیف</a></li>
            <li class="active font-size-12" aria-current="page">ایجاد کوپن تخفیف</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ایجاد کوپن تخفیف</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.discount.coupon.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.market.discount.coupon.store') }}" method="post">
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="code">کد کوپن</label>
                                    <input name="code" id="code" class="form-control form-control-sm"
                                           type="text"
                                           value="{{ old('code') }}">
                                </div>
                                @error('code')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="type">نوع کوپن</label>
                                    <select class="form-control form-control-sm" name="type" id="type">
                                        <option value="0" @if(old('type') == 0) selected @endif>عمومی</option>
                                        <option value="1" @if(old('type') == 1) selected @endif>خصوصی</option>
                                    </select>
                                </div>
                                @error('type')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="user_id">انتخاب کاربر</label>
                                    <select class="form-control form-control-sm" name="user_id" id="user_id"
                                            @if(old('type') == 0) disabled @endif>
                                        <option value="">کاربر را انتخاب کنید</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}"
                                                    @if(old('user_id') == $user->id) selected @endif>
                                                {{ $user->fullName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('user_id')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="amount_type">نوع تخفیف</label>
                                    <select class="form-control form-control-sm" name="amount_type" id="amount_type">
                                        <option value="0" @if(old('amount_type') == 0) selected @endif>درصدی</option>
                                        <option value="1" @if(old('amount_type') == 1) selected @endif>مبلغی</option>
                                    </select>
                                </div>
                                @error('amount_type')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="amount">میزان تخفیف</label>
                                    <input name="amount" id="amount" class="form-control form-control-sm"
                                           type="text"
                                           value="{{ old('amount') }}">
                                </div>
                                @error('amount')
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
                                           value="{{ old('discount_ceiling') }}">
                                </div>
                                @error('discount_ceiling')
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
                            <section class="col-12">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="1" @if(old('status') == 1) selected @endif>فعال</option>
                                        <option value="0" @if(old('status') == 0) selected @endif>غیر فعال</option>
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
            $("#user_id").select2();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#type').change(function () {
                if ($('#type').find(':selected').val() == 1) {
                    $('#user_id').removeAttr('disabled');
                } else {
                    $('#user_id').attr('disabled', 'disabled');
                }
            });
        });
    </script>
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
