<?php

namespace App\Http\Controllers\Admin\Notify;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('admin.notify.sms.index');
    }

    public function create(): Factory|View|Application
    {
        return view('admin.notify.sms.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
