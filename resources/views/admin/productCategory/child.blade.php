{{-- <tr class="child-category {{ count($category->childrenCategoriesOnly) > 0 ? 'has-child' : '' }}"
    data-categoryid="{{ $category->id }}" data-parentcat="{{ $category->category_parent }}">
    <td style="width: 3%;">
        @if ($category->id != 1)
        <input type="checkbox" name="id[]" value="{{$category->id}}">
        @endif    
    </td>
    <td>
        @if (auth()->guard('admin')->user()->can('Truy cập+tạo+sửa+xóa+ẩn mục Ngành hàng'))
            <a style="text-decoration: none; cursor: pointer;" class="modal-edit-proCat"
                href="{{ route('nganh-nhom-hang.edit', $category->id) }}">{{ $prefix }}
                {{ $category->name }}</a>
        @else
            {{ $prefix }} {{ $category->name }}
        @endif
    </td>
    <td>{{ $category->slug }}</td>
    <td>
        <div class="input-group" style="min-width: 108px;">
            @if ($category->status == 1)
                <span style=" max-width: 82px;min-width: 82px;" type="text"
                    class="form-control form-control-sm font-size-s text-white active text-center"
                    aria-label="Text input with dropdown button">Hoạt động</span>
                <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-angle-down" aria-hidden="true"></i></button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        @if (auth()->guard('admin')->user()->can('Truy cập+tạo+sửa+xóa+ẩn mục Ngành hàng'))
                            <span data-value="0" data-url="{{ route('nganh-nhom-hang.updateStatus', $category->id) }}" class="dropdown-item changeStatus">
                                Ngừng
                            </span>
                        @endif
                    </li>
                    <li>
                        @if (auth()->guard('admin')->user()->can('Truy cập+tạo+sửa+xóa+ẩn mục Ngành hàng'))
                            <span
                                onclick="return confirm('Bạn có chắc muốn xóa');"
                                data-url="{{ route('nganh-nhom-hang.delete', $category->id) }}"
                                class="dropdown-item btn-delete">
                                Xóa
                            </span>
                        @endif
                    </li>
                </ul>
            @else
                <span style=" max-width: 82px;min-width: 82px;" type="text"
                    class="form-control form-control-sm font-size-s text-white stop text-center"
                    aria-label="Text input with dropdown button">Ngừng</span>
                <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-angle-down" aria-hidden="true"></i></button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        @if (auth()->guard('admin')->user()->can('Truy cập+tạo+sửa+xóa+ẩn mục Ngành hàng'))
                            <span data-value="1" data-url="{{ route('nganh-nhom-hang.updateStatus', $category->id) }}" class="dropdown-item changeStatus">
                                Hoạt động
                            </span>
                        @endif
                    </li>
                    <li>
                        @if (auth()->guard('admin')->user()->can('Truy cập+tạo+sửa+xóa+ẩn mục Ngành hàng'))
                            <span
                                onclick="return confirm('Bạn có chắc muốn xóa');"
                                data-url="{{ route('nganh-nhom-hang.delete', $category->id) }}"
                                class="dropdown-item btn-delete">
                                Xóa
                            </span>
                        @endif
                    </li>
                </ul>
            @endif
        </div>
    </td>
    <td>
        <span class="priority">
            {{$category->priority}}
        </span>
    </td>
    <td>
        @if ($category->slug != 'uncategorized' && auth()->guard('admin')->user()->can('Truy cập+tạo+sửa+xóa+ẩn mục Ngành hàng'))
            <a style="text-decoration: none; cursor: pointer;" class="btn btn-warning modal-edit-proCat"
                data-route="{{ route('nganh-nhom-hang.modalEdit') }}" data-unitid="{{ $category->id }}"><i
                    class="fa fa-pencil"></i></a>
        @endif
    </td>
</tr>
@if (count($category->childrenCategoriesOnly) > 0)
    @foreach ($category->childrenCategoriesOnly as $childCategory)
        @include('admin.productCategory.child', ['category' => $childCategory, 'prefix' => $prefix.'—'])
    @endforeach
@endif --}}
<tr class="{{ count($category->childrenCategoriesOnly) > 0 ? 'has-child' : '' }}">
    <td style="width: 3%;">
        @if ($category->id != 1)
        <input type="checkbox" name="id[]" value="{{$category->id}}">
        @endif    
    </td>
    <td>
        @if (auth()->guard('admin')->user()->can('Truy cập+tạo+sửa+xóa+ẩn mục Ngành hàng'))
            <a style="text-decoration: none; cursor: pointer;" class="modal-edit-proCat"
                href="{{ route('nganh-nhom-hang.edit', $category->id) }}">{{ $prefix }}
                {{ $category->name }}</a>
        @else
            {{ $prefix }} {{ $category->name }}
        @endif
    </td>
    <td>{{ $category->slug }}</td>
    <td>
        <div class="input-group" style="min-width: 108px;">
            @if ($category->status == 1)
                <span style=" max-width: 82px;min-width: 82px;" type="text"
                    class="form-control form-control-sm font-size-s text-white active text-center"
                    aria-label="Text input with dropdown button">Hoạt động</span>
                <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-angle-down" aria-hidden="true"></i></button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        @if (auth()->guard('admin')->user()->can('Truy cập+tạo+sửa+xóa+ẩn mục Ngành hàng'))
                            <span data-value="0" data-url="{{ route('nganh-nhom-hang.updateStatus', $category->id) }}" class="dropdown-item changeStatus">
                                Ngừng
                            </span>
                        @endif
                    </li>
                    <li>
                        @if (auth()->guard('admin')->user()->can('Truy cập+tạo+sửa+xóa+ẩn mục Ngành hàng'))
                            <span
                                onclick="return confirm('Bạn có chắc muốn xóa');"
                                data-url="{{ route('nganh-nhom-hang.delete', $category->id) }}"
                                class="dropdown-item btn-delete">
                                Xóa
                            </span>
                        @endif
                    </li>
                </ul>
            @else
                <span style=" max-width: 82px;min-width: 82px;" type="text"
                    class="form-control form-control-sm font-size-s text-white stop text-center"
                    aria-label="Text input with dropdown button">Ngừng</span>
                <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-angle-down" aria-hidden="true"></i></button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        @if (auth()->guard('admin')->user()->can('Truy cập+tạo+sửa+xóa+ẩn mục Ngành hàng'))
                            <span data-value="1" data-url="{{ route('nganh-nhom-hang.updateStatus', $category->id) }}" class="dropdown-item changeStatus">
                                Hoạt động
                            </span>
                        @endif
                    </li>
                    <li>
                        @if (auth()->guard('admin')->user()->can('Truy cập+tạo+sửa+xóa+ẩn mục Ngành hàng'))
                            <span
                                onclick="return confirm('Bạn có chắc muốn xóa');"
                                data-url="{{ route('nganh-nhom-hang.delete', $category->id) }}"
                                class="dropdown-item btn-delete">
                                Xóa
                            </span>
                        @endif
                    </li>
                </ul>
            @endif
        </div>
    </td>
    <td>
        <span class="{{ $category->level == 0 ? 'priority-cha' : ''}} priority">
            {{$category->priority}}
        </span>
    </td>
    <td>
        @if ($category->slug != 'uncategorized' && auth()->guard('admin')->user()->can('Truy cập+tạo+sửa+xóa+ẩn mục Ngành hàng'))
            <a style="text-decoration: none; cursor: pointer;" class="btn btn-warning modal-edit-proCat"
                data-route="{{ route('nganh-nhom-hang.modalEdit') }}" data-unitid="{{ $category->id }}"><i
                    class="fa fa-pencil"></i></a>
        @endif
    </td>
</tr>

