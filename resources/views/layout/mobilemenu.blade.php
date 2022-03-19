@if (count($children->childrenCategories) > 0)
    <li>
        <button class="title collapsed" type="button" data-toggle="collapse" data-target="#collapse-{{$children->id}}" aria-expanded="false"
            aria-controls="collapse-{{$children->id}}">
            <a href="{{ route('proCat.index', $children->slug) }}" title="{{ $children->name }}">{{$children->name}}</a>
            <span class="expand-menu">
                <i class="fas fas-custom fa-angle-right"></i>
            </span>
        </button>

        <ul id="collapse-{{$children->id}}" class="collapse sub-nav">
            @foreach ($children->childrenCategories as $children)
                @include('layout.mobilemenu', ['children' => $children])
            @endforeach
        </ul>
    </li>
@else
    <li>
        <h4 class="title">
            <a href="{{ route('proCat.index', $children->slug) }}" title="{{$children->name}}">{{$children->name}}</a>
        </h4>
    </li>
@endif
