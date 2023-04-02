@extends('customer.layouts.master-two-col')
@section('head-tag')
    <title>افزودن تیکت</title>
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
                                <span>افزودن تیکت</span>
                            </h2>
                            <section class="content-header-link m-2">
                                <a href="{{ route('profile.my-tickets.index') }}"
                                   class="btn btn-sm btn-danger text-white">بازگشت</a>
                            </section>
                        </section>
                    </section>
                    <section>
                        <form action="{{ route('profile.my-tickets.store') }}"
                              method="post" enctype="multipart/form-data">
                            @csrf
                            <section class="row">
                                <section class="col-12 col-md-4  my-2">
                                    <div class="form-group my-2">
                                        <label for="subject">موضوع</label>
                                        <input id="subject" name="subject"
                                               class="form-control form-control-sm" value="{{ old('subject') }}">
                                    </div>
                                    @error('subject')
                                    <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </section>
                                <section class="col-12 col-md-4 my-2">
                                    <div class="form-group my-2">
                                        <label for="category_id">انتخاب دسته</label>
                                        <select class="form-control form-control-sm" name="category_id"
                                                id="category_id">
                                            @foreach($ticketCategories as $ticketCategory)
                                                <option value="{{ $ticketCategory->id }}"
                                                        @if(old('category_id') == $ticketCategory->id) selected @endif>
                                                    {{ $ticketCategory->display_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')
                                    <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </section>
                                <section class="col-12 col-md-4 my-2">
                                    <div class="form-group my-2">
                                        <label for="priority_id">انتخاب اولویت</label>
                                        <select class="form-control form-control-sm" name="priority_id"
                                                id="priority_id">
                                            @foreach($ticketPriorities as $ticketPriority)
                                                <option value="{{ $ticketPriority->id }}"
                                                        @if(old('priority_id') == $ticketPriority->id) selected @endif>
                                                    {{ $ticketPriority->display_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('priority_id')
                                    <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </section>
                                <section class="col-12 my-2">
                                    <div class="form-group my-2">
                                        <label for="description">متن</label>
                                        <textarea id="description" name="description"
                                                  class="form-control form-control-sm"
                                                  rows="4">{{ old('description') }}</textarea>
                                    </div>
                                    @error('description')
                                    <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </section>
                                <section class="col-12 col-md-6 my-2">
                                    <div class="form-group my-2">
                                        <label for="file">فایل</label>
                                        <input class="form-control form-control-sm" type="file" name="file" id="file">
                                    </div>
                                    @error('file')
                                        <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </section>
                            </section>
                            <button class="btn btn-sm btn-primary">ثبت</button>
                        </form>
                    </section>
                    <!-- end content header -->
                </section>
            </main>
        </section>
    </section>
@endsection
