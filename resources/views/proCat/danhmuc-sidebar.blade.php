<ul class="sub-menu">
    @foreach ($child_categories as $item)
        @if (count($item->childrenCategories) > 0)
            <li class="menu-item menu-item-has-children py-1 has-child">
                <a href="{{route('proCat.index', $item->slug)}}">{{ $item->name }}</a>
                <button class="toggle">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                </button>
                @include('proCat.danhmuc-sidebar', [
                    'child_categories' => $item->childrenCategories,
                    ])
            </li>
        @else
            <li class="menu-item py-1">
                <a href="{{route('proCat.index', $item->slug)}}">{{ $item->name }}</a>
            </li>
        @endif
    @endforeach
</ul>
