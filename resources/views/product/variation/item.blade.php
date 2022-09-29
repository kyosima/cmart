<div class="variation-item" data-id="{{$item->id}}">
   <p class="variation-name">{{$item->name}}</p>
   <p class="variation-price">{{formatPriceWithType($item->product_price_details[0]->price, $is_ecard)}}</p>
</div>