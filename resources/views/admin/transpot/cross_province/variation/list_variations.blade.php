<div class="card-body">
    <div id="listVariations-{{$province->matinhthanh}}">
        @foreach ($province->transpot_variations as $transpot_variation)
            <div class="dropdown dropdown-transpot-to">
                <button class="btn btn-success dropdown-toggle mb-2"
                    type="button"
                    id="dropdownProvinceTo{{ $transpot_variation->province_to->matinhthanh }}"
                    data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    {{ $transpot_variation->province_to->tentinhthanh }}
                </button>
                <div class="dropdown-menu"
                    aria-labelledby="dropdownProvinceTo{{ $transpot_variation->province_to->matinhthanh }}">
                    <a class="dropdown-item"
                        href="{{ route('transpot.cross_province.variation.show', $transpot_variation->id) }}"
                        target="_blank">Chỉnh sửa bảng tính phí</a>
                </div>
            </div>
        @endforeach
        <button type="button" class="btn btn-primary btn-add-transpot-to mb-2"
            data-url="{{ route('transpot.get.province', $province->matinhthanh) }}">
            <i class="fas fa-plus"></i> Thêm tỉnh đến
        </button>
    </div>
</div>