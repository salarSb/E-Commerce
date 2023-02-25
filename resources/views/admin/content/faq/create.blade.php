@extends('admin.layouts.master')
@section('head-tag')
    <title>ایجاد سوال جدید</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوا</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">سوالات متداول</a></li>
            <li class="active font-size-12" aria-current="page">ایجاد سوال جدید</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ایجاد سوال جدید</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.faq.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section>
                    <form id="form" action="{{ route('admin.content.faq.store') }}" method="post">
                        @csrf
                        <section class="row">
                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="question">پرسش</label>
                                    <input type="text" class="form-control form-control-sm" id="question"
                                           name="question" value="{{ old('question') }}">
                                </div>
                                @error('question')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="answer">پاسخ</label>
                                    <textarea class="form-control form-control-sm" rows="6" id="answer" name="answer">{{ old('answer') }}</textarea>
                                </div>
                                @error('answer')
                                <span class="alert-required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </section>
                            <section class="col-12 col-md-6 my-2">
                                <div class="form-group">
                                    <label for="select-tags">برچسب ها</label>
                                    <input class="form-control form-control-sm" type="hidden" name="tags" id="tags"
                                           value="{{ old('tags') }}">
                                    <select class="select2 form-control form-control-sm" id="select-tags"
                                            multiple></select>
                                </div>
                                @error('tags')
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
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('answer')
    </script>
    <script>
        $(document).ready(function () {
            let tags_input = $('#tags');
            let select_tags = $('#select-tags');
            let default_tags = tags_input.val();
            let default_data = null;
            if (tags_input.val() !== null && tags_input.val().length > 0) {
                default_data = default_tags.split(',')
            }
            select_tags.select2({
                placeholder: 'لطفا تگ های خود را وارد نمایید',
                tags: true,
                data: default_data
            });
            select_tags.children('option').attr('selected', true).trigger('change');
            $('#form').submit(function () {
                if (select_tags.val() !== null && select_tags.val().length > 0) {
                    let selectedSource = select_tags.val().join(',');
                    tags_input.val(selectedSource);
                }
            });
        })
    </script>
@endsection
