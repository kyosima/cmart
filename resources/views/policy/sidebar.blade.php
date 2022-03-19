    @php
        $pages = App\Models\InfoCompany::get();
    @endphp
    <ul>
        <li class="{{ url()->current() == route('theo-doi-don-hang.index') ? 'active' : '' }}">
            <a href="{{ route('theo-doi-don-hang.index') }}" title="title">
                <img src="{{ URL::to('public/images/icon1.png') }}" alt="title" class="img-order">
                <img src="{{ URL::to('public/images/icon1a.png') }}" alt="title" class="hover-order">
                Theo dõi đơn hàng
            </a>
        </li>
        <ul>
            @foreach ($pages as $item)
                <li
                    class="{{ url()->current() == route('chinh-sach.show', $item->slug) ? 'active' : '' }}">
                    <a href="{{ route('chinh-sach.show', $item->slug) }}" title="{{ $item->name }}">
                        {{ $item->name }}
                    </a>
                </li>
            @endforeach
        </ul>

