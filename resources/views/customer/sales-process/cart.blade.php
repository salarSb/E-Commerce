@extends('customer.layouts.master-two-col')
@section('head-tag')
    <title>سبد خرید شما</title>
@endsection
@section('content')
    <!-- start cart -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>سبد خرید شما</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">
                        <section class="col-md-9 mb-3">
                            <form id="cart-items" method="post" class="content-wrapper bg-white p-3 rounded-2">
                                @csrf
                                @php
                                    $totalProductPrice = 0;
                                    $totalDiscount = 0;
                                @endphp
                                @foreach($cartItems as $cartItem)
                                    @php
                                        $totalProductPrice += $cartItem->product_price;
                                        $totalDiscount += $cartItem->product_discount;
                                    @endphp
                                    <section class="cart-item d-md-flex py-3">
                                        <section class="cart-img align-self-start flex-shrink-1"><img
                                                src="{{ asset($cartItem->product->image['indexArray']['medium']) }}"
                                                alt="{{ $cartItem->product->name }}"></section>
                                        <section class="align-self-start w-100">
                                            <p class="fw-bold">{{ $cartItem->product->name }}</p>
                                            @if(!empty($cartItem->color))
                                                <p><span style="background-color: {{ $cartItem->color->color }};"
                                                         class="cart-product-selected-color me-1"></span>
                                                    <span>{{ $cartItem->color->name }}</span></p>
                                            @endif
                                            @if(!empty($cartItem->guarantee))
                                                <p><i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i>
                                                    <span>{{ $cartItem->guarantee->name }}</span></p>
                                            @endif
                                            <p><i class="fa fa-store-alt cart-product-selected-store me-1"></i> <span>کالا موجود در انبار</span>
                                            </p>
                                            <section>
                                                <section class="cart-product-number d-inline-block ">
                                                    <button class="cart-number cart-number-down" type="button">-
                                                    </button>
                                                    <input class="number" name="number[{{ $cartItem->id }}]"
                                                           data-product-price="{{ $cartItem->product_price }}"
                                                           data-product-discount="{{ $cartItem->product_discount }}"
                                                           type="number" min="1" max="5" step="1"
                                                           value="{{ $cartItem->number }}"
                                                           readonly="readonly">
                                                    <button class="cart-number cart-number-up" type="button">+</button>
                                                </section>
                                                <a class="text-decoration-none ms-4 cart-delete"
                                                   href="{{ route('customer.sales-process.removeFromCart', $cartItem->id) }}">
                                                    <i class="fa fa-trash-alt"></i>
                                                    حذف از سبد
                                                </a>
                                            </section>
                                        </section>
                                        <section class="align-self-end flex-shrink-1">
                                            @php
                                                $amazingSale = $cartItem->product->amazingSales()->validAmazingSales()->first();
                                            @endphp
                                            @if(!empty($amazingSale))
                                                <section class="cart-item-discount text-danger text-nowrap mb-1">تخفیف
                                                    {{ priceFormat($cartItem->product_discount) }}
                                                </section>
                                            @endif
                                            <section
                                                class="text-nowrap fw-bold">{{ priceFormat($cartItem->product_price) }}
                                                تومان
                                            </section>
                                        </section>
                                    </section>
                                @endforeach
                            </form>
                        </section>
                        <section class="col-md-3">
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">قیمت کالاها ({{ $cartItems->count() }})</p>
                                    <p class="text-muted" id="total-product-price">{{ priceFormat($totalProductPrice) }}
                                        تومان</p>
                                </section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">تخفیف کالاها</p>
                                    <p class="text-danger fw-bolder"
                                       id="total-discount">{{ priceFormat($totalDiscount) }} تومان</p>
                                </section>
                                <section class="border-bottom mb-3"></section>
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">جمع سبد خرید</p>
                                    <p class="fw-bolder"
                                       id="total-price">{{ priceFormat($totalProductPrice - $totalDiscount) }}
                                        تومان
                                    </p>
                                </section>

                                <p class="my-3">
                                    <i class="fa fa-info-circle me-1"></i>کاربر گرامی خرید شما هنوز نهایی نشده است. برای
                                    ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب
                                    کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت
                                    پرداخت این سفارش صورت میگیرد.
                                </p>


                                <section class="">
                                    <button onclick="document.getElementById('cart-items').submit();"
                                            class="btn btn-danger d-block w-100">
                                        تکمیل فرآیند خرید
                                    </button>
                                </section>

                            </section>
                        </section>
                    </section>
                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->

    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>کالاهای مرتبط با سبد خرید شما</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper">
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">
                                @foreach($relatedProducts as $relatedProduct)
                                    <section class="item">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">
                                                <section class="product-add-to-cart">
                                                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="left"
                                                       title="افزودن به سبد خرید">
                                                        <i class="fa fa-cart-plus"></i>
                                                    </a>
                                                </section>
                                                @guest
                                                    <section class="product-add-to-favorite">
                                                        <button
                                                            class="btn btn-light btn-sm text-decoration-none"
                                                            type="button"
                                                            data-url="{{ route('customer.market.add-to-favorite', $relatedProduct->slug) }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="افزودن به علاقه مندی">
                                                            <i class="fa fa-heart"></i>
                                                        </button>
                                                    </section>
                                                @endguest
                                                @auth
                                                    @if($relatedProduct->users->contains('id', auth()->user()->id))
                                                        <section class="product-add-to-favorite">
                                                            <button
                                                                class="btn btn-light btn-sm text-decoration-none"
                                                                type="button"
                                                                data-url="{{ route('customer.market.add-to-favorite', $relatedProduct->slug) }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="left"
                                                                title="حذف از علاقه مندی">
                                                                <i class="fa fa-heart text-danger"></i>
                                                            </button>
                                                        </section>
                                                    @else
                                                        <section class="product-add-to-favorite">
                                                            <button
                                                                class="btn btn-light btn-sm text-decoration-none"
                                                                type="button"
                                                                data-url="{{ route('customer.market.add-to-favorite', $relatedProduct->slug) }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="left"
                                                                title="افزودن به علاقه مندی">
                                                                <i class="fa fa-heart"></i>
                                                            </button>
                                                        </section>
                                                    @endif
                                                @endauth
                                                <a class="product-link"
                                                   href="{{ route('customer.market.product', $relatedProduct->slug) }}">
                                                    <section class="product-image">
                                                        <img class=""
                                                             src="{{ asset($relatedProduct->image['indexArray']['medium']) }}"
                                                             alt="{{ $relatedProduct->name }}">
                                                    </section>
                                                    <section class="product-name">
                                                        <h3>{{ $relatedProduct->name }}</h3>
                                                    </section>
                                                    <section class="product-price-wrapper">
                                                        @php
                                                            $relatedProductAmazingSale = $relatedProduct->amazingSales()->validAmazingSales()->first();
                                                        @endphp
                                                        @if(!empty($relatedProductAmazingSale))
                                                            <section class="product-price-wrapper">
                                                                <section class="product-discount">
                                                                    <span
                                                                        class="product-old-price">{{ priceFormat($relatedProduct->price) }}</span>
                                                                    <span
                                                                        class="product-discount-amount">{{ $relatedProductAmazingSale->percentage }}%</span>
                                                                </section>
                                                                <section
                                                                    class="product-price">{{ priceFormat($relatedProduct->price - $relatedProduct->price * ($relatedProductAmazingSale->percentage / 100)) }}
                                                                    تومان
                                                                </section>
                                                            </section>
                                                        @else
                                                            <section
                                                                class="product-price">{{ priceFormat($relatedProduct->price) }}
                                                                تومان
                                                            </section>
                                                        @endif
                                                    </section>
                                                    <section class="product-colors">
                                                        @foreach($relatedProduct->colors as $color)
                                                            <section class="product-colors-item"
                                                                     style="background-color: {{ $color->color }};"></section>
                                                        @endforeach
                                                    </section>
                                                </a>
                                            </section>
                                        </section>
                                    </section>
                                @endforeach
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            bill();
            $('.cart-number').click(function () {
                bill();
            });
        });

        function bill() {
            let totalProductPrice = 0;
            let totalDiscount = 0;
            let totalPrice = 0;
            $('.number').each(function () {
                let productPrice = parseFloat($(this).data('product-price'));
                let productDiscount = parseFloat($(this).data('product-discount'));
                let number = parseFloat($(this).val());
                totalProductPrice += number * productPrice;
                totalDiscount += number * productDiscount;
            });
            totalPrice = totalProductPrice - totalDiscount;
            $('#total-product-price').html(toFarsiNumber(totalProductPrice));
            $('#total-discount').html(toFarsiNumber(totalDiscount));
            $('#total-price').html(toFarsiNumber(totalPrice));

            function toFarsiNumber(number) {
                const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
                // add comma
                number = new Intl.NumberFormat().format(number);
                //convert to persian
                return number.toString().replace(/\d/g, x => farsiDigits[x]);
            }
        }
    </script>
    <script>
        $('.product-add-to-favorite button').click(function () {
            const url = $(this).attr('data-url');
            const element = $(this);
            $.ajax({
                url: url,
                success: function (result) {
                    if (result.status == 1) {
                        $(element).children().first().addClass('text-danger');
                        $(element).attr('data-bs-original-title', 'حذف از علاقه مندی');
                    } else if (result.status == 2) {
                        $(element).children().first().removeClass('text-danger');
                        $(element).attr('data-bs-original-title', 'افزودن به علاقه مندی');
                    } else {
                        $('.toast').toast('show');
                    }
                }
            });
        });
    </script>
@endpush
