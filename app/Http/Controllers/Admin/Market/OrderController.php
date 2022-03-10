<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Order;

class OrderController extends Controller
{
    public function newOrders()
    {
        $orders = Order::where('order_status', 0)->get();
        return view('admin.market.order.index', compact('orders'));
    }

    public function sending()
    {
        $orders = Order::where('delivery_status', 1)->get();
        return view('admin.market.order.index', compact('orders'));
    }

    public function unpaid()
    {
        $orders = Order::where('payment_status', 0)->get();
        return view('admin.market.order.index', compact('orders'));
    }

    public function canceled()
    {
        $orders = Order::where('order_status', 4)->get();
        return view('admin.market.order.index', compact('orders'));
    }

    public function returned()
    {
        $orders = Order::where('order_status', 5)->get();
        return view('admin.market.order.index', compact('orders'));
    }

    public function all()
    {
        $orders = Order::all();
        return view('admin.market.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->order_status === 0) {
            $order->order_status = 1;
            $order->save();
        }
        return view('admin.market.order.show', compact('order'));
    }

    public function detail(Order $order)
    {
        return view('admin.market.order.detail', compact('order'));
    }

    public function changeSendStatus(Order $order)
    {
        $order->delivery_status = match ($order->delivery_status) {
            0 => 1,
            1 => 2,
            2 => 3,
            3 => 0,
        };
        $order->save();
        return back();
    }

    public function changeOrderStatus(Order $order)
    {
        $order->order_status = match ($order->order_status) {
            0 => 1,
            1 => 2,
            2 => 3,
            3 => 4,
            4 => 5,
            5 => 0,
        };
        $order->save();
        return back();
    }

    public function cancelOrder(Order $order)
    {
        $order->order_status = 4;
        $order->save();
        return back();
    }
}
