@extends('layout.master')

@section('title', 'Giỏ hàng')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/giohang.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}">
@endpush

@section('content')
    @if ($carts->count() > 0)
        <div class="container p-3">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12 ">
                    <div class="check-all-store store-title">
                        <input type="checkbox" id="checkall-store" data-url="{{route('cart.updateCheckout')}}">
                        <label for="checkall-store">
                            <span>Chọn tất cả</span>
                        </label>
                    </div>
                    <div class="list-stores">
                        @foreach ($carts as $cart_store)
                            <div class="cart-block" id="store-b-{{ $cart_store->store->id }}">
                                <div class="store-title">
                                    <input type="checkbox" id="store-{{ $cart_store->store->id }}"
                                        value="{{ $cart_store->store->id }}">
                                    <label for="store-{{ $cart_store->store->id }}">Cửa hàng
                                        <span>{{ $cart_store->store->title }}</span>
                                        <span>- {{ $cart_store->cart_item->sum('quantity') }}</span> sản phẩm
                                        </span>
                                    </label>
                                </div>
                                <hr>
                                <div id="store-cart">
                                    <div class="row row-head d-md-flex d-none">
                                        <div class="col-lg-2 col-md-2 col-xs-12 ">
                                            <b>Ảnh</b>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-xs-12 ">
                                            <b>Mã sản phẩm</b>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-xs-12 ">
                                            <b>Tên sản phẩm</b>
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-xs-3 ">
                                            <b> C</b>
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-xs-3 ">
                                            <b> M</b>
                                        </div>

                                        <div class="col-lg-2 col-md-2 col-xs-3 ">
                                            <b> Đơn giá</b>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-xs-3 ">
                                            <b> Số lượng</b>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-xs-3">

                                        </div>
                                    </div>
                                    @foreach ($cart_store->cart_item as $item)
                                   
                                        <div class="row cart_item">
                                            <div class="col-lg-2 col-md-2 col-xs-12 d-flex align-items-center  ">
                                                <a href="{{ route('san-pham.show', $item->product->slug) }}">
                                                    <img src="{{ showImageWithError($item->product->feature_img) }}"
                                                        class="w-50">
                                                </a>
                                            </div>
                                            <div class="col-lg-1 col-md-2 col-5 ml-3 d-block d-sm-none">
                                                <b> Mã sản phẩm</b>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 d-flex align-items-center ">
                                                <span>
                                                    {{ $item->product->sku }}{{ $item->product->is_variation == 1 ? '-' . $item->variation->sku : '' }}</span>
                                            </div>
                                            <div class="col-lg-1 col-md-2 col-5 ml-3 d-block d-sm-none">
                                                <b>Tên sản phẩm</b>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 d-flex align-items-center ">
                                                <a href="{{ route('san-pham.show', $item->product->slug) }}"
                                                    class="cart-item-name">{{ $item->product->title }}
                                                    {{ $item->product->is_variation == 1 ? $item->variation->name : '' }}</a>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-5 ml-3 d-block d-sm-none">
                                                <b>C</b>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-4 d-flex align-items-center ">
                                                <span> {{ formatNumber($item->product->product_price->cpoint) }}</span>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-5 ml-3 d-block d-sm-none">
                                                <b>M</b>
                                            </div>
                                            <div class="col-lg-1 col-md-2 col-4 d-flex align-items-center ">
                                                <span> {{ formatNumber($item->product->product_price->mpoint) }}</span>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-5 ml-3 d-block d-sm-none">
                                                <b>Đơn giá</b>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-6 d-flex align-items-center ">
                                                <b>{!! $item->is_ecard == 1
                                                    ? formatCurrency($item->price)
                                                    : formatCurrency(
                                                        $item->product->is_variation == 1
                                                            ? $item->variation->product_price_detail->price
                                                            : $item->product->product_price->product_price_detail->price,
                                                    ) !!} </b>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-5 ml-3 d-block d-sm-none">
                                                <b>Số lượng</b>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-6 d-flex align-items-center ">
                                                <input type="number"
                                                    class="product-qty soluong form-control form-control-sm "
                                                    value="{{ $item->quantity }}" step="1" min="1"
                                                    max="" name="qty" data-cart_item_id="{{ $item->id }}"
                                                    data-cart_id="{{ $cart_store->id }}"
                                                    data-url="{{route('cart.update')}}" data-storeid="{{ $item->store_id }}" title="SL"
                                                    size="3" pattern="[0-9]*" inputmode="numeric">
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-12  d-flex align-items-center ">
                                                <img src="https://i.imgur.com/bI4oD5C.png" width="15px" class="remove"
                                                    onclick="removeRowCart(this)" data-url="{{route('cart.delete')}}"
                                                    data-id="{{ $item->id }}" data-storeid="{{ $item->store_id }}"
                                                    aria-label="Xóa sản phẩm">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-xl-12 col-md-12 col-sm-12 col-12 ">
                    <div class="form-checkout">
                        <form action="{{route('cart.checkout')}}" method="post">
                            @csrf
                            <input type="hidden" name="store_ids" value="">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12 ">
                                <div class="form-checkout">

                                    <input type="hidden" name="store_ids" value="">

                                    <div class="d-md-flex  justify-content-around ">
                                        <div class="">
                                            <b>Tổng giá trị Sản phẩm: </b><span class="text-danger"
                                                id="total">0
                                            </span>
                                        </div>
                                        <div class="">
                                            <b>Tổng C: </b><span class="text-danger"
                                                id="cpoint">0</span>
                                        </div>
                                        <div class="">
                                            <b>Tổng M: </b><span class="text-danger"
                                                id="mpoint">0</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-around row">
                                        <div class="col-md-4">
                                            <a class="btn-ttms" href="{{ url('/danh-muc-san-pham') }}"> Tiếp tục mua
                                                sắm</a>
                                        </div>
                                        <div class="col-md-4">
                                            <button id="btn-to-checkout" class="btn-dathang" type="submit" disabled>Chọn
                                                cửa hàng
                                                cần thanh
                                                toán</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>
    @else
        <!-- -----------CHƯA CÓ SẢN PHẨM TRONG GIỎ HÀNG--------- -->
        <div class="no-product">
            <div class="cart-img">
                <img src="{{ asset('assets/image/cart.png') }}" alt="">
                <p class="cart-img-text">Bạn chưa có sản phẩm nào trong giỏ hàng. Vui lòng quay lại chọn thêm sản phẩm.</p>
            </div>
            <div class="btn">
                {{-- <button class="btn-primary btn-a">
                    Xem khuyến mãi
                </button> --}}
                <a class="btn-primary btn-b" href="{{ url('/danh-muc-san-pham') }}">
                    Tiếp tục mua sắm
                </a>
            </div>
        </div>
    @endif
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
@endsection

@push('scripts')

@endpush
