@extends('admin.layouts.master')
@section('head-tag')
    <title>ایجاد نقش ادمین</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">کاربران ادمین</a></li>
            <li class="active font-size-12" aria-current="page">ایجاد نقش ادمین</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ایجاد نقش ادمین</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.adminUser.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.user.adminUser.roles.store', $user->slug) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="roles">نقش ها</label>
                                    <p>اگر خالی بگذارید تمامی نقش های کاربر حذف میشوند</p>
                                    <select class="form-control form-control-sm" id="roles" name="roles[]" multiple>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}"
                                                    @foreach($user->roles as $userRole)
                                                    @if($role->id === $userRole->id) selected @endif
                                                @endforeach>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('roles.*')
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
        const roles = $('#roles')
        roles.select2({
            placeholder: 'نقش ها را انتخاب کنید',
            multiple: true,
            tags: true
        })
    </script>
@endsection
