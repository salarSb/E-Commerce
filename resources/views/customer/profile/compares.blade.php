@extends('customer.layouts.master-two-col')
@section('head-tag')
    <title>لیست مقایسه شما</title>
@endsection
@section('content')
    <!-- start body -->
    <section class="">
        <section id="main-body-two-col" class="container-xxl body-container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <section class="row">
                @include('customer.layouts.partials.profile-sidebar')
                <main id="main-body" class="main-body col-md-9">
                    <section class="content-wrapper bg-white p-3 rounded-2 mb-2">
                        <!-- start vontent header -->
                        <section class="content-header mb-4">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>لیست مقایسه من</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- end vontent header -->
                        <table class="table table-striped table-borderless">
                            <thead>
                            <tr>
                                <th>عکس</th>
                                <th>نام</th>
                                <th>قیمت</th>
                                <th>حذف از لیست مقایسه</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        <a href="{{ route('customer.market.product', $product->slug) }}">
                                            <img
                                                src="{{ asset($product->image['indexArray']['small']) }}"
                                                alt="{{ $product->name }}">
                                        </a>
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ priceFormat($product->price) }}</td>
                                    <td>
                                        <form method="post"
                                              action="{{ route('profile.compares.delete', $product->slug) }}">
                                            @method('delete')
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-link btn-sm text-decoration-none cart-delete -border-none">
                                                <i class="fa fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </section>
                </main>
            </section>
        </section>
    </section>
    <!-- end body -->
@endsection
