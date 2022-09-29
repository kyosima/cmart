        @switch($product->productPrice->price_type)
            @case(1)
                <div class="product-type1-normal">
                    <p class="product-price"><span class="price-number">{{ formatPriceOfLevel($product) }}</span></p>
                </div>
            @break

            @case(2)
                <div class="product-type1-normal">
                    <p class="product-price">Chiết khấu: <span class="price-number">{{ formatPriceOfLevel($product) }}</span></p>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" name="price" placeholder="Nhập giá trị E-Card" value=""
                                min="0">
                            <div class="input-group-append">
                                <span class="input-group-text">₫</span>
                            </div>
                        </div>
                    </div>
                </div>
            @break
        @endswitch

        @include('product.include.quantity')

