@extends('admin.layouts.master')
@section('head-tag')
    <title>ادمین تیکت</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش تیکت ها</a></li>
            <li class="active font-size-12" aria-current="page">ادمین تیکت</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ادمین تیکت</h5>
                </section>
                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ایمیل</th>
                            <th>نام</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs ml-1"></i>تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $admin)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->full_name }}</td>
                                <td class="width-22-rem text-left">
                                    <a href="{{ route('admin.ticket.admin.set', $admin->slug) }}"
                                       class="btn btn-sm btn-{{ $admin->ticketAdmin == null ? 'success' : 'danger' }}">
                                        <i class="fa fa-{{ $admin->ticketAdmin == null ? 'check' : 'delete' }} ml-1"></i>
                                        {{ $admin->ticketAdmin == null ? 'اضافه' : 'حذف' }}
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
