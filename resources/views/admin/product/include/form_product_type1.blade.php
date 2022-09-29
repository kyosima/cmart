<div id="selectPriceType">

    <div class="form-group">
        <div class="row">
            <div class="col-6">
                <label for="priceType1" class="control-label"><input id="priceType1"
                        type="radio" name="price_type" value="1"
                        checked> Giá (VNĐ)</label>
            </div>
            <div class="col-6">
                <label for="priceType2" class="control-label"><input id="priceType2"
                        type="radio" name="price_type"
                        value="2"> E-card (%)</label>
            </div>
        </div>
    </div>
</div>
{!!$form_sub!!}
<script src={{ asset('/public/js/admin/formatNumber.js') }}></script>
