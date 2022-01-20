@extends('admin.layouts.master')
@section('head-tag')
    <title>نقش ها</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="active font-size-12" aria-current="page">نقش ها</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>نقش ها</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.role.create') }}" class="btn btn-info btn-sm">
                        ایجاد نقش جدید
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
                            <th>نام نقش</th>
                            <th>دسترسی ها</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs ml-1"></i>تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @if(empty($role->permissions()->get()->toArray()))
                                        <span class="text-danger">برای این نقش هیچ سطح دسترسی تعریف نشده</span>
                                    @else
                                        @foreach($role->permissions as $permission)
                                            {{ $permission->name }}<br>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="width-22-rem text-left">
                                    <a href="{{ route('admin.user.role.permission-form', $role->id) }}"
                                       class="btn btn-sm btn-success">
                                        <i class="fa fa-user-graduate ml-1"></i>
                                        دسترسی ها
                                    </a>
                                    <a href="{{ route('admin.user.role.edit',$role->id) }}"
                                       class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit ml-1"></i>
                                        ویرایش
                                    </a>
                                    <form action="{{ route('admin.user.role.destroy',$role->id) }}"
                                          method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm delete"><i
                                                class="fa fa-trash-alt ml-1"></i>
                                            حذف
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
    @include('admin.alerts.sweet-alert.delete-confirm',['className' => 'delete'])
@endsection
