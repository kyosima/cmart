    @foreach ($carts as $cart_store)
        <div class="store-block" id="store{{ $cart_store->store->id }}">
            <div class="store-title d-flex justify-content-between">
                <h4>Cửa hàng {{ $cart_store->store->title }}</h4>
                <label for="receiverstore{{ $cart_store->store->id }}"><input class="receiverstore" type="checkbox"
                        id="receiverstore{{ $cart_store->store->id }}" name="receiverstore{{ $cart_store->store->id }}"
                        value="{{ $cart_store->store->id }}" data-storeid="{{ $cart_store->store->id }}"
                        onclick="receiverStore(this)"> Nhận
                    tại cửa
                    hàng</label>
            </div>
            <div class="store-body">
                <div class="row">
                    @foreach ($cart_store->cart_item as $item)
                        <div class="col-md-6 col-lg-6 col-xs-12 col-12">
                            <div id="{{ $item->id }}" class="store-product row">
                                <div class="product-image col-1 p-2">
                                    <img src="{{ showImageWithError($item->product->feature_img) }}" class="w-100">
                                </div>
                                <div class="product-info col-11 pt-2 pb-2">
                                    <div class="product-name">
                                        <p>{{ $item->product->title }}{{ $item->product->is_variation == 1 ? '-' . $item->variation->name : '' }}
                                        </p>
                                    </div>
                                    <div class="product-cart d-flex justify-content-between">
                                        <div class="quantity">SL: {{ $item->quantity }}
                                        </div>
                                        <div class="price">
                                            {!! $item->is_ecard == 1
                                                ? formatCurrency($item->price * $item->quantity)
                                                : formatCurrency(
                                                    $item->product->is_variation == 1
                                                        ? $item->variation->product_price_detail->price * $item->quantity
                                                        : $item->product->product_price->product_price_detail->price * $item->quantity,
                                                ) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-8 col-lg-8 col-xs-12 col-12">
                        <div class="d-flex justify-content-between">
                            <ul>
                                <li>Dịch vụ vận chuyển: (Vui lòng nhập địa chỉ)</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xs-12 col-12">
                        <div class="d-flex justify-content-end">
                            <span>Tổng tiền: </span>    
                            <b class="text-danger ml-1 total-cost"
                                data-total_product="{{ $cart_store->cart_item->sum('total_p') }}">{{ formatCurrency($cart_store->cart_item->sum('total_p')) }}</b>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endforeach
