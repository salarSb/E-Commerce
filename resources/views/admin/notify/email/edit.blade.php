@extends('admin.layouts.master')
@section('head-tag')
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
    <title>ویرایش اطلاعیه ایمیلی</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش اطلاع رسانی</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">اطلاعیه ایمیلی</a></li>
            <li class="active font-size-12" aria-current="page">ویرایش اطلاعیه ایمیلی</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش اطلاعیه ایمیلی</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.notify.email.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form action="{{ route('admin.notify.email.update', $email->id) }}" method="post">
                        @csrf
                        @method('put')
                        <section class="row">
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="subject">عنوان ایمیل</label>
                                    <input id="subject" name="subject" class="form-control form-control-sm" type="text"
                                           value="{{ old('title', $email->subject) }}">
                                </div>
                                @error('subject')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="status">وضعیت</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="1" @if(old('status', $email->status) == 1) selected @endif>
                                            فعال
                                        </option>
                                        <option value="0" @if(old('status', $email->status) == 0) selected @endif>
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
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="user_ids">انتخاب کاربران</label>
                                    <select class="form-control form-control-sm" name="user_ids[]" id="user_ids">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->id }}-{{ $user->fullName ?? 'کاربر' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('user_ids')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="published_at_view">تاریخ انتشار</label>
                                    <input id="published_at" class="form-control form-control-sm d-none" type="text"
                                           name="published_at" value="{{ $email->published_at }}">
                                    <input id="published_at_view" type="text" class="form-control form-control-sm"
                                           value="{{ $email->published_at }}">
                                </div>
                                @error('published_at')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="body">متن ایمیل</label>
                                    <textarea class="form-control form-control-sm" rows="6" id="body"
                                              name="body">{{ old('body', $email->body) }}</textarea>
                                </div>
                                @error('body')
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
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
    <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
    <script>
        CKEDITOR.replace('body')
    </script>
    <script>
        $(document).ready(function () {
            $('#published_at_view').persianDatepicker({
                format: 'YYYY/MM/DD - H:m:s',
                altField: '#published_at',
                timePicker: {
                    enabled: true,
                    meridiem: {
                        enabled: true
                    }
                }
            })
        })
    </script>
    <script>
        $(document).ready(function () {
            let select = $('#user_ids')
            select.val(null);
            const addSelectAll = matches => {
                if (matches.length > 0) {
                    // Insert a special "Select all matches" item at the start of the
                    // list of matched items.
                    return [
                        {id: 'selectAll', text: 'انتخاب تمام کاربران', matchIds: matches.map(match => match.id)},
                        {id: 'deleteAll', text: 'پاک کردن تمام کاربران', matchIds: matches.map(match => match.id)},
                        ...matches
                    ];
                }
            };
            const handleSelection = event => {
                if (event.params.data.id === 'selectAll') {
                    select.val(event.params.data.matchIds);
                    select.trigger('change');
                } else if (event.params.data.id === 'deleteAll') {
                    select.val(null);
                    select.trigger('change');
                }
            };
            select.select2({
                multiple: true,
                placeholder: "جستجو",
                sorter: addSelectAll,
            });
            select.on('select2:select', handleSelection);
        });
    </script>
@endsection
