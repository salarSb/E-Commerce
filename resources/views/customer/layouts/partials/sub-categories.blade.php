<section class="sidebar-nav-sub-wrapper px-2">
    <section class="sidebar-nav-sub-item">
        @foreach($categories as $category)
            <span class="sidebar-nav-sub-item-title">
                <a href="{{ route('customer.products', array_merge(['category' => $category->slug],request()->all())) }}"
                   class="d-inline">{{ $category->name }}</a>
                @if($category->children->isNotEmpty())
                    <i class="fa fa-angle-left"></i>
                @endif
            </span>
            @include('customer.layouts.partials.sub-categories', ['categories'=> $category->children])
        @endforeach
    </section>
</section>
