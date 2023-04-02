@extends('admin.layouts.master')
@section('head-tag')
    <title>تیکت ها</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش تیکت ها</a></li>
            <li class="active font-size-12" aria-current="page">تیکت ها</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>نظرات</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="#" class="btn btn-info btn-sm disabled">
                        ایجاد تیکت
                    </a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" class="form-control form-control-sm form-text">
                    </div>
                </section>
                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نویسنده</th>
                            <th>عنوان</th>
                            <th>دسته</th>
                            <th>اولویت</th>
                            <th>ارجاع شده به</th>
                            <th>تیکت مرجع</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs ml-1"></i>تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $ticket->user->full_name }}</td>
                                <td>{{ $ticket->subject }}</td>
                                <td>{{ $ticket->category->display_name }}</td>
                                <td>{{ $ticket->priority->display_name }}</td>
                                <td>{{ $ticket->admin ? $ticket->admin->user->full_name : 'نامشخص' }}</td>
                                <td>{{ $ticket->parent->subject ?? '-' }}</td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.ticket.show', $ticket->id) }}"
                                       class="btn btn-sm btn-info mb-1">
                                        <i class="fa fa-eye ml-1"></i>مشاهده
                                    </a>
                                    <a href="{{ route('admin.ticket.change', $ticket->id) }}"
                                       class="btn btn-sm btn-warning mb-1">
                                        <i class="fa fa-check ml-1"></i>
                                        {{ $ticket->status == 1 ? 'باز کردن' : 'بستن' }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>
@endsection
