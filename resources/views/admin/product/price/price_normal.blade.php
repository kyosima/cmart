<div class="price-normal-form">
    <div class="row">
        @foreach ($user_prices as $item)
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">{{ $item->label }} <sup class="text-danger">*</sup>:</label>
                    <input type="text" id="ip-price{{ $item->id }}" class="form-control" value="" required
                        data-parsley-required-message="Không được để trống">
                    <input type="hidden" id="op-price{{ $item->id }}" name="price{{ $item->id }}"
                        value="" class="form-control" required>
                </div>
            </div>
            <script>
                easyNumberSeparator({
                    selector: '#ip-price{{ $item->id }}',
                    separator: '.',
                    resultInput: '#op-price{{ $item->id }}',
                })
            </script>
        @endforeach
    </div>

</div>
