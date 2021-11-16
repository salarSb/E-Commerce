<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DiscountController extends Controller
{
    public function coupon(): Factory|View|Application
    {
        return view('admin.market.discount.coupon');
    }

    public function couponCreate(): Factory|View|Application
    {
        return view('admin.market.discount.coupon-create');
    }

    public function commonDiscount(): Factory|View|Application
    {
        return view('admin.market.discount.common-discount');
    }

    public function commonDiscountCreate(): Factory|View|Application
    {
        return view('admin.market.discount.common-discount-create');
    }

    public function amazingSale(): Factory|View|Application
    {
        return view('admin.market.discount.amazing-sale');
    }

    public function amazingSaleCreate(): Factory|View|Application
    {
        return view('admin.market.discount.amazing-sale-create');
    }
}
