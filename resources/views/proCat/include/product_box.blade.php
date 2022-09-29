<div class="col-md-4 col-xs-6 col-sm-6 col-6">
    <div class="product-box">
        <div class="box-image">
            <div class="image-wrapper">
                <a href="{{ route('san-pham.show', $item->slug) }}" title="{{ $item->title }}" tabindex="0">
                    <img src="{{ showImageWithError($item->feature_img) }}" alt="{{ $item->title }}">
                </a>
            </div>
        </div>
        <div class="box-text">
            <div class="product-title">
                <p class="product-title-text">
                    <a href="{{ route('san-pham.show', $item->slug) }}">{{ $item->title }}</a>
                </p>
            </div>
            <div class="product-price">
                <p> {!! formatPriceWithVariation($item) !!} </p>
            </div>

        </div>
    </div>
</div>
