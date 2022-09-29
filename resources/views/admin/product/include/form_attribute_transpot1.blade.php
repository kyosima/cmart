<div class="form-attribute">
    <div class="attribute-list">
        <div class="select-province-from">
            <div class="form-group">
                <label for="" class="control-label">Tỉnh thành đi</label>
                <select name="province_id_from" id="" class="form-control" required>
                    @foreach($provinces as $province)
                        <option value="{{ $province->matinhthanh }}"> {{ $province->tentinhthanh}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {!! $form !!}
    </div>
    <div class="text-center py-2">
        <button id="addMoreAttribue" class="btn btn-warning" type="button" data-url="{{ route('san-pham.getMoreAttribute') }}" data-order="1">Thêm biến thể</button>
    </div>
</div>