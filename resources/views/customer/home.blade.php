@extends('customer.layouts.master-one-col')
@section('head-tag')
    <title>فروشگاه آمازون</title>
@endsection
@section('content')
    <!-- start slideshow -->
    <section class="container-xxl my-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('danger'))
            <div class="alert alert-danger">
                {{ session('danger') }}
            </div>
        @endif
        <section class="row">
            <section class="col-md-8 pe-md-1 ">
                <section id="slideshow" class="owl-carousel owl-theme">
                    @foreach($slideShowImages as $slideShowImage)
                        <section class="item">
                            <a class="w-100 d-block h-auto text-decoration-none"
                               href="{{ urldecode($slideShowImage->url) }}">
                                <img class="w-100 rounded-2 d-block h-auto" src="{{ asset($slideShowImage->image) }}"
                                     alt="{{ $slideShowImage->title }}">
                            </a>
                        </section>
                    @endforeach
                </section>
            </section>
            <section class="col-md-4 ps-md-1 mt-2 mt-md-0">
                @foreach($topBanners as $topBanner)
                    <section class="mb-2">
                        <a href="{{ urldecode($topBanner->url) }}" class="d-block">
                            <img class="w-100 rounded-2" src="{{ asset($topBanner->image) }}"
                                 alt="{{ $topBanner->title }}">
                        </a>
                    </section>
                @endforeach
            </section>
        </section>
    </section>
    <!-- end slideshow -->

    <!-- start product lazy load -->
    <section class="mb-3">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>پربازدیدترین کالاها</span>
                                </h2>
                                <section class="content-header-link">
                                    <a href="#">مشاهده همه</a>
                                </section>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper">
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">
                                @foreach($mostVisitedProducts as $mostVisitedProduct)
                                    <section class="item">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">
                                                <section class="product-add-to-cart">
                                                    <form
                                                        action="{{ route('customer.sales-process.add-to-cart', ['product' => $mostVisitedProduct->slug, 'number'=> 1]) }}"
                                                        method="post"
                                                        id="most-visited-product-form-{{$mostVisitedProduct->id}}">
                                                        @csrf
                                                        <button class="btn btn-light btn-sm text-decoration-none"
                                                                data-bs-toggle="tooltip" data-bs-placement="left"
                                                                type="button"
                                                                title="افزودن به سبد خرید"
                                                                @if(!$mostVisitedProduct->marketable || !$mostVisitedProduct->marketable_number > 0) disabled
                                                                @endif
                                                                id="most-visited-product-button-{{$mostVisitedProduct->id}}">
                                                            <i class="fa fa-cart-plus"></i>
                                                        </button>
                                                    </form>
                                                </section>
                                                @guest
                                                    <section class="product-add-to-favorite">
                                                        <button
                                                            class="btn btn-light btn-sm text-decoration-none"
                                                            type="button"
                                                            data-url="{{ route('customer.market.add-to-favorite', $mostVisitedProduct->slug) }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="افزودن به علاقه مندی">
                                                            <i class="fa fa-heart"></i>
                                                        </button>
                                                    </section>
                                                @endguest
                                                @auth
                                                    @if($mostVisitedProduct->users->contains('id', auth()->user()->id))
                                                        <section class="product-add-to-favorite">
                                                            <button
                                                                class="btn btn-light btn-sm text-decoration-none"
                                                                type="button"
                                                                data-url="{{ route('customer.market.add-to-favorite', $mostVisitedProduct->slug) }}"
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
                                                                data-url="{{ route('customer.market.add-to-favorite', $mostVisitedProduct->slug) }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="left"
                                                                title="افزودن به علاقه مندی">
                                                                <i class="fa fa-heart"></i>
                                                            </button>
                                                        </section>
                                                    @endif
                                                @endauth
                                                <a class="product-link"
                                                   href="{{ route('customer.market.product', $mostVisitedProduct->slug) }}">
                                                    <section class="product-image">
                                                        <img class=""
                                                             src="{{ asset($mostVisitedProduct->image['indexArray']['medium']) }}"
                                                             alt="{{ $mostVisitedProduct->name }}">
                                                    </section>
                                                    <section class="product-name">
                                                        <h3>{{ $mostVisitedProduct->name }}</h3>
                                                    </section>
                                                    <section class="product-price-wrapper">
                                                        @php
                                                            $mostVisitedProductAmazingSale = $mostVisitedProduct->amazingSales()->validAmazingSales()->first();
                                                        @endphp
                                                        @if(!empty($mostVisitedProductAmazingSale))
                                                            <section class="product-price-wrapper">
                                                                <section class="product-discount">
                                                                    <span
                                                                        class="product-old-price">{{ priceFormat($mostVisitedProduct->price) }}</span>
                                                                    <span
                                                                        class="product-discount-amount">{{ $mostVisitedProductAmazingSale->percentage }}%</span>
                                                                </section>
                                                                <section
                                                                    class="product-price">{{ priceFormat($mostVisitedProduct->price - $mostVisitedProduct->price * ($mostVisitedProductAmazingSale->percentage / 100)) }}
                                                                    تومان
                                                                </section>
                                                            </section>
                                                        @else
                                                            <section
                                                                class="product-price">{{ priceFormat($mostVisitedProduct->price) }}
                                                                تومان
                                                            </section>
                                                        @endif
                                                    </section>
                                                    <section class="product-colors">
                                                        @foreach($mostVisitedProduct->colors as $color)
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
    <!-- end product lazy load -->

    <!-- start ads section -->
    <section class="mb-3">
        <section class="container-xxl">
            <!-- two column-->
            <section class="row py-4">
                @foreach($middleBanners as $middleBanner)
                    <section class="col-12 col-md-6 mt-2 mt-md-0">
                        <a href="{{ urldecode($middleBanner->url) }}">
                            <img class="d-block rounded-2 w-100" src="{{ asset($middleBanner->image) }}"
                                 alt="{{ $middleBanner->title }}">
                        </a>
                    </section>
                @endforeach
            </section>

        </section>
    </section>
    <!-- end ads section -->

    <!-- start product lazy load -->
    <section class="mb-3">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>پیشنهاد آمازون به شما</span>
                                </h2>
                                <section class="content-header-link">
                                    <a href="#">مشاهده همه</a>
                                </section>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper">
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">
                                @foreach($offeredProducts as $offeredProduct)
                                    <section class="item">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">
                                                <section class="product-add-to-cart">
                                                    <form
                                                        action="{{ route('customer.sales-process.add-to-cart', ['product' => $offeredProduct->slug, 'number'=> 1]) }}"
                                                        method="post"
                                                        id="offered-product-form-{{$offeredProduct->id}}">
                                                        @csrf
                                                        <button class="btn btn-light btn-sm text-decoration-none"
                                                                data-bs-toggle="tooltip" data-bs-placement="left"
                                                                type="button"
                                                                title="افزودن به سبد خرید"
                                                                @if(!$offeredProduct->marketable || !$offeredProduct->marketable_number > 0) disabled
                                                                @endif
                                                                id="offered-product-button-{{$offeredProduct->id}}">
                                                            <i class="fa fa-cart-plus"></i>
                                                        </button>
                                                    </form>
                                                </section>
                                                @guest
                                                    <section class="product-add-to-favorite">
                                                        <button
                                                            class="btn btn-light btn-sm text-decoration-none"
                                                            type="button"
                                                            data-url="{{ route('customer.market.add-to-favorite', $offeredProduct->slug) }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="افزودن به علاقه مندی">
                                                            <i class="fa fa-heart"></i>
                                                        </button>
                                                    </section>
                                                @endguest
                                                @auth
                                                    @if($offeredProduct->users->contains('id', auth()->user()->id))
                                                        <section class="product-add-to-favorite">
                                                            <button
                                                                class="btn btn-light btn-sm text-decoration-none"
                                                                type="button"
                                                                data-url="{{ route('customer.market.add-to-favorite', $offeredProduct->slug) }}"
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
                                                                data-url="{{ route('customer.market.add-to-favorite', $offeredProduct->slug) }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="left"
                                                                title="افزودن به علاقه مندی">
                                                                <i class="fa fa-heart"></i>
                                                            </button>
                                                        </section>
                                                    @endif
                                                @endauth
                                                <a class="product-link"
                                                   href="{{ route('customer.market.product', $offeredProduct->slug) }}">
                                                    <section class="product-image">
                                                        <img class=""
                                                             src="{{ asset($offeredProduct->image['indexArray']['medium']) }}"
                                                             alt="{{ $offeredProduct->name }}">
                                                    </section>
                                                    <section class="product-name">
                                                        <h3>{{ $offeredProduct->name }}</h3>
                                                    </section>
                                                    <section class="product-price-wrapper">
                                                        @php
                                                            $offeredProductAmazingSale = $offeredProduct->amazingSales()->validAmazingSales()->first();
                                                        @endphp
                                                        @if(!empty($offeredProductAmazingSale))
                                                            <section class="product-price-wrapper">
                                                                <section class="product-discount">
                                                                    <span
                                                                        class="product-old-price">{{ priceFormat($offeredProduct->price) }}</span>
                                                                    <span
                                                                        class="product-discount-amount">{{ $offeredProductAmazingSale->percentage }}%</span>
                                                                </section>
                                                                <section
                                                                    class="product-price">{{ priceFormat($offeredProduct->price - $offeredProduct->price * ($offeredProductAmazingSale->percentage / 100)) }}
                                                                    تومان
                                                                </section>
                                                            </section>
                                                        @else
                                                            <section
                                                                class="product-price">{{ priceFormat($offeredProduct->price) }}
                                                                تومان
                                                            </section>
                                                        @endif
                                                    </section>
                                                    <section class="product-colors">
                                                        @foreach($offeredProduct->colors as $color)
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
    <!-- end product lazy load -->

    @if(!empty($bottomBanner))
        <!-- start ads section -->
        <section class="mb-3">
            <section class="container-xxl">
                <!-- one column -->
                <section class="row py-4">
                    <section class="col">
                        <a href="{{ urldecode($bottomBanner->url) }}">
                            <img class="d-block rounded-2 w-100" src="{{ $bottomBanner->image }}"
                                 alt="{{ $bottomBanner->title }}">
                        </a>
                    </section>
                </section>

            </section>
        </section>
        <!-- end ads section -->
    @endif

    <!-- start brand part-->
    <section class="brand-part mb-4 py-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex align-items-center">
                            <h2 class="content-header-title">
                                <span>برندهای ویژه</span>
                            </h2>
                        </section>
                    </section>
                    <!-- start vontent header -->
                    <section class="brands-wrapper py-4">
                        <section class="brands dark-owl-nav owl-carousel owl-theme">
                            @foreach($brands as $brand)
                                <section class="item">
                                    <section class="brand-item">
                                        <a href="{{ route('customer.products',['brands[]' => $brand->id]) }}">
                                            <img class="rounded-2" src="{{ $brand->logo['indexArray']['medium'] }}"
                                                 alt="{{ $brand->original_name }}">
                                        </a>
                                    </section>
                                </section>
                            @endforeach
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end brand part-->

    <section class="position-fixed p-4 flex-row-reverse"
             style="z-index: 10; right: 0; top: 3rem; width: 26rem; max-width: 80%;">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="7000">
            <div class="toast-header">
                <strong class="me-auto">فروشگاه</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <strong class="ml-auto">
                    برای افزودن کالا به لیست علاقه مندی ها باید ابتدا وارد حساب کاربری خود شوید
                    <br>
                    <a href="{{ route('auth.customer.login-register-form') }}" class="text-primary">ثبت نام یا ورود</a>
                </strong>
            </div>
        </div>
    </section>
@endsection
@push('script')
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
    <script>
        $('button[id^="most-visited-product-button-"]').click(function (e) {
            let formId = $(this).prop('id').replace('button', 'form');
            $('#' + formId).submit();
        });
        $('button[id^="offered-product-button-"]').click(function (e) {
            let formId = $(this).prop('id').replace('button', 'form');
            $('#' + formId).submit();
        });
    </script>
@endpush
