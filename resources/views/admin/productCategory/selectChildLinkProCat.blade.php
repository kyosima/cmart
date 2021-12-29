<option value="{{ $child_category->id }}"
    @if (old('linkProCat') == $child_category->id)
        selected
    @endif
    >{{html_entity_decode($prefix, ENT_COMPAT);}}{{ $child_category->name }}</option>
@if (count($child_category->childrenCategories) > 0)
    @foreach ($child_category->childrenCategories as $childCategory)
        @include('admin.productCategory.selectChildLinkProCat', ['child_category' => $childCategory, 'prefix' => $prefix.'&nbsp;&nbsp;&nbsp;'])
    @endforeach
@endif
