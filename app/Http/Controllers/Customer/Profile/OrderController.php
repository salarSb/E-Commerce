<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->orders()->orderBy('id', 'desc');
        $type = $request->query('type');
        $orders = isset($type) ? $query->where('order_status', $type)->get() : $query->get();
        return view('customer.profile.orders', compact('orders'));
    }
}
