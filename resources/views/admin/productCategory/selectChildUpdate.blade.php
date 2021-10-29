@if ($isLinked)
    @if ($proCat->id != $child_category->id)
        <option value="{{ $child_category->id }}"
            {{ $proCat->link_to_category == $child_category->id ? 'selected' : '' }}>
            {{ html_entity_decode($prefix, ENT_COMPAT) }}{{ $child_category->name }}
        </option>
    @endif

    @if (count($child_category->childrenCategories) > 0)
        @foreach ($child_category->childrenCategories as $childCategory)
            @include('admin.productCategory.selectChildUpdate', [
            'child_category' => $childCategory,
            'prefix' => $prefix.'&nbsp;&nbsp;&nbsp;',
            'proCat' => $proCat,
            'isLinked' => true,
            ])
        @endforeach
    @endif

@else

    @if ($proCat->id != $child_category->id && $proCat->level >= $child_category->level)
        <option value="{{ $child_category->id }}"
            {{ $proCat->category_parent == $child_category->id ? 'selected' : '' }}>
            {{ html_entity_decode($prefix, ENT_COMPAT) }}{{ $child_category->name }}
        </option>
    @endif

    @if (count($child_category->childrenCategories) > 0)
        @foreach ($child_category->childrenCategories as $childCategory)
            @include('admin.productCategory.selectChildUpdate', [
            'child_category' => $childCategory,
            'prefix' => $prefix.'&nbsp;&nbsp;&nbsp;',
            'proCat' => $proCat,
            'isLinked' => false,
            ])
        @endforeach
    @endif
    
@endif
