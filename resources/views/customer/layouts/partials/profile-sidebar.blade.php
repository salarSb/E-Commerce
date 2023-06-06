<aside id="sidebar" class="sidebar col-md-3">
    <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
        <!-- start sidebar nav-->
        <section class="sidebar-nav">
            <section class="sidebar-nav-item">
                <span class="sidebar-nav-item-title">
                    <a class="p-3" href="{{ route('profile.order') }}">
                        سفارش های من
                    </a>
                </span>
            </section>
            <section class="sidebar-nav-item">
                <span class="sidebar-nav-item-title">
                    <a class="p-3" href="{{ route('profile.my-addresses.index') }}">
                        آدرس های من
                    </a>
                </span>
            </section>
            <section class="sidebar-nav-item">
                <span class="sidebar-nav-item-title">
                    <a class="p-3" href="{{ route('profile.compares.index') }}">
                        لیست مقایسه
                    </a>
                </span>
            </section>
            <section class="sidebar-nav-item">
                <span class="sidebar-nav-item-title">
                    <a class="p-3" href="{{ route('profile.my-favorites.index') }}">
                        لیست علاقه مندی
                    </a>
                </span>
            </section>
            <section class="sidebar-nav-item">
                <span class="sidebar-nav-item-title">
                    <a class="p-3" href="{{ route('profile.my-tickets.index') }}">
                        مدیریت تیکت ها
                    </a>
                </span>
            </section>
            <section class="sidebar-nav-item">
                <span class="sidebar-nav-item-title">
                    <a class="p-3" href="{{ route('profile.index') }}">
                        ویرایش حساب
                    </a>
                </span>
            </section>
            <section class="sidebar-nav-item">
                <span class="sidebar-nav-item-title">
                    <a class="p-3" href="{{ route('auth.customer.logout') }}">
                        خروج از حساب کاربری
                    </a>
                </span>
            </section>
        </section>
        <!--end sidebar nav-->
    </section>
</aside>
