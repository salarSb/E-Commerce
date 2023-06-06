@extends('customer.layouts.master-two-col')
@section('head-tag')
    <title>لیست علاقه مندی های شما</title>
@endsection
@section('content')
    <!-- start body -->
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <section class="row">
                @include('customer.layouts.partials.profile-sidebar')
                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">
                        <!-- start vontent header -->
                        <section class="content-header mb-4">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>لیست علاقه های من</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->
                        @forelse ($products as $product)
                            <section class="cart-item d-flex py-3">
                                <section class="cart-img align-self-start flex-shrink-1">
                                    <a href="{{ route('customer.market.product', $product->slug) }}">
                                        <img src="{{ asset($product->image['indexArray']['medium']) }}"
                                             alt="product-image">
                                    </a>
                                </section>
                                <section class="align-self-start w-100">
                                    <p class="fw-bold">{{ $product->name }}</p>
                                    <p>
                                        @foreach($product->colors as $color)
                                            <span style="background-color: {{$color->color}};"
                                                  class="cart-product-selected-color me-1"></span>
                                        @endforeach
                                    </p>

                                    @if($product->guarantees()->get()->count() != 0)
                                        <p>
                                            <i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i>
                                            @foreach($product->guarantees as $key => $guarantee)
                                                <span>
                                                    @if($loop->last)
                                                        {{ $guarantee->name }}
                                                    @else
                                                        {{ $guarantee->name }},&nbsp
                                                    @endif
                                                </span>
                                            @endforeach
                                        </p>
                                    @endif
                                    <p>
                                        <i class="fa fa-store-alt cart-product-selected-store me-1"></i>
                                        @if($product->marketable_number > 0)
                                            <span>کالا موجود در انبار</span>
                                        @else
                                            <span>کالا ناموجود</span>
                                        @endif
                                    </p>
                                    <section>
                                        <form
                                            id="delete-form-{{ $product->id }}"
                                            action="{{ route('profile.my-favorites.delete', $product->slug) }}"
                                            method="post">
                                            @method('delete')
                                            @csrf
                                        </form>
                                        <button type="submit" form="delete-form-{{ $product->id }}"
                                                class="btn btn-link btn-sm text-decoration-none cart-delete -border-none">
                                            <i class="fa fa-trash-alt"></i>
                                            حذف از لیست علاقه ها
                                        </button>
                                    </section>
                                </section>
                                <section class="align-self-end flex-shrink-1">
                                    @php
                                        $amazingSale = $product->amazingSales()->validAmazingSales()->first();
                                    @endphp
                                    @if(!empty($amazingSale))
                                        <section class="cart-item-discount text-danger text-nowrap mb-1">
                                            تخفیف {{ priceFormat($product->price * ($amazingSale->percentage / 100)) }}
                                        </section>
                                        <section
                                            class="text-nowrap fw-bold">{{ priceFormat($product->price - $product->price * ($amazingSale->percentage / 100)) }}
                                            تومان
                                        </section>
                                    @else
                                        <section class="text-nowrap fw-bold">{{ priceFormat($product->price) }}تومان
                                        </section>
                                    @endif
                                </section>
                            </section>
                        @empty
                            <section class="order-item">
                                <section class="d-flex justify-content-between">
                                    <p>محصولی یافت نشد</p>
                                </section>
                            </section>
                        @endforelse
                    </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->
@endsection
