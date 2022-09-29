<tr id="rowItem{{$store_product->id}}">
    <td>{{$store_product->product?->title}}</td>
    <td>
        @foreach($store_product->storeproduct_userlevels as $item)
        {{$item->userlevel->name}} | 
        @endforeach
    </td>
    <td>{{$store_product->product?->product_type->name}}</td>
    <td>{{$store_product->quantity}}</td>
    <td>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button"
                id="actionMenu{{ $store_product->id }}" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-ellipsis-h"></i>
            </button>
            <div class="dropdown-menu"
                aria-labelledby="actionMenu{{ $store_product->id }}">
                <span class="dropdown-item editStoreProduct" data-url="{{route('store.editProduct', $store_product->id)}}"  role="button">Sửa</span>
                <span class="dropdown-item deleteStoreProduct"  data-url="{{route('store.deleteProduct', $store_product->id)}}" role="button">Xóa</span>
            </div>
        </div>
    </td>
</tr>