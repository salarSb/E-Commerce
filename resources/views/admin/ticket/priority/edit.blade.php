@extends('admin.layouts.master')
@section('head-tag')
    <title>ویرایش اولویت تیکت</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش تیکت ها</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">اولویت تیکت ها</a></li>
            <li class="active font-size-12" aria-current="page">ویرایش اولویت تیکت</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش اولویت تیکت</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.ticket.priority.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.ticket.priority.update', $ticketPriority->id) }}" method="post">
                        @csrf
                        @method('put')
                        <section class="row">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="name">نام</label>
                                    <input id="name" name="name" class="form-control form-control-sm"
                                           type="text" value="{{ old('name', $ticketPriority->name) }}">
                                </div>
                                @error('name')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="1"
                                                @if(old('status', $ticketPriority->status) == 1) selected @endif>
                                            فعال
                                        </option>
                                        <option value="0"
                                                @if(old('status', $ticketPriority->status) == 0) selected @endif>
                                            غیر فعال
                                        </option>
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
