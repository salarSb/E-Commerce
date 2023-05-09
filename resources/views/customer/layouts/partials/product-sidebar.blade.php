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
                    برندی یافت نشد
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
    @if(!empty(request()->except('search')) || isset($category) || (request()->exists('search') && !is_null(request()->query('search'))))
        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
            <section class="sidebar-filter-btn d-grid gap-2">
                <a href="{{ route('customer.products') }}" class="btn btn-warning" type="submit">حذف فیلتر</a>
            </section>
        </section>
    @endif
</aside>
