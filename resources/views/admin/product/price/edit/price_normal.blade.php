<div class="price-normal-form">
    <div class="row">
        @foreach ($product->product_price->product_price_details as $item)
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">{{ $item->user_price->label }} <sup class="text-danger">*</sup>:</label>
                    <input type="text" id="ip-price{{ $item->user_price->id }}" class="form-control" value="{{$item->price}}" required
                        data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="op-price{{ $item->user_price->id }}" name="price{{ $item->user_price->id }}"
                        value="{{$item->price}}" class="form-control" required>
                </div>
            </div>
            <script>
                easyNumberSeparator({
                    selector: '#ip-price{{ $item->user_price->id }}',
                    separator: '.',
                    resultInput: '#op-price{{ $item->user_price->id }}',
                })
            </script>
        @endforeach
    </div>

</div>
