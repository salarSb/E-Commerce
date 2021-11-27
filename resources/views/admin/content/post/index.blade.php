@extends('admin.layouts.master')
@section('head-tag')
    <title>پست ها</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوا</a></li>
            <li class="active font-size-12" aria-current="page">پست ها</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>پست ها</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.post.create') }}" class="btn btn-info btn-sm">
                        ایجاد پست
                    </a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" class="form-control form-control-sm form-text">
                    </div>
                </section>
                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان پست</th>
                            <th>دسته</th>
                            <th>تصویر</th>
                            <th>وضعیت</th>
                            <th>امکان درج کامنت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs ml-1"></i>تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->postCategory->name }}</td>
                                <td>
                                    <img
                                        src="{{ asset($post->image['indexArray'][$post->image['currentImage']]) }}"
                                        alt="post image"
                                        width="50" height="50">
                                </td>
                                <td>
                                    <label>
                                        <input id="{{ $post->id }}"
                                               onchange="changeStatus({{ $post->id }})" type="checkbox"
                                               data-url="{{ route('admin.content.post.status', $post->slug) }}"
                                               @if($post->status === 1) checked @endif>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input id="{{ $post->id }}-commentable"
                                               onchange="commentable({{ $post->id }})" type="checkbox"
                                               data-url="{{ route('admin.content.post.commentable', $post->slug) }}"
                                               @if($post->commentable === 1) checked @endif>
                                    </label>
                                </td>
                                <td class="width-16-rem text-left">
                                    <a href="{{ route('admin.content.post.edit', $post->slug) }}"
                                       class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit ml-1"></i>
                                        ویرایش
                                    </a>
                                    <form action="{{ route('admin.content.post.destroy',$post->slug) }}"
                                          method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm delete"><i
                                                class="fa fa-trash-alt ml-1"></i>
                                            حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        function changeStatus(id) {
            let element = $('#' + id);
            let url = element.attr('data-url');
            let elementValue = !element.prop('checked');
            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    if (response.status) {
                        if (response.checked) {
                            element.prop('checked', true);
                            successToast('پست با موفقیت فعال شد')
                        } else {
                            element.prop('checked', false);
                            successToast('پست با موفقیت غیر فعال شد')
                        }
                    } else {
                        element.prop('checked', elementValue);
                        errorToast('هنگام ویرایش مشکلی رخ داده است')
                    }
                },
                error: function () {
                    element.prop('checked', elementValue);
                    errorToast('ارتباط برقرار نشد')
                }
            });

            function successToast(message) {
                let successToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(successToastTag);
                $('.toast').toast('show').delay(5000).queue(function () {
                    $(this).remove();
                })
            }

            function errorToast(message) {
                let errorToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(errorToastTag);
                $('.toast').toast('show').delay(5000).queue(function () {
                    $(this).remove();
                })
            }
        }
    </script>
    <script type="text/javascript">
        function commentable(id) {
            let element = $('#' + id + '-commentable');
            let url = element.attr('data-url');
            let elementValue = !element.prop('checked');
            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    if (response.commentable) {
                        if (response.checked) {
                            element.prop('checked', true);
                            successToast('امکان درج کامنت فعال شد')
                        } else {
                            element.prop('checked', false);
                            successToast('امکان درج کامنت غیر فعال شد')
                        }
                    } else {
                        element.prop('checked', elementValue);
                        errorToast('هنگام ویرایش مشکلی رخ داده است')
                    }
                },
                error: function () {
                    element.prop('checked', elementValue);
                    errorToast('ارتباط برقرار نشد')
                }
            });

            function successToast(message) {
                let successToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(successToastTag);
                $('.toast').toast('show').delay(5000).queue(function () {
                    $(this).remove();
                })
            }

            function errorToast(message) {
                let errorToastTag = '<section class="toast" data-delay="5000">\n' +
                    '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
                    '<strong class="ml-auto">' + message + '</strong>\n' +
                    '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
                    '<span aria-hidden="true">&times;</span>\n' +
                    '</button>\n' +
                    '</section>\n' +
                    '</section>';
                $('.toast-wrapper').append(errorToastTag);
                $('.toast').toast('show').delay(5000).queue(function () {
                    $(this).remove();
                })
            }
        }
    </script>
    @include('admin.alerts.sweet-alert.delete-confirm',['className' => 'delete'])
@endsection
