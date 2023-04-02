@extends('admin.layouts.master')
@section('head-tag')
    <title>نمایش تیکت</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش تیکت ها</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">تیکت ها</a></li>
            <li class="active font-size-12" aria-current="page">نمایش تیکت</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>نمایش تیکت</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.ticket.index') }}" class="btn btn-info btn-sm">
                        بازگشت
                    </a>
                </section>
                <section class="card mb-3">
                    <section class="card-header text-white bg-primary">
                        {{ $ticket->user->full_name }} - {{ $ticket->id }}
                    </section>
                    <section class="card-body">
                        <h5 class="card-title">
                            موضوع:
                            {{ $ticket->subject }}
                        </h5>
                        <p class="card-text">
                            {{ $ticket->description }}
                        </p>
                    </section>
                </section>
                <div class="border">
                    @foreach($ticketAnswers as $ticketAnswer)
                        <section class="card m-4">
                            <section class="card-header bg-light d-flex justify-content-between">
                                <div>{{ $ticketAnswer->user->full_name }}</div>
                                <small>{{ convertEnglishToPersian(jalaliDate($ticketAnswer->created_at,'%A, %d %B %Y ساعت H:m:s')) }}</small>
                            </section>
                            <section class="card-body">
                                <p class="card-text">
                                    {{ $ticketAnswer->description }}
                                </p>
                            </section>
                            @if($ticketAnswer->ticketFile)
                                <section class="card-footer">
                                    <a href="{{ route('profile.my-tickets.download', $ticketAnswer->id) }}"
                                       class="btn btn-success">دانلود ضمیمه</a>
                                </section>
                            @endif
                        </section>
                    @endforeach
                </div>
                <section>
                    <form action="{{ route('admin.ticket.answer', $ticket->id) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <section class="row">
                            <section class="col-12 my-2">
                                <div class="form-group my-2">
                                    <label for="description">پاسخ تیکت</label>
                                    <textarea id="description" name="description" class="form-control form-control-sm"
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
            </section>
        </section>
    </section>
@endsection
