@extends('admin.layouts.master')
@section('head-tag')
    <title>ایجاد منو</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوا</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">منو</a></li>
            <li class="active font-size-12" aria-current="page">ایجاد منو</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ایجاد منو</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.menu.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.content.menu.store') }}" method="post">
                        @csrf
                        <section class="row">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="name">نام منو</label>
                                    <input class="form-control form-control-sm" type="text" name="name" id="name"
                                           value="{{ old('name') }}">
                                </div>
                                @error('name')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="parent_id">منو والد</label>
                                    <select class="form-control form-control-sm" name="parent_id" id="parent_id">
                                        <option value="">ندارد</option>
                                        @foreach($menus as $menu)
                                            <option value="{{ $menu->id }}"
                                                    @if(old('parent_id') == $menu->id) selected @endif>
                                                {{ $menu->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('parent_id')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="url">آدرس اینترنتی</label>
                                    <input class="form-control form-control-sm" type="text" name="url" id="url"
                                           value="{{old('url')}}">
                                </div>
                                @error('url')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="1" @if(old('status') == 1) selected @endif>فعال</option>
                                        <option value="0" @if(old('status') == 0) selected @endif>غیر فعال</option>
                                    </select>
                                </div>
                                @error('status')
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
        $(document).ready(function () {
            $("#parent_id").select2();
        });
    </script>
@endsection
