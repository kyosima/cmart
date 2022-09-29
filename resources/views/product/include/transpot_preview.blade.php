<p>Phí được tính cho kiện hàng hóa có Khối lượng <span class="transpot-weight">{{$request->weight}}</span> gram,
    Chiều cao <span class="transpot-weight">{{$request->height}}</span> cm,
    Chiệu rộng <span class="transpot-weight">{{$request->width}}</span> cm,
    Chiều dài <span class="transpot-weight">{{$request->length}}</span> cm.
</p>
<p class="product-price">Phí: <span class="price-number">{{formatPrice($price)}}</span></p>