<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PaymentController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('admin.market.payment.index');
    }

    public function online(): Factory|View|Application
    {
        return view('admin.market.payment.index');
    }

    public function offline(): Factory|View|Application
    {
        return view('admin.market.payment.index');
    }

    public function attendance(): Factory|View|Application
    {
        return view('admin.market.payment.index');
    }

    public function confirm(): Factory|View|Application
    {
        return view('admin.market.payment.index');
    }
}
