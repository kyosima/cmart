<div class="item">
    <div class="product-box row">
        <div class="box-image col-lg-12 col-md-4 col-4">
            <div class="image-cover">
                <a href="#">
                    <img src="{{ asset($product->feature_img) }}" alt="">
                </a>
            </div>
        </div>
        <div class="box-text col-lg-12 col-md-8 col-8">
            <div class="title-wrapper">
                <a href="#">
                    <p class="product-title">{{$product->name}}</p>
                </a>
            </div>
            <div class="price-wrapper">
                <span class="price">
                    <span class="amount">{{formatPrice($product->productPrice()->value('market_price'))}}</span>
                </span>
            </div>
        </div>
    </div>
</div>