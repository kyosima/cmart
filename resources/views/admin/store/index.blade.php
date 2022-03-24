@extends('admin.layout.master')

@section('title', 'Quản lý cửa hàng')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/khuyenmai.css') }}" type="text/css">
@endpush

@section('content')
    <style>
        div.dtsb-searchBuilder div.dtsb-group {
            display: none;
        }
    </style>
    @if (auth()->guard('admin')->user()->can('Tạo+xóa+sửa CH') || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
        <!-- Modal TẠO CỬA HÀNG MỚI -->
        <div class="modal fade" id="warehouse_create" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fas fa-anchor"></i> Thông tin cửa hàng </h4>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="formCreateUnit" action="{{ route('store.store') }}" role="form"
                            method="POST">
                            @csrf
                            <div class="form-body">
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Tên cửa hàng:<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="store_name" class="form-control" required
                                            value="{{ old('store_name') }}">
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Admin:<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control select-owner" id="select-owner" name="id_owner">
                                            @if (old('id_owner'))
                                                @php
                                                    $owner = App\Models\Admin::findOrFail(old('id_owner'));
                                                @endphp
                                                <option value="{{ old('id_owner') }}" selected="selected">
                                                    {{ $owner->name }} ({{ $owner->email }})</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Địa chỉ cửa hàng:<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="store_address" class="form-control" required
                                            value="{{ old('store_address') }}">
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Cấp tỉnh:<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <select class="js-location" id="selectCity" name="sel_province" data-type="city"
                                            data-placeholder="Chọn tỉnh/thành">
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Cấp huyện:<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <select class="js-location" id="selectDistrict" name="sel_district"
                                            data-type="district" data-placeholder="Chọn quận/huyện">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Cấp xã:<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <select id="selectWard" name="sel_ward" data-type="ward"
                                            data-placeholder="Chọn phường/xã">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-dark" data-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-info btn-submit-unit">Lưu</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- END MODAL -->
    @endif
    <div class="m-3">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="bg-danger p-2 mb-2">
                                <p class="text-light m-0">{{ $errors->first() }}</p>
                            </div>
                        @elseif(session('success'))
                            <div class="bg-success p-2 mb-2">
                                <p class="text-light m-0">{{ session('success') }}</p>
                            </div>
                        @endif
                        <div class="portlet-title d-flex align-items-center justify-content-between">
                            <div class="title-name d-flex align-items-center">
                                <div class="caption">
                                    <i class="fa fa-anchor icon-drec" aria-hidden="true"></i>
                                    <span class="caption-subject text-uppercase">
                                        DANH SÁCH CỬA HÀNG </span>
                                    <span class="caption-helper"></span>
                                </div>
                                @if (auth()->guard('admin')->user()->can('Tạo+xóa+sửa CH') || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                                    <div class="ps-4">
                                        <a href="#warehouse_create" data-toggle="modal" class="btn btn-add"><i
                                                class="fa fa-plus"></i>
                                            Thêm mới cửa hàng</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="collapse show" id="collapseExample">
                            <div class="row">
                                <div class="col-sm-12" style="overflow-x: auto;">
                                    @if (auth()->guard('admin')->user()->can('Xóa cửa hàng'))
                                        <form id="myform" action="{{ route('store.multiChange') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="action" value="" id="input-action">
                                    @endif
                                    <table id="warehouse_table" class="table table-striped table-bordered align-middle">
                                        <thead class="bg-dark text-light">
                                            <tr>
                                                <th class="title">Tên cửa hàng</th>
                                                <th class="title">Admin CH</th>
                                                {{-- <th class="title">Địa chỉ</th> --}}
                                                <th>SL sản phẩm</th>
                                                <th>Tổng SL tồn kho</th>
                                                <th class="title">Chỉnh sửa</th>
                                            </tr>
                                        </thead>
                                        <tbody style="color: #748092; font-size: 14px;">
                                            @foreach ($stores as $item)
                                        @if (optional($item->owner)->id == $admin->id && auth()->guard('admin')->user()->can('Chỉnh sửa Tồn kho cho CH chỉ định') || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                                            <tr>
                                                
                                                <td>{{ $item->name }}</td>
                                                <td>{{ optional($item->owner)->fullname }} ({{ optional($item->owner)->email }})
                                                </td>
                                                <td>{{ $item->address .', P.' .optional($item->ward)->tenphuongxa .', Q.' .optional($item->district)->tenquanhuyen .', ' .optional($item->province)->tentinhthanh }}
                                                </td>
                                                <td>{{ $item->products()->count() }}</td>
                                                <td>
                                                @if (auth()->guard('admin')->user()->can('Tạo+xóa+sửa CH') || auth()->guard('admin')->user()->can('Chỉnh sửa Tồn kho cho CH chỉ định') || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                                                    <a class="btn modal-edit-unit"
                                                        href="{{ route('store.edit', ['slug' => $item->slug, 'id' => $item->id]) }}">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @elseif (auth()->guard('admin')->user()->can('Truy cập CH') || auth()->guard('admin')->user()->can('Tạo+xóa+sửa CH') || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                                                    <tr>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ optional($item->owner)->fullname }} ({{ optional($item->owner)->email }})</td>
                                                        {{-- <td>{{ $item->address .', P.' .optional($item->ward)->tenphuongxa .', Q.' .optional($item->district)->tenquanhuyen .', ' .optional($item->province)->tentinhthanh }}
                                                        </td> --}}
                                                        <td>{{ $item->products()->count() }}</td>
                                                        <td>{{ $item->product_stores()->sum('soluong') }}</td>
                                                        <td>
                                                        @if (auth()->guard('admin')->user()->can('Tạo+xóa+sửa CH')  || auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                                                            <a class="btn modal-edit-unit"
                                                                href="{{ route('store.edit', ['slug' => $item->slug, 'id' => $item->id]) }}">
                                                                <i class="fas fa-pen"></i>
                                                            </a>
                                                            @endif
                                                        </td>
                                                    </tr>   
                                                   
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @if (auth()->guard('admin')->user()->can('Xóa cửa hàng'))
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('public/js/address.js') }}"></script>

    <script>
        @if (auth()->guard('admin')->user()->can('Xóa cửa hàng'))
            function multiDel() {
            confirm('Bạn chắc chắn muốn thực hiện tác vụ này?') == true && $('#myform').submit()
            }
        @endif
        $('#warehouse_table').DataTable({
            order: [],
            lengthMenu: [
                [25, 50, -1],
                [25, 50, "All"]
            ],
            columnDefs: [
                {
                    targets: [1,2,4],
                    orderable: false,
                }
            ],
            searchBuilder: {
                conditions: {
                    num: {
                        '!between': null,
                        'between': null,
                        '!=': null,
                        '<': null,
                        '>': null,
                        '<=': null,
                        '>=': null,
                        'null': null,
                        '!null': null,
                    },
                    string: {
                        '!=': null,
                        '=': null,
                        'null': null,
                        '!null': null,
                    },
                    html: {
                        '!=': null,
                        'null': null,
                        '!null': null,
                        'contains': null,
                    },
                }
            },
            language: {
                searchBuilder: {
                    add: 'Tạo bộ lọc',
                    condition: 'Điều kiện',
                    clearAll: 'Reset',
                    deleteTitle: 'Delete',
                    data: 'Cột',
                    leftTitle: 'Left',
                    logicAnd: 'VÀ',
                    logicOr: 'HOẶC',
                    rightTitle: 'Right',
                    title: {
                        0: '',
                        _: 'Kết quả lọc (%d)'
                    },
                    value: 'Giá trị',
                    valueJoiner: 'et',
                    conditions: {
                        number: {
                            equals: '=',
                        },
                        string: {
                            contains: '=',
                            startsWith: 'Bắt đầu bằng ký tự',
                            endsWith: 'Kết thúc bằng ký tự',
                        },
                        html: {
                            equals: '=',
                            startsWith: '',
                            endsWith: '',
                        },
                    },
                },
                search: "Tìm kiếm:",
                lengthMenu: "Hiển thị _MENU_ kết quả",
                info: "Hiển thị _START_ đến _END_ trong _TOTAL_ kết quả",
                infoEmpty: "Hiển thị 0 trên 0 trong 0 kết quả",
                zeroRecords: "Không tìm thấy",
                emptyTable: "Hiện tại chưa có dữ liệu",
                paginate: {
                    first: ">>",
                    last: "<<",
                    next: ">",
                    previous: "<"
                },
            },
            dom: '<Q><"wrapper d-flex justify-content-between mb-3"lf>tip',

        });

        $(document).ready(function() {
            @if (auth()->guard('admin')->user()->can('Xóa cửa hàng'))
                $("form").validate({
                rules: {
                store_name: {
                required: true,
                },
                store_address: {
                required: true,
                },
                id_province: {
                required: true,
                },
                id_district: {
                required: true,
                },
                id_ward: {
                required: true,
                },
            
                },
                messages: {
                store_name: "Không được để trống",
                store_address: "Không được để trống",
                id_province: "Không được để trống",
                id_district: "Không được để trống",
                id_ward: "Không được để trống",
                }
                });
            
                $('.custom-select').change(function (e) {
                e.preventDefault();
                $('#input-action').val($(this).val())
                });
            @endif

            $('#warehouse_create select').select2({
                width: '100%',
                dropdownParent: $('#warehouse_create')
            })

            $('body').click(function(e) {
                if (!$('#calculation_unit_update').hasClass('show')) {
                    $('#calculation_unit_update').remove();
                }
            });

            @if (auth()->guard('admin')->user()->can('Thêm cửa hàng'))
                $('.js-location').change(function(e) {
                e.preventDefault();
                let route = '{{ route('store.getLocation') }}';
                let type = $(this).attr('data-type');
                let parentId = $(this).val();
                $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                type: "GET",
                url: route,
                data: {
                type: type,
                parent: parentId
                },
                success: function(response) {
                if (response.data) {
                let html = '';
                let element = '';
                if (type == 'city') {
                html = "<option>Mời bạn chọn Quận/Huyện</option>";
                element = '#selectDistrict';
                $.each(response.data, function(idx, val) {
                html += "<option value='" + val.maquanhuyen + "'>" +
                    val.maquanhuyen + " - " + val.tenquanhuyen +
                    "</option>";
                });
                $(element).html('').append(html);
                } else {
                html = "<option>Mời bạn chọn Phường/Xã</option>";
                element = '#selectWard';
                $.each(response.data, function(idx, val) {
                html += "<option value='" + val.maphuongxa + "'>" +
                    val.maphuongxa + " - " + val.tenphuongxa +
                    "</option>";
                });
                $(element).html('').append(html);
                }
            
                }
                }
                });
                });
            
                $('#select-owner').select2({
                width: '100%',
                allowClear: true,
                dropdownParent: $('#warehouse_create'),
                minimumInputLength: 3,
                dataType: 'json',
                delay: 250,
                ajax: {
                url: `{{ route('store.getListOwner') }}`,
                dataType: 'json',
                data: function (params) {
                var query = {
                search: params.term,
                }
                return query;
                },
                processResults: function (data) {
                return {
                results: data.data
                };
                },
                cache: true
                },
                placeholder: 'Chọn chủ cửa hàng...',
                templateResult: formatRepoSelection,
                templateSelection: formatRepoSelection
                })
            
                function formatRepoSelection(repo) {
                if (repo.text) {
                return repo.text
                } else {
                return `${repo.fullname} (#${repo.email})`;
                }
                }
            @endif

        });

        function destroyModal() {
            $('#calculation_unit_update').remove();
        }
    </script>

@endpush
