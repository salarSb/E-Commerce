@extends('customer.layouts.master-two-col')
@section('head-tag')
    <title>تیکت های شما</title>
@endsection
@section('content')
    <section id="main-body-two-col" class="container-xxl body-container">
        <section class="row">
            @include('customer.layouts.partials.profile-sidebar')
            <main id="main-body" class="main-body col-md-9">
                <section class="content-wrapper bg-white p-3 rounded-2 mb-2">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>تاریخچه تیکت ها</span>
                            </h2>
                            <section class="content-header-link m-2">
                                <a href="{{ route('profile.my-tickets.create') }}"
                                   class="btn btn-sm btn-success text-white">ارسال تیکت جدید</a>
                            </section>
                        </section>
                    </section>
                    <!-- end vontent header -->
                    <section class="d-flex justify-content-center my-4">
                        <a class="btn btn-outline-success btn-sm mx-1"
                           href="{{ route('profile.my-tickets.index') }}">
                            همه
                        </a>
                        <a class="btn btn-primary btn-sm mx-1"
                           href="{{ route('profile.my-tickets.index','type=0') }}">
                            باز
                        </a>
                        <a class="btn btn-outline-danger btn-sm mx-1"
                           href="{{ route('profile.my-tickets.index','type=1') }}">
                            بسته
                        </a>
                    </section>
                    <!-- start content header -->
                    @if(count($tickets) < 1)
                        <section class="order-item">
                            <section class="d-flex justify-content-between">
                                <p>تیکتی یافت نشد</p>
                            </section>
                        </section>
                    @else
                        <section class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>متن</th>
                                    <th>وضعیت</th>
                                    <th>دسته</th>
                                    <th>اولویت</th>
                                    <th>ارجاع شده به</th>
                                    <th class="max-width-16-rem text-center"><i class="fa fa-cogs ml-1"></i>تنظیمات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $ticket->subject }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($ticket->description,25) }}</td>
                                        <td>{{ $ticket->status === 0 ? 'باز' : 'بسته' }}</td>
                                        <td>{{ $ticket->category->name }}</td>
                                        <td>{{ $ticket->priority->name }}</td>
                                        <td>{{ $ticket->admin ? $ticket->admin->user->full_name : 'نامشخص' }}</td>
                                        <td class="width-16-rem text-left">
                                            <a href="{{ route('profile.my-tickets.show', $ticket->id) }}"
                                               class="btn btn-sm btn-info mb-1">
                                                <i class="fa fa-eye ml-1"></i>
                                            </a>
                                            <a href="{{ route('profile.my-tickets.change', $ticket->id) }}"
                                               class="btn btn-sm btn-warning mb-1">
                                                <i class="fa fa-{{ $ticket->status == 1 ? 'check' : 'times' }} ml-1"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </section>
                @endif
                <!-- end content header -->
                </section>
            </main>
        </section>
    </section>
@endsection
