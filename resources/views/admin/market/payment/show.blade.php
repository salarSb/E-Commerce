@extends('admin.layouts.master')
@section('head-tag')
    <title>نمایش پرداخت</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">پرداخت ها</a></li>
            <li class="active font-size-12" aria-current="page">نمایش پرداخت</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>نمایش پرداخت</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.payment.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section class="card mb-3">
                    <section class="card-header text-white bg-custom-yellow">
                        نام پرداخت کننده : {{ $payment->user->full_name }} - شناسه کاربری پرداخت کننده
                        : {{ $payment->user->id }}
                    </section>
                    <section class="card-body">
                        <h5 class="card-title">مبلغ :
                            {{ $payment->paymentable->amount }}
                        </h5>
                        @if($payment->type === 0)
                            <p class="card-text">
                                درگاه :
                                {{ $payment->paymentable->gateway }}
                            </p>
                            <p class="card-text">
                                پاسخ اول بانک :
                                {{ $payment->paymentable->bank_first_response }}
                            </p>
                            <p class="card-text">
                                پاسخ دوم بانک :
                                {{ $payment->paymentable->bank_second_response }}
                            </p>
                        @endif
                        @if($payment->type === 0 || $payment->type === 1)
                            <p class="card-text">
                                شماره پرداخت :
                                {{ $payment->paymentable->transaction_id }}
                            </p>
                        @endif
                        @if($payment->type === 1 || $payment->type===2)
                            <p class="card-text">
                                تاریخ پرداخت :
                                {{ jalaliDate($payment->paymentable->pay_date) ?? '-' }}
                            </p>
                        @else
                            <p class="card-text">
                                تاریخ پرداخت :
                                {{ jalaliDate($payment->paymentable->created_at) ?? '-' }}
                            </p>
                        @endif
                        @if($payment->status == 0)
                            <p class="card-text">
                                وضعیت پرداخت : پرداخت نشده
                            </p>
                        @elseif($payment->status == 1)
                            <p class="card-text">
                                وضعیت پرداخت : پرداخت شده
                            </p>
                        @elseif($payment->status == 2)
                            <p class="card-text">
                                وضعیت پرداخت : باطل شده
                            </p>
                        @else
                            <p class="card-text">
                                وضعیت پرداخت : برگشت داده شده
                            </p>
                        @endif
                        @if($payment->type === 2)
                            <p class="card-text">
                                دریافت کننده :
                                {{ $payment->paymentable->cash_receiver}}
                            </p>
                        @endif
                    </section>
                </section>
            </section>
        </section>
    </section>
@endsection
