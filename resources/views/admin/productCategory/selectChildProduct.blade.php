<option value="{{ $child_category->id }}" 
    @if (old('category_parent') != null && old('category_parent') != '')
        {{ old('category_parent') == $child_category->id ? 'selected' : '' }}
    @else
        {{ $productCategory == $child_category->id ? 'selected' : ''}}
    @endif
    >
    {{html_entity_decode($prefix, ENT_COMPAT);}}{{ $child_category->name }}
</option>
@if (count($child_category->childrenCategories) > 0)
    @foreach ($child_category->childrenCategories as $childCategory)
        @include('admin.productCategory.selectChildProduct', [
            'child_category' => $childCategory,
            'prefix' => $prefix.'&nbsp;&nbsp;&nbsp;',
            'productCategory' => $productCategory
            ])
    @endforeach
@endif