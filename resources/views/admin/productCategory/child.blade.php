<tr class="child-category {{ count($child_category->childrenCategories) > 0 ? 'has-child' : '' }}"
    data-categoryid="{{ $child_category->id }}" data-parentcat="{{ $child_category->category_parent }}">
    <td>
        @if (auth()->guard('admin')->user()->can('Thêm danh mục sản phẩm'))
            <a style="text-decoration: none; cursor: pointer;" class="modal-edit-proCat"
<<<<<<< HEAD
                href="{{ route('nganh-nhom-hang.edit', $child_category->id) }}">{{ $prefix }}
=======
                href="{{ route('nganh-nhom-hang.edit', $category->id) }}">{{ $prefix }}
>>>>>>> thinh
                {{ $child_category->name }}</a>
        @else
            {{ $prefix }} {{ $child_category->name }}
        @endif
    </td>
    <td>{{ $child_category->slug }}</td>
    <td>
        <div class="input-group" style="min-width: 108px;">
            @if ($child_category->status == 1)
                <span style=" max-width: 82px;min-width: 82px;" type="text"
                    class="form-control form-control-sm font-size-s text-white active text-center"
                    aria-label="Text input with dropdown button">Hoạt động</span>
                <button class="btn bg-status-drop border-0 text-white py-0 px-2" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-angle-down" aria-hidden="true"></i></button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        @if (auth()->guard('admin')->user()->can('Chỉnh sửa danh mục sản phẩm'))
                            <form action="{{ route('nganh-nhom-hang.updateStatus', $category->id) }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="unitStatus" value="0">
                                <button type="submit" class="dropdown-item">Ngừng</button>
                            </form>
                        @endif
                    </li>
                    <li>
                        @if (auth()->guard('admin')->user()->can('Xóa danh mục sản phẩm'))
                            <form action="{{ route('nganh-nhom-hang.delete', $category->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="dropdown-item"
                                    onclick="confirm('Bạn có chắc muốn xóa');">Xoá</button>
                            </form>
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
                        @if (auth()->guard('admin')->user()->can('Chỉnh sửa danh mục sản phẩm'))
                            <form action="{{ route('nganh-nhom-hang.updateStatus', $category->id) }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="unitStatus" value="1">
                                <button type="submit" class="dropdown-item">Hoạt
                                    động</button>
                            </form>
                        @endif
                    </li>
                    <li>
                        @if (auth()->guard('admin')->user()->can('Xóa danh mục sản phẩm'))
                            <form action="{{ route('nganh-nhom-hang.delete', $category->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="dropdown-item"
                                    onclick="confirm('Bạn có chắc muốn xóa');">Xoá</button>
                            </form>
                        @endif
                    </li>
                </ul>
            @endif
        </div>
    </td>
    <td>
        @if ($child_category->slug != 'uncategorized' && auth()->guard('admin')->user()->can('Chỉnh sửa danh mục sản phẩm'))
            <a style="text-decoration: none; cursor: pointer;" class="btn btn-warning modal-edit-proCat"
                data-route="{{ route('nganh-nhom-hang.modalEdit') }}" data-unitid="{{ $child_category->id }}"><i
                    class="fa fa-pencil"></i></a>
        @endif
    </td>
</tr>
@if (count($child_category->childrenCategories) > 0)
    @foreach ($child_category->childrenCategories as $childCategory)
        @include('admin.productCategory.child', ['child_category' => $childCategory, 'prefix' => $prefix.'—'])
    @endforeach
@endif
