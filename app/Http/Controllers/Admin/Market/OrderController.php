<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class OrderController extends Controller
{
    public function newOrders(): Factory|View|Application
    {
        return view('admin.market.order.index');
    }

    public function sending(): Factory|View|Application
    {
        return view('admin.market.order.index');
    }

    public function unpaid(): Factory|View|Application
    {
        return view('admin.market.order.index');
    }

    public function canceled(): Factory|View|Application
    {
        return view('admin.market.order.index');
    }

    public function returned(): Factory|View|Application
    {
        return view('admin.market.order.index');
    }

    public function all(): Factory|View|Application
    {
        return view('admin.market.order.index');
    }

    public function show(): Factory|View|Application
    {
        return view('admin.market.order.index');
    }

    public function changeSendStatus(): Factory|View|Application
    {
        return view('admin.market.order.index');
    }

    public function changeOrderStatus(): Factory|View|Application
    {
        return view('admin.market.order.index');
    }

    public function cancelOrder(): Factory|View|Application
    {
        return view('admin.market.order.index');
    }
}
