@foreach ($parent->products as $item)
    <div class="sp">
        <div class="box3item">
            <div class="box-img">
                <a href="{{ route('san-pham.show', $item->slug) }}" title="{{ $item->title }}" tabindex="0">
                    <img src="{{ showImageWithError($item->product_detail->feature_img) }}" alt="{{ $item->title }}">

                </a>
            </div>
            <div class="detail">
                <h3 class="title">
                    <a href="{{ route('san-pham.show', $item->slug) }}" title="{{ $item->title }}" tabindex="0">
                        {{ $item->title }}</a>
                </h3>
                <ul class="box-price">
                    <li class="price">
                        {!! formatPriceWithVariation($item) !!}
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endforeach
@foreach ($parent->childrenRecursive as $category)

            @include('include.recursive_product', ['parent' => $category])
        
@endforeach
