<!-- start product lazy load -->
<section class="mb-4">
    <section class="container-xxl">
        <section class="row">
            <section class="col">
                <section class="content-wrapper bg-white p-3 rounded-2">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                @if($relatedProducts->isNotEmpty())
                                    <span>کالاهای مرتبط</span>
                                @else
                                    <span>پیشتهاد به شما</span>
                                @endif
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>
                    <!-- start vontent header -->
                    <section class="lazyload-wrapper">
                        <section class="lazyload light-owl-nav owl-carousel owl-theme">
                            @forelse($relatedProducts as $relatedProduct)
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
                            @empty
                                @foreach($offeredProducts as $offeredProduct)
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
                            @endforelse
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
</section>
<!-- end product lazy load -->
