@extends('customer.layouts.master-one-col')
@section('head-tag')
    <title>فروشگاه آمازون</title>
@endsection
@section('content')
    <!-- start body -->
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            <section class="row">
                <aside id="sidebar" class="sidebar col-md-3">
                    <form action="{{ route('customer.products',request()->category?->slug) }}"
                          method="get">
                        <input type="hidden" name="search" value="{{ request()->query('search') }}">
                        <input type="hidden" name="sort" value="{{ request()->query('sort') }}">
                        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                            <!-- start sidebar nav-->
                            <section class="sidebar-nav">
                                <section class="sidebar-nav-item">
                                    @include('customer.layouts.partials.categories', ['categories' => $categories])
                                </section>
                            </section>
                            <!--end sidebar nav-->
                        </section>
                        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                            <section class="content-header mb-3">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        جستجوی برند
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <input id="brand-search"
                                   class="sidebar-input-text" type="text"
                                   placeholder="برند خاصی مد نظرته ...">
                        </section>
                        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                            <section class="content-header mb-3">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        برند
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <div id="brands" style="height: 150px; overflow-y: scroll;">
                                @forelse($brands as $brand)
                                    <section class="sidebar-brand-wrapper">
                                        <section class="form-check sidebar-brand-item">
                                            <input class="form-check-input" name="brands[]" type="checkbox"
                                                   value="{{ $brand->id }}" id="{{ $brand->id }}"
                                                   @if(in_array($brand->id, request()->query('brands') ?? [])) checked @endif>
                                            <label class="form-check-label d-flex justify-content-between"
                                                   for="{{ $brand->id }}">
                                                <span>{{ $brand->persian_name }}</span>
                                                <span>{{ $brand->original_name }}</span>
                                            </label>
                                        </section>
                                    </section>
                                @empty
                                    چیری پیدا نشد
                                @endforelse
                            </div>
                        </section>
                        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                            <section class="content-header mb-3">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        محدوده قیمت
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="sidebar-price-range d-flex justify-content-between">
                                <section class="p-1"><input type="text" placeholder="قیمت از ..." name="min_price"
                                                            value="{{ request()->query('min_price') }}">
                                </section>
                                <section class="p-1"><input type="text" placeholder="قیمت تا ..." name="max_price"
                                                            value="{{ request()->query('max_price') }}">
                                </section>
                            </section>
                        </section>
                        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
                            <section class="sidebar-filter-btn d-grid gap-2">
                                <button class="btn btn-danger" type="submit">اعمال فیلتر</button>
                            </section>
                        </section>
                    </form>
                </aside>
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
                            @if(request()->query('categories'))
                                <span class="d-inline-block border p-1 rounded bg-light">
                                دسته :
                                    <span class="badge bg-info text-dark">
                                    "کتاب"
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
                                        <section class="product-add-to-cart"><a href="#" data-bs-toggle="tooltip"
                                                                                data-bs-placement="left"
                                                                                title="افزودن به سبد خرید"><i
                                                    class="fa fa-cart-plus"></i></a></section>
                                        <section class="product-add-to-favorite"><a href="#" data-bs-toggle="tooltip"
                                                                                    data-bs-placement="left"
                                                                                    title="افزودن به علاقه مندی"><i
                                                    class="fa fa-heart"></i></a></section>
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
        input.keypress(function () {
            if (searchTimeout !== undefined) clearTimeout(searchTimeout);
            searchTimeout = setTimeout(callServerScript, 1000);
        });

        function callServerScript() {
            let inputValue = input.val();
            let url = "{{ route('get-brands',['brand_search' => ':inputValue']) }}";
            url = url.replace('%3AinputValue', inputValue);
            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    if (response.status) {
                        let brands = response.brands;
                        $('#brands').empty();
                        brands.map(brand => {
                            $('#brands').append(`<section class="sidebar-brand-wrapper">
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
                        errorToast('برندی یافت نشد');
                    }
                },
                error: function (error) {
                    errorToast('عملیات با خطا مواجه شد');
                }
            });
        }
    </script>
@endpush
