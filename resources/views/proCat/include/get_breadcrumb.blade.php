@if($cat->parent()->first())
    @include('proCat.include.get_breadcrumb', ['cat'=>$cat->parent()->first()])
@endif  
<a
href="{{ route('proCat.index', $cat->slug) }}">{{ $cat->name }}</a>
<span class="divider">/</span>