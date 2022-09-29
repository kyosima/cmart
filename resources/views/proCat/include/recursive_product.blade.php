@foreach ($parent->products as $item)
   @include('proCat.include.product_box', ['item' => $item])
@endforeach
@foreach ($parent->childrenRecursive as $category)
    @if (isset($category->childrenRecursive))
        @if ($category->childrenRecursive->count() > 0)
            @include('proCat.include.recursive_product', ['parent' => $category])
        @endif
    @endif
@endforeach