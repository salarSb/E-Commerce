@extends('admin.layouts.master')
@section('head-tag')
    <title>فاکتور سفارش {{ $order->user->fullName }}</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="{{ route('admin.market.order.all') }}">سفارشات</a></li>
            <li class="active font-size-12" aria-current="page">فاکتور سفارش</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>فاکتور سفارش</h5>
                </section>
                <section class="table-responsive">
                    <table class="table table-striped h-150" id="printable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs ml-1"></i>تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="table-primary">
                            <th>{{ $order->id }}</th>
                            <td class="width-8-rem text-left">
                                <a href="#" class="btn btn-dark btn-sm text-white" id="print">
                                    <i class="fa fa-print"></i>
                                    چاپ
                                </a>
                                <a href="{{ route('admin.market.order.detail', $order->id) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fa fa-book"></i>
                                    جزئیات
                                </a>
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>نام مشتری</th>
                            <td class="text-left font-weight-bolder">{{ $order->user->fullName ?? '-' }}</td>
                        </tr>
                        <tr class="border-bottom">
                            <th>آدرس</th>
                            <td class="text-left font-weight-bolder">
                                استان {{ $order->address->city->province->name ?? '-' }}
                                شهر {{ $order->address->city->name ?? '-' }}  {{ $order->address->address ?? '-' }}
                                پلاک {{ $order->address->no ?? '-' }} واحد {{ $order->address->unit ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>کد پستی</th>
                            <td class="text-left font-weight-bolder">{{ $order->address->postal_code ?? '-' }}</td>
                        </tr>
                        <tr class="border-bottom">
                            <th>نام گیرنده</th>
                            <td class="text-left font-weight-bolder">{{ $order->address->recipient_first_name ?? '-' }} {{ $order->address->recipient_last_name ?? '-' }}</td>
                        </tr>
                        <tr class="border-bottom">
                            <th>موبایل گیرنده</th>
                            <td class="text-left font-weight-bolder">{{ $order->address->mobile ?? '-' }}</td>
                        </tr>
                        <tr class="border-bottom">
                            <th>شیوه پرداخت</th>
                            <td class="text-left font-weight-bolder">{{ $order->payment_type_text }}</td>
                        </tr>
                        <tr class="border-bottom">
                            <th>وضعیت پرداخت</th>
                            <td class="text-left font-weight-bolder">{{ $order->payment_status_text }}</td>
                        </tr>
                        @if($order->payment->paymentable->gateway)
                            <tr class="border-bottom">
                                <th>درگاه پرداخت</th>
                                <td class="text-left font-weight-bolder">{{ $order->payment->paymentable->gateway }}</td>
                            </tr>
                        @endif
                        <tr class="border-bottom">
                            <th>مبلغ ارسال</th>
                            <td class="text-left font-weight-bolder">{{ $order->delivery_amount }}</td>
                        </tr>
                        <tr class="border-bottom">
                            <th>وضعیت ارسال</th>
                            <td class="text-left font-weight-bolder">{{ $order->delivery_status_text }}</td>
                        </tr>
                        <tr class="border-bottom">
                            <th>تاریخ ارسال</th>
                            <td class="text-left font-weight-bolder">{{ jalaliDate($order->delivery_date) }}</td>
                        </tr>
                        <tr class="border-bottom">
                            <th>مجموع مبلغ سفارش (بدون تخفیف)</th>
                            <td class="text-left font-weight-bolder">{{ $order->order_final_amount }} تومان</td>
                        </tr>
                        <tr class="border-bottom">
                            <th>مجموع تمامی مبلغ تخفیفات</th>
                            <td class="text-left font-weight-bolder">{{ $order->order_discount_amount }} تومان</td>
                        </tr>
                        <tr class="border-bottom">
                            <th>مبلغ تخفیف همه محصولات</th>
                            <td class="text-left font-weight-bolder">{{ $order->order_total_products_discount_amount }}
                                تومان
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>مبلغ نهایی</th>
                            <td class="text-left font-weight-bolder">{{ $order->order_final_amount - $order->order_discount_amount }}
                                تومان
                            </td>
                        </tr>
                        @if($order->coupon_id)
                            <tr class="border-bottom">
                                <th>کوپن استفاده شده</th>
                                <td class="text-left font-weight-bolder">{{ $order->coupon->code }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th>تخفیف کوپن استفاده شده</th>
                                <td class="text-left font-weight-bolder">{{ $order->order_coupon_discount_amount }}</td>
                            </tr>
                        @endif
                        @if($order->common_discount_id)
                            <tr class="border-bottom">
                                <th>تخفیف عمومی استفاده شده</th>
                                <td class="text-left font-weight-bolder">{{ $order->commonDiscount->title }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <th>مبلغ تخفیف عمومی استفاده شده</th>
                                <td class="text-left font-weight-bolder">{{ $order->order_common_discount_amount }}</td>
                            </tr>
                        @endif
                        <tr class="border-bottom">
                            <th>وضعیت سفارش</th>
                            <td class="text-left font-weight-bolder">{{ $order->order_status_text }}</td>
                        </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>
@endsection
@section('script')
    <script>
        var printBtn = document.getElementById('print');
        printBtn.addEventListener('click', function () {
            printContent('printable');
        });

        function printContent(el) {
            var restorePage = $('body').html();
            var printContent = $('#' + el).clone();
            $('body').empty().html(printContent);
            window.print();
            $('body').html(restorePage);
        }
    </script>
@endsection
