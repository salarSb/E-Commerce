@extends('admin.layouts.master')
@section('head-tag')
    <title>رنگ کالا</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">کالاها</a></li>
            <li class="active font-size-12" aria-current="page">رنگ کالا</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>رنگ کالا</h5>
                </section>
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.market.product.color.create', $product->slug) }}"
                       class="btn btn-info btn-sm">
                        ایجاد رنگ جدید
                    </a>
                    <div class="max-width-16-rem">
                        <input type="text" placeholder="جستجو" class="form-control form-control-sm form-text">
                    </div>
                </section>
                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام کالا</th>
                            <th>رنگ کالا</th>
                            <th>افزایش قیمت</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs ml-1"></i>تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product->colors as $color)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $color->name }}</td>
                                <td>{{ $color->price_increase }} تومان</td>
                                <td>
                                    <label>
                                        <input id="{{ $color->id }}"
                                               onchange="changeStatus({{ $color->id }})" type="checkbox"
                                               data-url="{{ route('admin.market.product.color.status', $color->id) }}"
                                               @if($color->status === 1) checked @endif>
                                    </label>
                                </td>
                                <td class="width-16-rem text-left">
                                    <form
                                        action="{{ route('admin.market.product.color.destroy',
                                                    ['product'=>$product->slug, 'color'=>$color->id]) }}"
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
                            successToast('رنگ کالا با موفقیت فعال شد')
                        } else {
                            element.prop('checked', false);
                            successToast('رنگ کالا با موفقیت غیر فعال شد')
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
