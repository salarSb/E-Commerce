@extends('customer.layouts.master-two-col')
@section('head-tag')
    <title>سفارشات خرید شما</title>
@endsection
@section('content')
    <section id="main-body-two-col" class="container-xxl body-container">
        <section class="row">
                @include('customer.layouts.partials.profile-sidebar')
            <main id="main-body" class="main-body col-md-9">
                <section class="content-wrapper bg-white p-3 rounded-2 mb-2">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>تاریخچه سفارشات</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>
                    <!-- end vontent header -->
                    <section class="d-flex justify-content-center my-4">
                        <a class="btn btn-outline-success btn-sm mx-1"
                           href="{{ route('profile.order') }}">
                            همه
                        </a>
                        <a class="btn btn-primary btn-sm mx-1"
                           href="{{ route('profile.order','type=0') }}">
                            بررسی نشده
                        </a>
                        <a class="btn btn-outline-danger btn-sm mx-1"
                           href="{{ route('profile.order','type=1') }}">
                            در انتظار تایید
                        </a>
                        <a class="btn btn-warning btn-sm mx-1"
                           href="{{ route('profile.order','type=2') }}">
                            تاییده نشده
                        </a>
                        <a class="btn btn-outline-info btn-sm mx-1"
                           href="{{ route('profile.order','type=3') }}">
                            تایید شده
                        </a>
                        <a class="btn btn-danger btn-sm mx-1"
                           href="{{ route('profile.order','type=4') }}">
                            باطل شده
                        </a>
                        <a class="btn btn-outline-primary btn-sm mx-1"
                           href="{{ route('profile.order','type=5') }}">
                            مرجوع شده
                        </a>
                    </section>
                    <!-- start content header -->
                    <section class="content-header mb-3">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title content-header-title-small">
                                در انتظار پرداخت
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>
                    <!-- end content header -->
                    <section class="order-wrapper">
                        @forelse ($orders as $order)
                            <section class="order-item">
                                <section class="d-flex justify-content-between">
                                    <section>
                                        <section class="order-item-date"><i class="fa fa-calendar-alt"></i>
                                            {{ jdate($order->created_at) }}
                                        </section>
                                        <section class="order-item-id"><i class="fa fa-id-card-alt"></i>
                                            کد سفارش : {{ $order->id }}
                                        </section>
                                        <section class="order-item-status"><i class="fa fa-clock"></i>
                                            {{ $order->paymentStatusText }}
                                        </section>
                                        <section class="order-item-products">
                                            @foreach ($order->orderItems as $orderItem)
                                                <a href="#"><img
                                                        src="{{ asset($orderItem->singleProduct->image['indexArray']['small']) }}"
                                                        alt=""></a>
                                            @endforeach
                                        </section>
                                    </section>
                                    <section class="order-item-link"><a href="#">پرداخت سفارش</a></section>
                                </section>
                            </section>
                        @empty
                            <section class="order-item">
                                <section class="d-flex justify-content-between">
                                    <p>سفارشی یافت نشد</p>
                                </section>
                            </section>
                        @endforelse
                    </section>
                </section>
            </main>
        </section>
    </section>
@endsection
