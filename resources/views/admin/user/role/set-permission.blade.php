@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش دسترسی های نقش</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش کاربران</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">نقش ها</a></li>
            <li class="active font-size-12" aria-current="page">ویرایش دسترسی های نقش</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش دسترسی های نقش {{$role->name}}</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.user.role.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.user.role.permission-update', $role->id) }}" method="post">
                        @csrf
                        @method('put')
                        <section class="row">
                            <section class="col-12">
                                <section class="col-12 col-md-5">
                                    <p>توضیح نقش :</p>
                                    <p>{{ $role->description }}</p>
                                </section>
                                <section class="row border-top mt-3 py-3">
                                    @php
                                        $rolePermissionsArray = $role->permissions->pluck('id')->toArray();
                                    @endphp
                                    @foreach($permissions as $key=>$permission)
                                        <section class="col-md-3">
                                            <div class="form-check">
                                                <input name="permissions[]" type="checkbox" class="form-check-input"
                                                       id="{{ $permission->id }}" value="{{ $permission->id }}"
                                                       @if(in_array($permission->id,$rolePermissionsArray)) checked @endif>
                                                <label for="{{ $permission->id }}" class="form-check-label mr-3 mt-1">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                            <div class="mt-2">
                                                @error('permissions.' . $key)
                                                <span class="alert-required bg-danger text-white p-1 rounded"
                                                      role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </section>
                                    @endforeach
                                </section>
                            </section>
                            <section class="col-12 col-md-2 my-2">
                                <button class="btn btn-sm btn-primary mt-4">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>
            </section>
        </section>
    </section>
@endsection
