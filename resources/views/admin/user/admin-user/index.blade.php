@extends('admin.layouts.master')
@section('head-tag')
    <title>کاربران ادمین</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="active font-size-12" aria-current="page">کاربران ادمین</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>کاربران ادمین</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.adminUser.create') }}" class="btn btn-info btn-sm">
                        ایجاد ادمین جدید
                    </a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" class="form-control form-control-sm form-text">
                    </div>
                </section>
                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ایمیل</th>
                            <th>شماره موبایل</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>فعالسازی(کاربر ایمیل خود را فعال کرده یا خیر)</th>
                            <th>وضعیت</th>
                            <th>نقش ها</th>
                            <th>دسترسی ها</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs ml-1"></i>تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $admin)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->mobile }}</td>
                                <td>{{ $admin->first_name }}</td>
                                <td>{{ $admin->last_name }}</td>
                                <td>
                                    <label>
                                        <input id="{{ $admin->id }}-active"
                                               onchange="changeActivation({{ $admin->id }})" type="checkbox"
                                               data-url="{{ route('admin.user.adminUser.activation', $admin->slug) }}"
                                               @if($admin->activation === 1) checked @endif>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input id="{{ $admin->id }}"
                                               onchange="changeStatus({{ $admin->id }})" type="checkbox"
                                               data-url="{{ route('admin.user.adminUser.status', $admin->slug) }}"
                                               @if($admin->status === 1) checked @endif>
                                    </label>
                                </td>
                                <td>
                                    @forelse($admin->roles as $role)
                                        {{ $role->name }}<br>
                                    @empty
                                        <span class="text-danger">برای این کاربر هیچ نقشی تعریف نشده</span>
                                    @endforelse
                                </td>
                                <td>
                                    @forelse($admin->permissions as $permission)
                                        {{ $permission->name }}<br>
                                    @empty
                                        <span class="text-danger">برای این کاربر هیچ سطح دسترسی تعریف نشده</span>
                                    @endforelse
                                </td>
                                <td class="width-22-rem text-left">
                                    <a href="{{ route('admin.user.adminUser.roles.create', $admin->slug) }}"
                                       class="btn btn-warning btn-sm">
                                        <i class="fa fa-user-check"></i>
                                    </a>
                                    <a href="{{ route('admin.user.adminUser.permissions.create', $admin->slug) }}"
                                       class="btn btn-info btn-sm">
                                        <i class="fa fa-user-shield"></i>
                                    </a>
                                    <a href="{{ route('admin.user.adminUser.edit', $admin->slug) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form class="d-inline"
                                          action="{{ route('admin.user.adminUser.destroy',$admin->slug) }}"
                                          method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm delete" type="submit">
                                            <i class="fa fa-trash-alt"></i>
                                        </button>
                                    </form>
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
@section('script')
    <script type="text/javascript">
        function changeStatus(id) {
            let element = $('#' + id);
            let url = element.attr('data-url');
            let elementValue = !element.prop('checked');
            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true);
                            successToast('کاربر ادمین با موفقیت فعال شد')
                        } else {
                            element.prop('checked', false);
                            successToast('کاربر ادمین با موفقیت غیر فعال شد')
                        }
                    } else {
                        element.prop('checked', elementValue);
                        errorToast('هنگام ویرایش مشکلی رخ داده است')
                    }
                },
                error: function () {
                    element.prop('checked', elementValue);
                    errorToast('ارتباط برقرار نشد')
                }
            });

            function successToast(message) {
                let successToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(successToastTag);
                $('.toast').toast('show').delay(5000).queue(function () {
                    $(this).remove();
                })
            }

            function errorToast(message) {
                let errorToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(errorToastTag);
                $('.toast').toast('show').delay(5000).queue(function () {
                    $(this).remove();
                })
            }
        }
    </script>
    <script type="text/javascript">
        function changeActivation(id) {
            let element = $('#' + id + '-active');
            let url = element.attr('data-url');
            let elementValue = !element.prop('checked');
            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true);
                            successToast('فعالسازی ادمین با موفقیت انجام شد')
                        } else {
                            element.prop('checked', false);
                            successToast('غیر فعالسازی ادمین با موفقیت انجام شد')
                        }
                    } else {
                        element.prop('checked', elementValue);
                        errorToast('هنگام ویرایش مشکلی رخ داده است')
                    }
                },
                error: function () {
                    element.prop('checked', elementValue);
                    errorToast('ارتباط برقرار نشد')
                }
            });

            function successToast(message) {
                let successToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(successToastTag);
                $('.toast').toast('show').delay(5000).queue(function () {
                    $(this).remove();
                })
            }

            function errorToast(message) {
                let errorToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(errorToastTag);
                $('.toast').toast('show').delay(5000).queue(function () {
                    $(this).remove();
                })
            }
        }
    </script>
    @include('admin.alerts.sweet-alert.delete-confirm',['className' => 'delete'])
@endsection
