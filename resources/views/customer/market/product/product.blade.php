@extends('customer.layouts.master-two-col')
@section('head-tag')
    <title>{{ $product->name }}</title>
    <style>
        /* TODO: dont use cdn */
        /*@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);*/

        /* Styling h1 and links
    ––––––––––––––––––––––––––––––––– */
        .starrating > input {
            display: none;
        }

        /* Remove radio buttons */

        .starrating > label:before {
            content: "\f005";
            /* Star */
            margin: 2px;
            font-size: 2em;
            font-family: FontAwesome;
            display: inline-block;
        }

        .starrating > label {
            color: #222222;
            /* Start color when not clicked */
        }

        .starrating > input:checked ~ label {
            color: #ffca08;
        }

        /* Set yellow color when star checked */

        .starrating > input:hover ~ label {
            color: #ffca08;
        }

        /* Set yellow color when star hover */
    </style>
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
                                <span>{{ $product->name }}</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">
                        <!-- start image gallery -->
                        <section class="col-md-4">
                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">
                                <section class="product-gallery">
                                    <section class="product-gallery-selected-image mb-3">
                                        <img src="{{ asset($product->image['indexArray']['medium']) }}"
                                             alt="{{ $product->name }}">
                                    </section>
                                    <section class="product-gallery-thumbs">
                                        @if($product->images()->get()->count() != 0)
                                            <img class="product-gallery-thumb"
                                                 src="{{ asset($product->image['indexArray']['small']) }}"
                                                 alt="{{ asset($product->image['indexArray']['small']) }}"
                                                 data-input="{{ asset($product->image['indexArray']['medium']) }}">
                                        @endif
                                        @foreach($product->images as $key => $image)
                                            <img class="product-gallery-thumb"
                                                 src="{{ asset($image->image['indexArray']['small']) }}"
                                                 alt="{{ asset($image->image['indexArray']['small']) . '-' . ($key + 1) }}"
                                                 data-input="{{ asset($image->image['indexArray']['medium']) }}">
                                        @endforeach
                                    </section>
                                </section>
                            </section>
                        </section>
                        <!-- end image gallery -->

                        <!-- start product info -->
                        <section class="col-md-5">

                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            {{ $product->name }}
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="product-info">
                                    <form id="add-to-cart"
                                          action="{{ route('customer.sales-process.add-to-cart', $product->slug) }}"
                                          method="post" class="product-info">
                                        @csrf
                                        @if($product->colors()->get()->count() != 0)
                                            <p>
                                            <span>رنگ انتخاب شده: <span
                                                    id="selected_color_name">{{ $product->colors()->first()->name }}</span></span>
                                            </p>
                                            <p>
                                                @foreach($product->colors as $color)
                                                    <label for="{{ 'color_'.$color->id }}"
                                                           style="background-color: {{ $color->color ?? '#ffffff' }};"
                                                           class="product-info-colors me-1"
                                                           data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                           title="{{ $color->name }}"></label>
                                                    <input type="radio" name="color_id" id="{{ 'color_'.$color->id }}"
                                                           class="d-none" value="{{ $color->id }}"
                                                           data-color-name="{{ $color->name }}"
                                                           data-color-price="{{ $color->price_increase }}"
                                                           @if($loop->first) checked @endif>
                                                @endforeach
                                            </p>
                                        @endif
                                        @if($product->guarantees()->get()->count() != 0)
                                            <p>
                                                <i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i>
                                                <label for="guarantee">گارانتی :</label>
                                                <select name="guarantee_id" id="guarantee" class="p-1">
                                                    @foreach($product->guarantees as $key => $guarantee)
                                                        <option value="{{ $guarantee->id }}"
                                                                data-guarantee-price="{{ $guarantee->price_increase }}"
                                                                @if($loop->first) selected @endif>
                                                            {{ $guarantee->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </p>
                                        @endif
                                        <p>
                                            <i class="fa fa-store-alt cart-product-selected-store me-1"></i>
                                            @if($product->marketable)
                                                @if($product->marketable_number > 0)
                                                    <span>کالا موجود در انبار</span>
                                                @else
                                                    <span>کالا ناموجود</span>
                                                @endif
                                            @else
                                                <span>کالا غیر قابل فروش</span>
                                            @endif
                                        </p>
                                        @guest
                                            <div class="d-flex">
                                                <section class="product-add-to-favorite position-relative mb-2"
                                                         style="top: 0">
                                                    <button
                                                        class="btn btn-light btn-sm text-decoration-none" type="button"
                                                        data-url="{{ route('customer.market.add-to-favorite', $product->slug) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="افزودن به علاقه مندی">
                                                        <i class="fa fa-heart"></i>
                                                    </button>
                                                </section>
                                                <section class="product-add-to-compare position-relative mt-1"
                                                         style="top: 0">
                                                    <button
                                                        class="btn btn-light btn-sm text-decoration-none" type="button"
                                                        data-url="{{ route('customer.market.add-to-compare', $product->slug) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="افزودن به لیست مقایسه">
                                                        <i class="fa fa-industry"></i>
                                                    </button>
                                                </section>
                                            </div>
                                        @endguest
                                        @auth
                                            <div class="d-flex">
                                                @if($product->users->contains('id', auth()->user()->id))
                                                    <section class="product-add-to-favorite position-relative mb-2"
                                                             style="top: 0">
                                                        <button
                                                            class="btn btn-light btn-sm text-decoration-none"
                                                            type="button"
                                                            data-url="{{ route('customer.market.add-to-favorite', $product->slug) }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="حذف از علاقه مندی">
                                                            <i class="fa fa-heart text-danger"></i>
                                                        </button>
                                                    </section>
                                                @else
                                                    <section class="product-add-to-favorite position-relative mb-2"
                                                             style="top: 0">
                                                        <button
                                                            class="btn btn-light btn-sm text-decoration-none"
                                                            type="button"
                                                            data-url="{{ route('customer.market.add-to-favorite', $product->slug) }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="افزودن به علاقه مندی">
                                                            <i class="fa fa-heart"></i>
                                                        </button>
                                                    </section>
                                                @endif
                                                @if(isset($product->compares) && $product->compares->contains('id', $compare->id))
                                                    <section class="product-add-to-compare position-relative mt-1"
                                                             style="top: 0">
                                                        <button
                                                            class="btn btn-light btn-sm text-decoration-none"
                                                            type="button"
                                                            data-url="{{ route('customer.market.add-to-compare', $product->slug) }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="حذف از لیست مقایسه">
                                                            <i class="fa fa-industry text-success"></i>
                                                        </button>
                                                    </section>
                                                @else
                                                    <section class="product-add-to-compare position-relative mt-1"
                                                             style="top: 0">
                                                        <button
                                                            class="btn btn-light btn-sm text-decoration-none"
                                                            type="button"
                                                            data-url="{{ route('customer.market.add-to-compare', $product->slug) }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="افزودن به لیست مقایسه">
                                                            <i class="fa fa-industry"></i>
                                                        </button>
                                                    </section>
                                                @endif
                                            </div>
                                        @endauth
                                        <section>
                                            <section class="cart-product-number d-inline-block ">
                                                <button class="cart-number cart-number-down" type="button">-</button>
                                                <input id="number" name="number" type="number" min="1" max="5" step="1"
                                                       value="1"
                                                       readonly="readonly">
                                                <button class="cart-number cart-number-up" type="button">+</button>
                                            </section>
                                        </section>
                                        <p class="mb-3 mt-5">
                                            <i class="fa fa-info-circle me-1"></i>کاربر گرامی خرید شما هنوز نهایی نشده
                                            است.
                                            برای ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه
                                            ارسال
                                            را انتخاب کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد
                                            شد.
                                            و در نهایت پرداخت این سفارش صورت میگیرد. پس از ثبت سفارش کالا بر اساس نحوه
                                            ارسال
                                            که شما انتخاب کرده اید کالا برای شما در مدت زمان مذکور ارسال می گردد.
                                        </p>
                                    </form>
                                </section>
                            </section>

                        </section>
                        <!-- end product info -->

                        <section class="col-md-3">
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                @php
                                    $amazingSale = $product->amazingSales()->validAmazingSales()->first();
                                @endphp
                                @if(!empty($amazingSale))
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">قیمت کالا</p>
                                        <p class="text-muted">
                                            <span id="product_price"
                                                  data-product-original-price="{{ $product->price }}">
                                                {{ priceFormat($product->price) }}
                                            </span>
                                            <span class="small">تومان</span>
                                        </p>
                                    </section>
                                    @php
                                        $discountPrice = $product->price * ($amazingSale->percentage / 100);
                                    @endphp
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">تخفیف کالا</p>
                                        <p class="text-danger fw-bolder" id="product-discount-price"
                                           data-product-discount-price="{{ $discountPrice }}">
                                            {{ priceFormat($discountPrice) }}
                                            <span class="small">تومان</span>
                                        </p>
                                    </section>

                                    <section class="border-bottom mb-3"></section>

                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">قابل پرداخت</p>
                                        <p class="fw-bolder">
                                            <span id="final_price">
                                                {{ priceFormat($product->price - $discountPrice) }}
                                            </span>
                                            <span class="small">تومان</span>
                                        </p>
                                    </section>
                                @else
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">قیمت کالا</p>
                                        <p class="text-muted">
                                            <span id="product_price"
                                                  data-product-original-price="{{ $product->price }}">
                                                {{ priceFormat($product->price) }}
                                            </span>
                                            <span class="small">تومان</span>
                                        </p>
                                    </section>
                                    <section class="border-bottom mb-3"></section>
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">قابل پرداخت</p>
                                        <p class="fw-bolder">
                                            <span id="final_price">
                                                {{ priceFormat($product->price) }}
                                            </span>
                                            <span class="small">تومان</span>
                                        </p>
                                    </section>
                                @endif
                                <section class="">
                                    @if($product->marketable)
                                        @if($product->marketable_number > 0)
                                            <button id="next-level" class="btn btn-danger d-block w-100"
                                                    onclick="document.getElementById('add-to-cart').submit()">
                                                افزودن به سبد خرید
                                            </button>
                                        @else
                                            <a id="next-level" href="#" class="btn btn-secondary disabled d-block">محصول
                                                ناموجود می
                                                باشد
                                            </a>
                                        @endif
                                    @else
                                        <a id="next-level" href="#" class="btn btn-secondary disabled d-block">
                                            محصول غیر قابل فروش
                                        </a>
                                    @endif
                                </section>
                            </section>
                        </section>
                    </section>
                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->
    @include('customer.layouts.partials.related-products')
    <!-- start description, features and comments -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start content header -->
                        <section id="introduction-features-comments" class="introduction-features-comments">
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span class="me-2"><a class="text-decoration-none text-dark"
                                                              href="#introduction">معرفی</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#features">ویژگی ها</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#comments">دیدگاه ها</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#ratings">امتیاز ها</a></span>
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                        </section>
                        <!-- start content header -->

                        <section class="py-4">

                            <!-- start vontent header -->
                            <section id="introduction" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        معرفی
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-introduction mb-4">{!! $product->introduction !!}</section>

                            <!-- start vontent header -->
                            <section id="features" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        ویژگی ها
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-features mb-4 table-responsive">
                                <table class="table table-bordered border-white">
                                    @foreach($product->values as $value)
                                        <tr>
                                            <td>{{$value->attribute->name}}</td>
                                            <td>{{ json_decode($value->value)->value }} {{$value->attribute->unit}}</td>
                                        </tr>
                                    @endforeach
                                    @foreach($product->metas as $meta)
                                        <tr>
                                            <td>{{ $meta->meta_key }}</td>
                                            <td>{{ $meta->meta_value }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </section>

                            <!-- start vontent header -->
                            <section id="comments" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        دیدگاه ها
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-comments mb-4">

                                <section class="comment-add-wrapper">
                                    <button class="comment-add-button" type="button" data-bs-toggle="modal"
                                            data-bs-target="#add-comment"><i class="fa fa-plus"></i> افزودن دیدگاه
                                    </button>
                                    <!-- start add comment Modal -->
                                    <section class="modal fade" id="add-comment" tabindex="-1"
                                             aria-labelledby="add-comment-label" aria-hidden="true">
                                        <section class="modal-dialog">
                                            <section class="modal-content">
                                                <section class="modal-header">
                                                    <h5 class="modal-title" id="add-comment-label"><i
                                                            class="fa fa-plus"></i> افزودن دیدگاه</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </section>
                                                @guest
                                                    <section class="modal-body">
                                                        <p>کاربر گرامی لطفا برای ثبت نظر ابتدا وارد حساب کاربری خود
                                                            شوید.</p>
                                                        <p>برای ثبت نام و یا ورود به حساب کاربری
                                                            <a href="{{ route('auth.customer.login-register-form') }}">اینجا</a>
                                                            کلیک کنید
                                                        </p>
                                                    </section>
                                                @endguest
                                                @auth
                                                    <section class="modal-body">
                                                        <form class="row"
                                                              action="{{ route('customer.market.add-comment', $product->slug) }}"
                                                              method="post">
                                                            @csrf
                                                            <section class="col-12 mb-2">
                                                                <label for="comment" class="form-label mb-1">دیدگاه
                                                                    شما</label>
                                                                <textarea class="form-control form-control-sm"
                                                                          id="comment"
                                                                          placeholder="دیدگاه شما ..." rows="4"
                                                                          name="body"></textarea>
                                                            </section>
                                                            <section class="modal-footer py-1">
                                                                <button type="submit" class="btn btn-sm btn-primary">ثبت
                                                                    دیدگاه
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-danger"
                                                                        data-bs-dismiss="modal">بستن
                                                                </button>
                                                            </section>
                                                        </form>
                                                    </section>
                                                @endauth
                                            </section>
                                        </section>
                                    </section>
                                </section>
                                @foreach($product->comments()->validComments()->get() as $comment)
                                    <section class="product-comment">
                                        <section class="product-comment-header d-flex justify-content-start">
                                            <section class="product-comment-date">
                                                {{ jalaliDate($comment->created_at) }}
                                            </section>
                                            <section class="product-comment-title">
                                                @if(empty($comment->user->first_name) or empty($comment->user->last_name))
                                                    ناشناس
                                                @else
                                                    {{ $comment->user->fullName }}
                                                @endif
                                            </section>
                                        </section>
                                        <section class="product-comment-body">
                                            {{ $comment->body }}
                                        </section>
                                        @foreach($comment->answers as $commentAnswer)
                                            <section class="product-comment ms-5 border-bottom-0">
                                                <section class="product-comment-header d-flex justify-content-start">
                                                    <section class="product-comment-date">
                                                        {{ jalaliDate($commentAnswer->created_at) }}
                                                    </section>
                                                    <section class="product-comment-title">
                                                        @if(empty($commentAnswer->user->first_name) or empty($commentAnswer->user->last_name))
                                                            ادمین
                                                        @else
                                                            {{ $commentAnswer->user->fullName }}
                                                        @endif
                                                    </section>
                                                </section>
                                                <section class="product-comment-body">
                                                    {{ $commentAnswer->body }}
                                                </section>
                                            </section>
                                        @endforeach
                                    </section>
                                @endforeach
                            </section>
                            <!-- start rating -->
                            <section id="ratings" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        امتیاز ها
                                    </h2>
                                    <section class="content-header-link">
                                    </section>
                                </section>
                            </section>
                            @auth
                                <section class="product-rating mb-4">
                                    <div class="container">
                                        <h5 class="text-danger">
                                            امتیاز خود را به این محصول انتخاب نمایید
                                        </h5>
                                        <form
                                            class="starrating risingstar d-flex justify-content-end flex-row-reverse align-items-center"
                                            action="{{ route('customer.market.add-rate', $product) }}" method="post">
                                            @csrf
                                            <div class="mx-3">
                                                <button class="btn btn-info btn-sm">ثبت امتیاز</button>
                                            </div>
                                            <input type="radio" id="star5" name="rating" value="5"/>
                                            <label for="star5" title="5 star"></label>
                                            <input type="radio" id="star4" name="rating" value="4"/>
                                            <label for="star4" title="4 star"></label>
                                            <input type="radio" id="star3" name="rating" value="3"/>
                                            <label for="star3" title="3 star"></label>
                                            <input type="radio" id="star2" name="rating" value="2"/>
                                            <label for="star2" title="2 star"></label>
                                            <input type="radio" id="star1" name="rating" value="1"/>
                                            <label for="star1" title="1 star"></label>
                                            @error('rating')
                                            <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </form>

                                        @if($product->ratingsCount() != 0)
                                            <h6>
                                                میانگین امتیاز
                                                : {{ convertEnglishToPersian(number_format($product->ratingsAvg(), 1, '/')) }}
                                            </h6>
                                            <h6>
                                                تعداد امتیاز : {{ convertEnglishToPersian($product->ratingsCount()) }}
                                            </h6>
                                        @else
                                            <h6>اولین امتیاز را ثبت کنید</h6>
                                        @endif
                                    </div>
                                </section>
                            @endauth
                            @guest
                                <section class="modal-body">
                                    <p>کاربر گرامی لطفا برای ثبت امتیاز ابتدا وارد حساب کاربری خود
                                        شوید.</p>
                                    <p>برای ثبت نام و یا ورود به حساب کاربری
                                        <a href="{{ route('auth.customer.login-register-form') }}">اینجا</a>
                                        کلیک کنید
                                    </p>
                                </section>
                            @endguest
                        </section>

                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end description, features and comments -->

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
        $(document).ready(function () {
            bill();

            //input color
            $('input[name="color_id"]').change(function () {
                bill();
            });

            //select guarantee
            $('select[name="guarantee_id"]').change(function () {
                bill();
            });

            //change product number
            $('.cart-number').click(function () {
                bill();
            });
        });

        function bill() {
            let selectedColor = $('input[name="color_id"]:checked');
            if (selectedColor.length != 0) {
                $('#selected_color_name').html(selectedColor.attr('data-color-name'));
            }

            // price computing
            let selectedColorPrice = 0;
            let selectedGuaranteePrice = 0;
            let number = 1;
            let productDiscountPrice = 0;
            let productOriginalPrice = parseFloat($('#product_price').attr('data-product-original-price'));
            if ($('input[name="color_id"]:checked').length != 0) {
                selectedColorPrice = parseFloat(selectedColor.attr('data-color-price'));
            }
            if ($('#guarantee option:selected').length != 0) {
                selectedGuaranteePrice = parseFloat($('#guarantee option:selected').attr('data-guarantee-price'));
            }
            if ($('#number').val() > 0) {
                number = parseFloat($('#number').val());
            }
            if ($('#product-discount-price').length != 0) {
                productDiscountPrice = parseFloat($('#product-discount-price').attr('data-product-discount-price'));
            }

            //final price
            let productPrice = productOriginalPrice + selectedColorPrice + selectedGuaranteePrice;
            let finalPrice = number * (productPrice - productDiscountPrice);
            $('#product_price').html(toFarsiNumber(productPrice));
            $('#final_price').html(toFarsiNumber(finalPrice))
        }

        function toFarsiNumber(number) {
            const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            // add comma
            number = new Intl.NumberFormat().format(number);
            //convert to persian
            return number.toString().replace(/\d/g, x => farsiDigits[x]);
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
        $('.product-add-to-compare button').click(function () {
            const url = $(this).attr('data-url');
            const element = $(this);
            $.ajax({
                url: url,
                success: function (result) {
                    if (result.status == 1) {
                        $(element).children().first().addClass('text-success');
                        $(element).attr('data-bs-original-title', 'حذف از لیست مقایسه');
                    } else if (result.status == 2) {
                        $(element).children().first().removeClass('text-success');
                        $(element).attr('data-bs-original-title', 'افزودن به لیست مقایسه');
                    } else {
                        $('.toast').toast('show');
                    }
                }
            });
        });
    </script>
    <script>
        //start product introduction, features and comment
        $(document).ready(function () {
            var s = $("#introduction-features-comments");
            var pos = s.position();
            $(window).scroll(function () {
                var windowpos = $(window).scrollTop();

                if (windowpos >= pos.top) {
                    s.addClass("stick");
                } else {
                    s.removeClass("stick");
                }
            });
        });
        //end product introduction, features and comment
    </script>
@endpush
