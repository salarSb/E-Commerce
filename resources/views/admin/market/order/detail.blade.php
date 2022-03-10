@extends('admin.layouts.master')
@section('head-tag')
    <title>جزئیات سفارش</title>
@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12 ml-3"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش فروش</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">سفارشات</a></li>
            <li class="active font-size-12" aria-current="page">جزئیات سفارش</li>
        </ol>
    </nav>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>جزئیات سفارش</h5>
                </section>
                <section class="table-responsive">
                    <table class="table table-striped table-hover h-150">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام محصول</th>
                            <th>درصد فروش شگفت انگیز</th>
                            <th>مبلغ فروش شگفت انگیز</th>
                            <th>تعداد</th>
                            <th>جمع قیمت محصول</th>
                            <th>قیمت نهایی</th>
                            <th>رنگ</th>
                            <th>گرانتی</th>
                            <th>ویژگی</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->orderItems as $item)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $item->singleProduct->name }}</td>
                                <td>{{ $item->amazingSale->percentage ?? '-' }}</td>
                                <td>{{ $item->amazing_sale_discount_amount ?? '-' }} تومان</td>
                                <td>{{ $item->number }}</td>
                                <td>{{ $item->final_product_price }} تومان</td>
                                <td>{{ $item->final_total_price }} تومان</td>
                                <td>{{ $item->color->name ?? '-' }}</td>
                                <td>{{ $item->guarantee->name ?? '-' }}</td>
                                <td>
                                    @forelse($item->orderItemAttributes as $attribute)
                                        {{ $attribute->categoryAttribute->name ?? '-' }}
                                        :
                                        {{ json_decode($attribute->categoryAttributeValue->value)->value ?? '-' }}
                                    @empty
                                        -
                                    @endforelse
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
