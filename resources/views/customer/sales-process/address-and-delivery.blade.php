@extends('customer.layouts.master-two-col')
@section('head-tag')
    <title>انتخاب آدرس</title>
@endsection
@section('content')
    <!-- start cart -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>تکمیل اطلاعات ارسال کالا (آدرس گیرنده، مشخصات گیرنده، نحوه ارسال) </span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>
                    <section class="row mt-4">
                        @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <section class="col-md-9">
                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">
                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            انتخاب آدرس و مشخصات گیرنده
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="address-alert alert alert-primary d-flex align-items-center p-2"
                                         role="alert">
                                    <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                    <secrion>
                                        پس از ایجاد آدرس، آدرس را انتخاب کنید.
                                    </secrion>
                                </section>
                                <section class="address-select">
                                    @foreach($addresses as $address)
                                        <input form="myForm" type="radio" name="address_id" value="{{ $address->id }}"
                                               id="a-{{ $address->id }}"/> <!--checked="checked"-->
                                        <label for="a-{{ $address->id }}" class="address-wrapper mb-2 p-2">
                                            <section class="mb-2">
                                                <i class="fa fa-map-marker-alt mx-1"></i>
                                                آدرس : استان {{ $address->city->getProvince()->name }}
                                                شهر {{ ($address->city->name ?? '-') . ' ' . ($address->address ?? '-') . ' پلاک ' . ($address->no ?? '-') . ' واحد ' . ($address->unit ?? '-')}}
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-user-tag mx-1"></i>
                                                گیرنده : {{ $address->recipient_full_name ?? '-' }}
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-mobile-alt mx-1"></i>
                                                موبایل گیرنده : {{ $address->mobile ?? '-' }}
                                            </section>
                                            <a data-bs-toggle="modal" data-bs-target="#edit-address-{{ $address->id }}">
                                                <i class="fa fa-edit"></i>
                                                ویرایش آدرس
                                            </a>
                                            <span class="address-selected">کالاها به این آدرس ارسال می شوند</span>
                                        </label>
                                        <!-- start edit address Modal -->
                                        <section class="modal fade" id="edit-address-{{ $address->id }}" tabindex="-1"
                                                 aria-labelledby="add-address-label" aria-hidden="true">
                                            <section class="modal-dialog">
                                                <section class="modal-content">
                                                    <section class="modal-header">
                                                        <h5 class="modal-title" id="add-address-label"><i
                                                                class="fa fa-plus"></i>ویرایش آدرس</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </section>
                                                    <section class="modal-body">
                                                        <form class="row" method="post"
                                                              action="{{ route('customer.sales-process.update-address', $address->id) }}">
                                                            @csrf
                                                            @method('put')
                                                            <section class="col-6 mb-2">
                                                                <label for="province"
                                                                       class="form-label mb-1">استان</label>
                                                                <select class="form-select form-select-sm"
                                                                        id="province-{{ $address->id }}">
                                                                    @foreach($provinces as $province)
                                                                        <option
                                                                            @if($address->city->getProvince()->id == $province->id) selected
                                                                            @endif
                                                                            data-url="{{ route('customer.sales-process.get-cities', $province->id) }}">
                                                                            {{ $province->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="city" class="form-label mb-1">شهر</label>
                                                                <select class="form-select form-select-sm"
                                                                        id="city-{{ $address->id }}"
                                                                        name="city_id">
                                                                    <option selected>شهر را انتخاب کنید</option>
                                                                </select>
                                                            </section>
                                                            <section class="col-12 mb-2">
                                                                <label for="address"
                                                                       class="form-label mb-1">نشانی</label>
                                                                <textarea class="form-control form-control-sm"
                                                                          id="address" name="address"
                                                                          placeholder="نشانی">{{ $address->address }}</textarea>
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="postal_code" class="form-label mb-1">کد
                                                                    پستی</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                       id="postal_code" name="postal_code"
                                                                       value="{{ $address->postal_code }}"
                                                                       placeholder="کد پستی">
                                                            </section>

                                                            <section class="col-3 mb-2">
                                                                <label for="no" class="form-label mb-1">پلاک</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                       id="no" name="no" value="{{ $address->no }}"
                                                                       placeholder="پلاک">
                                                            </section>

                                                            <section class="col-3 mb-2">
                                                                <label for="unit" class="form-label mb-1">واحد</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                       id="unit" name="unit"
                                                                       value="{{ $address->unit }}" placeholder="واحد">
                                                            </section>

                                                            <section class="border-bottom mt-2 mb-3"></section>

                                                            <section class="col-12 mb-2">
                                                                <section class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="receiver" name="receiver"
                                                                           @if($address->recipient_first_name) checked @endif>
                                                                    <label class="form-check-label" for="receiver">
                                                                        گیرنده سفارش خودم نیستم (اطلاعات زیر تکمیل شود)
                                                                    </label>
                                                                </section>
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="first_name" class="form-label mb-1">نام
                                                                    گیرنده</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                       id="first_name" name="recipient_first_name"
                                                                       value="{{ $address->recipient_first_name ?? $address->recipient_first_name }}"
                                                                       placeholder="نام گیرنده">
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="last_name" class="form-label mb-1">نام
                                                                    خانوادگی گیرنده</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                       id="last_name" name="recipient_last_name"
                                                                       value="{{ $address->recipient_last_name ?? $address->recipient_last_name }}"
                                                                       placeholder="نام خانوادگی گیرنده">
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="mobile" class="form-label mb-1">شماره
                                                                    موبایل</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                       id="mobile" name="mobile"
                                                                       value="{{ $address->mobile ?? $address->mobile }}"
                                                                       placeholder="شماره موبایل">
                                                            </section>

                                                    </section>
                                                    <section class="modal-footer py-1">
                                                        <button type="submit" class="btn btn-sm btn-primary">ثبت آدرس
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                                data-bs-dismiss="modal">بستن
                                                        </button>
                                                    </section>
                                                    </form>
                                                </section>
                                            </section>
                                        </section>
                                        <!-- end edit address Modal -->
                                    @endforeach
                                    <section class="address-add-wrapper">
                                        <button class="address-add-button" type="button" data-bs-toggle="modal"
                                                data-bs-target="#add-address"><i class="fa fa-plus"></i> ایجاد آدرس جدید
                                        </button>
                                        <!-- start add address Modal -->
                                        <section class="modal fade" id="add-address" tabindex="-1"
                                                 aria-labelledby="add-address-label" aria-hidden="true">
                                            <section class="modal-dialog">
                                                <section class="modal-content">
                                                    <section class="modal-header">
                                                        <h5 class="modal-title" id="add-address-label"><i
                                                                class="fa fa-plus"></i> ایجاد آدرس جدید</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </section>
                                                    <section class="modal-body">
                                                        <form class="row" method="post"
                                                              action="{{ route('customer.sales-process.add-address') }}">
                                                            @csrf
                                                            <section class="col-6 mb-2">
                                                                <label for="province"
                                                                       class="form-label mb-1">استان</label>
                                                                <select class="form-select form-select-sm"
                                                                        id="province">
                                                                    <option selected>استان را انتخاب کنید</option>
                                                                    @foreach($provinces as $province)
                                                                        <option
                                                                            data-url="{{ route('customer.sales-process.get-cities', $province->id) }}">
                                                                            {{ $province->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="city" class="form-label mb-1">شهر</label>
                                                                <select class="form-select form-select-sm" id="city"
                                                                        name="city_id">
                                                                    <option selected>شهر را انتخاب کنید</option>
                                                                </select>
                                                            </section>
                                                            <section class="col-12 mb-2">
                                                                <label for="address"
                                                                       class="form-label mb-1">نشانی</label>
                                                                <textarea class="form-control form-control-sm"
                                                                          id="address" name="address"
                                                                          placeholder="نشانی"></textarea>
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="postal_code" class="form-label mb-1">کد
                                                                    پستی</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                       id="postal_code" name="postal_code"
                                                                       placeholder="کد پستی">
                                                            </section>

                                                            <section class="col-3 mb-2">
                                                                <label for="no" class="form-label mb-1">پلاک</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                       id="no" name="no" placeholder="پلاک">
                                                            </section>

                                                            <section class="col-3 mb-2">
                                                                <label for="unit" class="form-label mb-1">واحد</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                       id="unit" name="unit" placeholder="واحد">
                                                            </section>

                                                            <section class="border-bottom mt-2 mb-3"></section>

                                                            <section class="col-12 mb-2">
                                                                <section class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="receiver" name="receiver">
                                                                    <label class="form-check-label" for="receiver">
                                                                        گیرنده سفارش خودم نیستم (اطلاعات زیر تکمیل شود)
                                                                    </label>
                                                                </section>
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="first_name" class="form-label mb-1">نام
                                                                    گیرنده</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                       id="first_name" name="recipient_first_name"
                                                                       placeholder="نام گیرنده">
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="last_name" class="form-label mb-1">نام
                                                                    خانوادگی گیرنده</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                       id="last_name" name="recipient_last_name"
                                                                       placeholder="نام خانوادگی گیرنده">
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="mobile" class="form-label mb-1">شماره
                                                                    موبایل</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                       id="mobile" name="mobile"
                                                                       placeholder="شماره موبایل">
                                                            </section>

                                                    </section>
                                                    <section class="modal-footer py-1">
                                                        <button type="submit" class="btn btn-sm btn-primary">ثبت آدرس
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                                data-bs-dismiss="modal">بستن
                                                        </button>
                                                    </section>
                                                    </form>
                                                </section>
                                            </section>
                                        </section>
                                        <!-- end add address Modal -->
                                    </section>
                                </section>
                            </section>
                            <section class="content-wrapper bg-white p-3 rounded-2 mb-4">
                                <!-- start vontent header -->
                                <section class="content-header mb-3">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <h2 class="content-header-title content-header-title-small">
                                            انتخاب نحوه ارسال
                                        </h2>
                                        <section class="content-header-link">
                                            <!--<a href="#">مشاهده همه</a>-->
                                        </section>
                                    </section>
                                </section>
                                <section class="delivery-select ">
                                    <section class="address-alert alert alert-primary d-flex align-items-center p-2"
                                             role="alert">
                                        <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                        <secrion>
                                            نحوه ارسال کالا را انتخاب کنید. هنگام انتخاب لطفا مدت زمان ارسال را در نظر
                                            بگیرید.
                                        </secrion>
                                    </section>
                                    @foreach($deliveryMethods as $deliveryMethod)
                                        <input form="myForm" type="radio" name="delivery_id" class="method"
                                               data-delivery-method-price="{{ $deliveryMethod->amount }}"
                                               value="{{ $deliveryMethod->id }}"
                                               id="d-{{ $deliveryMethod->id }}"/>
                                        <label for="d-{{ $deliveryMethod->id }}"
                                               class="col-12 col-md-4 delivery-wrapper mb-2 pt-2">
                                            <section class="mb-2">
                                                <i class="fa fa-shipping-fast mx-1"></i>
                                                {{ $deliveryMethod->name }}
                                            </section>
                                            <section class="mb-2">
                                                <i class="fa fa-calendar-alt mx-1"></i>
                                                تامین کالا
                                                از {{ $deliveryMethod->delivery_time }} {{ $deliveryMethod->delivery_time_unit }}
                                                کاری آینده
                                            </section>
                                        </label>
                                    @endforeach
                                </section>
                            </section>
                        </section>
                        <section class="col-md-3">
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                @php
                                    $productPrice = 0;
                                    $totalProductPrice = 0;
                                    $totalDiscount = 0;
                                @endphp
                                @foreach($cartItems as $cartItem)
                                    @php
                                        $productPrice += $cartItem->total_product_price;
                                        $totalProductPrice += $cartItem->final_price;
                                        $totalDiscount += $cartItem->final_discount;
                                    @endphp
                                @endforeach
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">قیمت کالاها ({{ $cartItems->count() }})</p>
                                    <p class="text-muted" id="total-product-price">{{ priceFormat($productPrice) }}
                                        تومان</p>
                                </section>
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">تخفیف کالاها</p>
                                    <p class="text-danger fw-bolder"
                                       id="total-discount">{{ priceFormat($totalDiscount) }} تومان</p>
                                </section>
                                <section class="border-bottom mb-3"></section>
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">جمع سبد خرید</p>
                                    <p class="fw-bolder"
                                       id="total-price">{{ priceFormat($totalProductPrice) }}
                                        تومان
                                    </p>
                                </section>
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">هزینه ارسال</p>
                                    <p id="delivery-price" class="text-warning"></p>
                                </section>
                                <p class="my-3">
                                    <i class="fa fa-info-circle me-1"></i> کاربر گرامی کالاها بر اساس نوع ارسالی که
                                    انتخاب می کنید در مدت زمان ذکر شده ارسال می شود.
                                </p>
                                <section class="border-bottom mb-3"></section>
                                <form action="{{route('customer.sales-process.choose-address-and-delivery')}}"
                                      id="myForm" method="post">
                                    @csrf
                                </form>
                                <button
                                    class="btn btn-danger w-100"
                                    type="button" onclick="document.getElementById('myForm').submit();">
                                    ادامه فرایند خرید
                                </button>
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end cart -->
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            $('#province').change(function () {
                const element = $('#province option:selected');
                const url = element.attr('data-url');
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        if (response.status) {
                            let cities = response.cities;
                            $('#city').empty();
                            cities.map(city => {
                                $('#city').append($('<option/>').val(city.id).text(city.name));
                            });
                        } else {
                            errorToast('شهری وجود ندارد');
                        }
                    },
                    error: function (error) {
                        errorToast('عملیات با خطا مواجه شد');
                    }
                });
            });

            //edit
            const addresses = {!! auth()->user()->addresses !!}
            addresses.map(address => {
                const id = address.id;
                const target = `#province-${id}`;
                const selected = `${target} option:selected`;
                $(target).change(function () {
                    const element = $(selected);
                    const url = element.attr('data-url');
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function (response) {
                            if (response.status) {
                                let cities = response.cities;
                                $(`#city-${id}`).empty();
                                cities.map(city => {
                                    $(`#city-${id}`).append($('<option/>').val(city.id).text(city.name));
                                });
                            } else {
                                errorToast('شهری وجود ندارد');
                            }
                        },
                        error: function (error) {
                            errorToast('عملیات با خطا مواجه شد');
                        }
                    });
                })
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            bill();
            $('.method').click(function () {
                bill();
            });
        });

        function bill() {
            if (!$('.method').is(':checked')) {
                $('#delivery-price').html('انتخاب نشده');
            } else {
                let deliveryMethodPrice = parseFloat($('input[name="delivery_id"]:checked').data('delivery-method-price'));
                if (deliveryMethodPrice === 0) {
                    $('#delivery-price').html('رایگان');
                } else {
                    $('#delivery-price').html(toFarsiNumber(deliveryMethodPrice) + ' تومان');
                }
            }

            function toFarsiNumber(number) {
                const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
                // add comma
                number = new Intl.NumberFormat().format(number);
                //convert to persian
                return number.toString().replace(/\d/g, x => farsiDigits[x]);
            }
        }
    </script>
@endpush
