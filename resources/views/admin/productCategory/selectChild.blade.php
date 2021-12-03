<option value="{{ $child_category->id }}">{{html_entity_decode($prefix, ENT_COMPAT);}}{{ $child_category->name }}</option>
@if (count($child_category->childrenCategories) > 0)
    @foreach ($child_category->childrenCategories as $childCategory)
        @include('admin.productCategory.selectChild', ['child_category' => $childCategory, 'prefix' => $prefix.'&nbsp;&nbsp;&nbsp;'])
    @endforeach
@endif