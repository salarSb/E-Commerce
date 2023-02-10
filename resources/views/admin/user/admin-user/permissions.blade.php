@extends('admin.layouts.master')
@section('head-tag')
    <title>ایجاد دسترسی ادمین</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">کاربران ادمین</a></li>
            <li class="active font-size-12" aria-current="page">ایجاد دسترسی ادمین</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ایجاد دسترسی ادمین</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.adminUser.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.user.adminUser.permissions.store', $user->slug) }}" method="post">
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="permissions">دسترسی ها</label>
                                    <p>اگر خالی بگذارید تمامی دسترسی های کاربر حذف میشوند</p>
                                    <select class="form-control form-control-sm" id="permissions" name="permissions[]"
                                            multiple>
                                        @foreach($permissions as $permission)
                                            <option value="{{ $permission->id }}"
                                                    @foreach($user->permissions as $userPermission)
                                                    @if($permission->id === $userPermission->id) selected @endif
                                                @endforeach>
                                                {{ $permission->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('permissions.*')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                        </section>
                        <button class="btn btn-sm btn-primary">ثبت</button>
                    </form>
                </section>
            </section>
        </section>
    </section>
@endsection
@section('script')
    <script>
        const permissions = $('#permissions')
        permissions.select2({
            placeholder: 'دسترسی ها را انتخاب کنید',
            multiple: true,
            tags: true
        })
    </script>
@endsection
