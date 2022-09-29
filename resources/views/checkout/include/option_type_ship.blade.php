@switch($cart_store->transpot['status'])
    @case(200)
        @switch($cart_store->transpot_service->id)
            @case(1)
                <ul>
                    <li>
                        <label for="">Tiêu chuẩn<input type="radio" name="ship_type{{ $cart_store->store_id }}"
                                checked>{{ formatCurrency($cart_store->transpot_price_default) }}</label>
                    </li>
                </ul>
            @break

            @default
                <ul class="list-transpot-type-price">
                    <li>
                        <label for="ship_type_default{{ $cart_store->store_id }}" class="mb-0"><input
                                id="ship_type_default{{ $cart_store->store_id }}" type="radio"
                                name="ship_type{{ $cart_store->store_id }}" value="1" checked="checked"
                                data-store_id="{{ $cart_store->store_id }}">Tiêu
                            chuẩn: {{ formatCurrency($cart_store->transpot_price_default) }}</label>
                    </li>
                    <li>
                        <label for="ship_type_fast{{ $cart_store->store_id }}" class="mb-0"><input
                                id="ship_type_fast{{ $cart_store->store_id }}" type="radio"
                                name="ship_type{{ $cart_store->store_id }}" value="2"
                                data-store_id="{{ $cart_store->store_id }}">Tốc độ:
                            {{ formatCurrency($cart_store->transpot_price_fast) }}</label>
                    </li>
                </ul>
            @break
        @endswitch
    @break

    @case(404)
        <ul>
            <li>
                <label for="">{{$cart_store->transpot['message']}}</label>
            </li>
        @break

    </ul>
@endswitch
