@extends('admin.layouts.master')
@section('head-tag')
    <title>پرداخت ها</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="active font-size-12" aria-current="page">پرداخت ها</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>پرداخت ها</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="#" class="btn btn-info btn-sm disabled">
                        ایجاد پرداخت
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
                            <th>کد تراکنش</th>
                            <th>بانک</th>
                            <th>پرداخت کننده</th>
                            <th>وضعیت پرداخت</th>
                            <th>نوع پرداخت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs ml-1"></i>تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $payment->paymentable->transaction_id ?? '-' }}</td>
                                <td>{{ $payment->paymentable->gateway ?? '-' }}</td>
                                <td>{{ $payment->user->fullName }}</td>
                                <td>
                                    @if($payment->status == 0)
                                        پرداخت نشده
                                    @elseif($payment->status == 1)
                                        پرداخت شده
                                    @elseif($payment->status == 2)
                                        باطل شده
                                    @else
                                        برگشت داده شده
                                    @endif
                                </td>
                                <td>
                                    @if($payment->type == 0)
                                        آنلاین
                                    @elseif($payment->type == 1)
                                        آفلاین
                                    @else
                                        در محل
                                    @endif
                                </td>
                                <td class="width-22-rem text-left">
                                    <a href="{{ route('admin.market.payment.show',$payment->id) }}"
                                       class="btn btn-sm btn-info mb-1"><i class="fa fa-edit ml-1"></i>
                                        مشاهده
                                    </a>
                                    <a href="{{ route('admin.market.payment.canceled',$payment->id) }}"
                                       class="btn btn-sm btn-warning mb-1"><i
                                            class="fa fa-window-close ml-1"></i>
                                        باطل کردن
                                    </a>
                                    <a href="{{ route('admin.market.payment.returned',$payment->id) }}"
                                       class="btn btn-sm btn-danger"><i class="fa fa-reply ml-1"></i>
                                        برگرداندن
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>
@endsection
