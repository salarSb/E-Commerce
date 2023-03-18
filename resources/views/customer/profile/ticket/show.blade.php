@extends('customer.layouts.master-two-col')
@section('head-tag')
    <title>تیکت های شما</title>
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
                                <span>مشاهده تیکت</span>
                            </h2>
                            <section class="content-header-link m-2">
                                <a href="{{ route('profile.my-tickets.index') }}"
                                   class="btn btn-sm btn-danger text-white">بازگشت</a>
                            </section>
                        </section>
                    </section>
                    <section class="card my-3">
                        <section class="card-header bg-info">
                            {{ $ticket->user->full_name }}
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
                        @if($ticket->ticketFile)
                            <section class="card-footer">
                                <a href="{{ route('profile.my-tickets.download', $ticket->id) }}"
                                   class="btn btn-success">دانلود ضمیمه</a>
                            </section>
                        @endif
                    </section>
                    <hr>
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
                        <form action="{{ route('profile.my-tickets.answer', $ticket->id) }}"
                              method="post">
                            @csrf
                            <section class="row">
                                <section class="col-12 my-2">
                                    <div class="form-group">
                                        <label for="description">پاسخ تیکت</label>
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
