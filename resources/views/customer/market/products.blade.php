@extends('customer.layouts.master-one-col')
@section('head-tag')
    <title>فروشگاه آمازون</title>
@endsection
@section('content')
    <!-- start body -->
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                @include('customer.layouts.partials.product-sidebar')
                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">
                        <section class="filters mb-3">
                            @if(request()->query('search'))
                                <span class="d-inline-block border p-1 rounded bg-light">
                                    نتیجه جستجو برای :
                                    <span class="badge bg-info text-dark">
                                        {{ request()->query('search') }}
                                    </span>
                                </span>
                            @endif
                            @if(request()->query('brands'))
                                <span class="d-inline-block border p-1 rounded bg-light">
                                    برند :
                                    <span class="badge bg-info text-dark">
                                        {{ implode(', ', $selectedBrands) }}
                                    </span>
                                </span>
                            @endif
                            @if(isset($category))
                                <span class="d-inline-block border p-1 rounded bg-light">
                                دسته :
                                    <span class="badge bg-info text-dark">
                                    {{ $category->name }}
                                    </span>
                                </span>
                            @endif
                            @if(request()->query('min_price'))
                                <span class="d-inline-block border p-1 rounded bg-light">
                                قیمت از :
                                    <span class="badge bg-info text-dark">
                                        {{request()->query('min_price')}} تومان
                                    </span>
                                </span>
                            @endif
                            @if(request()->query('max_price'))
                                <span class="d-inline-block border p-1 rounded bg-light">
                                    قیمت تا :
                                    <span class="badge bg-info text-dark">
                                        {{ request()->query('max_price') }} تومان
                                    </span>
                                </span>
                            @endif
                        </section>
                        <section class="sort ">
                            <span>مرتب سازی بر اساس : </span>
                            <a class="btn @if(request()->query('sort') == 1) btn-info @else btn-light @endif btn-sm px-1 py-0"
                               href="{{ route('customer.products', array_merge([
                                    'sort' => 1,
                                    'category' => request()->category?->slug
                                ],request()->except('sort'))) }}">جدیدترین</a>
                            <a class="btn @if(request()->query('sort') == 2) btn-info @else btn-light @endif btn-sm px-1 py-0"
                               href="{{ route('customer.products', array_merge([
                                    'sort' => 2,
                                    'category' => request()->category?->slug
                                ],request()->except('sort'))) }}">گران ترین</a>
                            <a class="btn @if(request()->query('sort') == 3) btn-info @else btn-light @endif btn-sm px-1 py-0"
                               href="{{ route('customer.products', array_merge([
                                    'sort' => 3,
                                    'category' => request()->category?->slug
                                ],request()->except('sort'))) }}">ارزان ترین</a>
                            <a class="btn @if(request()->query('sort') == 4) btn-info @else btn-light @endif btn-sm px-1 py-0"
                               href="{{ route('customer.products', array_merge([
                                    'sort' => 4,
                                    'category' => request()->category?->slug
                                ],request()->except('sort'))) }}">پربازدیدترین</a>
                            <a class="btn @if(request()->query('sort') == 5) btn-info @else btn-light @endif btn-sm px-1 py-0"
                               href="{{ route('customer.products', array_merge([
                                    'sort' => 5,
                                    'category' => request()->category?->slug
                                ],request()->except('sort'))) }}">پرفروش ترین</a>
                        </section>
                        <section class="main-product-wrapper row my-4">
                            @forelse($products as $product)
                                <section class="col-md-3 p-0">
                                    <section class="product">
                                        <section class="product-add-to-cart">
                                            <form
                                                action="{{ route('customer.sales-process.add-to-cart', ['product' => $product->slug, 'number'=> 1]) }}"
                                                method="post"
                                                id="product-form-{{$product->id}}">
                                                @csrf
                                                <button class="btn btn-light btn-sm text-decoration-none"
                                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                                        type="button"
                                                        title="افزودن به سبد خرید"
                                                        @if(!$product->marketable || !$product->marketable_number > 0) disabled
                                                        @endif
                                                        id="product-button-{{$product->id}}">
                                                    <i class="fa fa-cart-plus"></i>
                                                </button>
                                            </form>
                                        </section>
                                        @guest
                                            <section class="product-add-to-favorite">
                                                <button
                                                    class="btn btn-light btn-sm text-decoration-none"
                                                    type="button"
                                                    data-url="{{ route('customer.market.add-to-favorite', $product->slug) }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="left"
                                                    title="افزودن به علاقه مندی">
                                                    <i class="fa fa-heart"></i>
                                                </button>
                                            </section>
                                        @endguest
                                        @auth
                                            @if($product->users->contains('id', auth()->user()->id))
                                                <section class="product-add-to-favorite">
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
                                                <section class="product-add-to-favorite">
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
                                        @endauth
                                        <a class="product-link"
                                           href="{{ route('customer.market.product', $product->slug) }}">
                                            <section class="product-image">
                                                <img class=""
                                                     src="{{ asset($product->image['indexArray']['medium']) }}"
                                                     alt="{{ $product->name }}">
                                            </section>
                                            <section class="product-colors"></section>
                                            <section class="product-name"><h3>{{ $product->name }}</h3>
                                            </section>
                                            <section class="product-price-wrapper">
                                                @php
                                                    $productAmazingSale = $product->amazingSales()->validAmazingSales()->first();
                                                @endphp
                                                @if(!empty($productAmazingSale))
                                                    <section class="product-price-wrapper">
                                                        <section class="product-discount">
                                                            <span class="product-old-price">
                                                                {{ priceFormat($product->price) }}
                                                            </span>
                                                            <span class="product-discount-amount">
                                                                {{ $productAmazingSale->percentage }}%
                                                            </span>
                                                        </section>
                                                        <section class="product-price">
                                                            {{ priceFormat($product->price - $product->price * ($productAmazingSale->percentage / 100)) }}
                                                            تومان
                                                        </section>
                                                    </section>
                                                @else
                                                    <section
                                                        class="product-price">{{ priceFormat($product->price) }}
                                                        تومان
                                                    </section>
                                                @endif
                                            </section>
                                        </a>
                                    </section>
                                </section>
                            @empty
                                <h1 class="text-danger">محصولی یافت نشد</h1>
                            @endforelse
                            <section class="my-4 d-flex justify-content-center border-0">
                                {{ $products->links('pagination::bootstrap-5') }}
                            </section>
                        </section>
                    </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->
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
        let searchTimeout;
        let input = $('#brand-search');
        input.on('input', function () {
            if (searchTimeout !== undefined) clearTimeout(searchTimeout);
            searchTimeout = setTimeout(callServerScript, 1000);
        });
        $('button[id^="product-button-"]').click(function (e) {
            let formId = $(this).prop('id').replace('button', 'form');
            $('#' + formId).submit();
        });
        function callServerScript() {
            let inputValue = input.val();
            let url = "{{ route('get-brands',['brand_search' => ':inputValue']) }}";
            url = url.replace('%3AinputValue', inputValue);
            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    let brandsSection = $('#brands');
                    if (response.status) {
                        let brands = response.brands;
                        brandsSection.empty();
                        brands.map(brand => {
                            brandsSection.append(`<section class="sidebar-brand-wrapper">
                                                    <section class="form-check sidebar-brand-item">
                                                        <input class="form-check-input" name="brands[]" type="checkbox"
                                                            value="${brand.id}" id="${brand.id}">
                                                        <label class="form-check-label d-flex justify-content-between"
                                                               for="${brand.id}">
                                                            <span>${brand.persian_name}</span>
                                                            <span>${brand.original_name}</span>
                                                        </label>
                                                    </section>
                                                </section>`);
                        });
                    } else {
                        brandsSection.empty();
                        brandsSection.append(`<p>برندی یافت نشد</p>`);
                    }
                },
                error: function (error) {
                    errorToast('عملیات با خطا مواجه شد');
                }
            });
        }
    </script>
@endpush
