<ul class="sub-menu">
    @foreach ($child_categories as $item)
        @if (count($item->childrenCategories) > 0)
            <li class="menu-item menu-item-has-children py-1 has-child menu-border">
                @if ($item->linkToCategory != null)
                    <a href="{{route('proCat.index', $item->linkToCategory->slug)}}">{{ $item->name }}</a>
                @else
                    <a href="{{route('proCat.index', $item->slug)}}">{{ $item->name }}</a>
                @endif
                <button class="toggle">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                </button>
                @include('proCat.danhmuc-sidebar', [
                    'child_categories' => $item->childrenCategories,
                    ])
            </li>
        @else
            <li class="menu-item py-1 menu-border">
                @if ($item->linkToCategory != null)
                    <a href="{{route('proCat.index', $item->linkToCategory->slug)}}">{{ $item->name }}</a>
                @else
                    <a href="{{route('proCat.index', $item->slug)}}">{{ $item->name }}</a>
                @endif
            </li>
        @endif
    @endforeach
</ul>
