@extends('admin.layouts.master')
@section('head-tag')
    <title>نمایش تیکت</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش تیکت ها</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">تیکت ها</a></li>
            <li class="active font-size-12" aria-current="page">نمایش تیکت</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>نمایش تیکت</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.ticket.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section class="card mb-3">
                    <section class="card-header text-white bg-primary">
                        کامران محمدی - 4331231
                    </section>
                    <section class="card-body">
                        <h5 class="card-title">
                            موضوع:
                            پرداخت انجام نمیشه!
                        </h5>
                        <p class="card-text">
                            من میخواهم پرداخت کنم ولی درگاه مشکل دارد.
                        </p>
                    </section>
                </section>
                <section>
                    <form action="" method="">
                        <section class="row">
                            <section class="col-12">
                                <div class="form-group">
                                    <label>پاسخ تیکت</label>
                                    <textarea class="form-control form-control-sm" rows="4"></textarea>
                                </div>
                            </section>
                        </section>
                        <button class="btn btn-sm btn-primary">ثبت</button>
                    </form>
                </section>
            </section>
        </section>
    </section>
@endsection
