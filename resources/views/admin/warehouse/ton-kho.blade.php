@extends('admin.layout.master')

@section('title', 'Quản lý tồn kho')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/khuyenmai.css') }}" type="text/css">
@endpush

@section('content')
<!-- Modal TẠO KHO HÀNG MỚI -->
<div class="modal fade" id="warehouse_create" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-anchor"></i> Thông tin chi nhánh NPP </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formCreateUnit" action="{{ route('warehouse.store') }}"
                    role="form" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Mã chi nhánh:<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" name="warehouseCode" class="form-control" required
                                    value="{{ old('warehouseCode') }}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Tên chi nhánh NPP:<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" name="warehouseName" class="form-control" required
                                    value="{{ old('warehouseName') }}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Địa chỉ kho:<span class="required"
                                aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="text" name="warehouseAddress" class="form-control" required
                                    value="{{ old('warehouseAddress') }}">
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Thành phố:<span class="required"
                                aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <select class="js-location" id="selectCity" name="id_province" data-type="city">
                                    <option value="-1">Chọn thành phố</option>
                                    @foreach ($cities as $city)
                                        <option value="{{$city->matinhthanh}}">{{$city->matinhthanh}} - {{$city->tentinhthanh}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Quận/ huyện:<span class="required"
                            aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <select class="js-location" id="selectDistrict" name="id_district" data-type="district">
                                    <option value="-1">Chọn quận/huyện</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Phường/ Xã:<span class="required"
                                aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <select id="selectWard" name="id_ward" data-type="ward">
                                    <option value="-1">Chọn phường/xã</option>
                                </select>
                            </div>
                        </div>
                        
                        {{-- <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Sản phẩm<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <select name="product" class="form-control productId">
                                    <option value="-1" selected>Chọn sản phẩm</option>
                                    @foreach ($products as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Số lượng:<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="number" name="productQuantity" class="form-control" required
                                    value="{{ old('productQuantity', 1) }}" min="1">
                            </div>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-info btn-submit-unit">Lưu</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- END MODAL -->

<!-- Modal THÊM MỚI SẢN PHẨM VÀO KHO HÀNG CÓ SẴN -->
<div class="modal fade" id="warehouse_add_product" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-anchor"></i> Thêm sản phẩm vào chi nhánh NPP </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formAddProduct" action="{{ route('warehouse.addProductToWarehouse') }}"
                    role="form" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Mã chi nhánh:<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <select class="form-control js-warehouse" name="warehouseCode">
                                    <option value="-1">Chọn kho hàng</option>
                                    @foreach ($warehouseCodes as $warehouse)
                                        <option value="{{$warehouse->code}}">{{$warehouse->code}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Tên chi nhánh NPP:<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <select class="form-control" id="warehouseName" name="warehouseName">
                                    <option value="-1">Chọn chi nhánh</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Sản phẩm<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <select name="product" class="form-control productId">
                                    <option value="-1" selected>Chọn sản phẩm</option>
                                    @foreach ($products as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex mb-2">
                            <label class="col-md-3 control-label">Số lượng:<span class="required"
                                    aria-required="true">(*)</span></label>
                            <div class="col-md-9">
                                <input type="number" name="productQuantity" class="form-control" required
                                    value="{{ old('productQuantity', 1) }}" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-info btn-submit-unit">Lưu</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- END MODAL -->

<div class="m-3">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="bg-danger p-2 mb-2">
                            <p class="text-light m-0">{{$errors->first()}}</p>
                        </div>
                    @elseif(session('success'))    
                        <div class="bg-success p-2 mb-2">
                            <p class="text-light m-0">{{session('success')}}</p>
                        </div>
                    @endif
                    <ul class="list-group list-group-flush">
                            <div class="d-flex justify-content-between align-items-center">
                                <p>
                                    <span class="caption-subject"><i class="far fa-hourglass"></i> DANH SÁCH TỒN KHO</span>
                                    <a href="#warehouse_create" data-toggle="modal" class="btn btn_success"><i
                                        class="fa fa-plus"></i> Thêm mới kho hàng</a>
                                    <a href="#warehouse_add_product" data-toggle="modal" class="btn btn-info text-light" style="border-radius:55px;">
                                        <i class="fa fa-plus"></i> Thêm mới sản phẩm vào kho hàng</a>
                                </p>

                                <span>
                                    <span data-bs-toggle="collapse" href="#collapseExample" role="button"
                                        aria-expanded="false" aria-controls="collapseExample">
                                        <i class="fas fa-chevron-down"></i>
                                    </span>&nbsp;
                                    <span style="cursor: pointer;" onclick="window.location.reload();"><i class="fas fa-sync-alt"></i></span>
                                </span>
                            </div>
                    </ul>
                    <div class="collapse show" id="collapseExample">
                        <div class="row">
                            <div class="col-sm-12" style="overflow-x: auto;">
                                <table id="warehouse_table" class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th class="title">STT</th>
                                            <th class="title">Mã chi nhánh NPP</th>
                                            <th class="title">Tên chi nhánh NPP</th>
                                            <th class="title">Loại kho</th>
                                            <th class="title">Model</th>
                                            <th class="title">Tên sản phẩm</th>
                                            <th class="title">Đơn vị tính</th>
                                            <th class="title">Ngành hàng</th>
                                            <th class="title">Số lượng tồn kho</th>
                                            <th class="title">Thời gian</th>
                                            <th class="title">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody style="color: #748092; font-size: 14px;">
                                        @foreach ($warehouses as $item)
                                            @foreach ($item->products as $product)
                                            <tr>
                                                <td>{{$index}}</td>
                                                <td>{{$item->code}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>Promotion</td>
                                                <td>PerfectCream01</td>
                                                <td>{{$product->name}}</td>
                                                <td>{{$product->productCalculationUnit->name}}</td>
                                                <td>{{$product->productCategory->name}}</td>
                                                <td>{{$product->getOriginal('pivot_quantity')}}</td>
                                                <td>{{$product->getOriginal('pivot_created_at')}}</td>
                                                <td>
                                                    <button class="btn modal-edit-unit" data-route="{{route('warehouse.modalEdit')}}"
                                                    data-productid="{{$product->id}}"
                                                    data-warehouseid="{{$item->id}}">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php $index++; ?>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
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

<script>
    $('#warehouse_table').DataTable({
        ordering: false,
        columnDefs: [
            { "type": "string", "targets": [10] },
            { "type": "html", "targets": [1, 2, 5, 7, 8] },
            { "orderable": true, "targets": 10 },
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
                conditions :{
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

    $(document).ready(function () {
        $("form").validate({
            rules: {
                warehouseCode: {
                    required: true,
                },
                warehouseName: {
                    required: true,
                },
                warehouseAddress: {
                    required: true,
                },
                product: {
                    required: true,
                },
                productQuantity: {
                    required: true,
                    min: 1,
                },
            },
            messages: {
                warehouseCode: "Không được để trống",
                warehouseName: "Không được để trống",
                warehouseAddress: "Không được để trống",
                product: "Không được để trống",
                productQuantity: "Không được để trống",
            }
        });

        $('#warehouse_create select').select2({
            width: '100%',
            dropdownParent: $('#warehouse_create')
        })

        $('.js-location').change(function(e) {
            e.preventDefault();
            let route = '{{route('warehouse.getLocation')}}';
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
                    if(response.data){
                        let html = '';
                        let element = '';
                        if(type == 'city'){
                            html = "<option>Mời bạn chọn Quận/Huyện</option>";
                            element = '#selectDistrict';
                            $.each(response.data, function(idx, val){
                                html += "<option value='"+val.maquanhuyen+"'>"+val.maquanhuyen+" - "+val.tenquanhuyen+"</option>"; 
                            });
                            $(element).html('').append(html);
                        }
                        else {
                            html = "<option>Mời bạn chọn Phường/Xã</option>";
                            element = '#selectWard';
                            $.each(response.data, function(idx, val){
                                html += "<option value='"+val.maphuongxa+"'>"+val.maphuongxa+" - "+val.tenphuongxa+"</option>"; 
                            });
                            $(element).html('').append(html);
                        }
                        
                    }
                }
            });
        });

        // SHOW WAREHOUSE NAME WHEN CHOSING WAREHOUSE CODE
        $(document).on('change', '.js-warehouse', function(e) {
            e.preventDefault();
            let route = '{{route('warehouse.getWarehouse')}}';
            let code = $(this).val();
            let type = $(this).data('type');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: route,
                data: {
                    code: code
                },
                success: function(response) {
                    if(response.data){
                        let html = '';
                        if(type != 'update'){
                            html = "<option>Mời bạn chọn chi nhánh</option>";
                            $.each(response.data, function(idx, val){
                                html += `<option value="${val.name}">${val.name}</option>`; 
                            });
                            $('#formAddProduct select#warehouseName').html('').append(html);
                        } else {
                            html = "<option>Mời bạn chọn chi nhánh</option>";
                            $.each(response.data, function(idx, val){
                                html += `<option value="${val.name}">${val.name}</option>`; 
                            });
                            $('#formUpdateUnit select#warehouseName').html('').append(html);
                        }
                    }
                }
            });
        })

        // SHOW LOCATION ON UPDATE FORM
        $(document).on('change', '.js-edit-location', function(e){
            e.preventDefault();
            let route = '{{route('warehouse.getLocation')}}';
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
                    if(response.data){
                        let html = '';
                        let element = '';
                        if(type == 'city'){
                            html = "<option>Mời bạn chọn Quận/Huyện</option>";
                            element = '#select-editDistrict';
                            $.each(response.data, function(idx, val){
                                html += "<option value='"+val.maquanhuyen+"'>"+val.maquanhuyen+" - "+val.tenquanhuyen+"</option>"; 
                            });
                            $(element).html('').append(html);
                            $('#select-editWard').html('');
                        }
                        else {
                            html = "<option>Mời bạn chọn Phường/Xã</option>";
                            element = '#select-editWard';
                            $.each(response.data, function(idx, val){
                                html += "<option value='"+val.maphuongxa+"'>"+val.maphuongxa+" - "+val.tenphuongxa+"</option>"; 
                            });
                            $(element).html('').append(html);
                        }
                        
                    }
                }
            });
        })

        // SHOW MODAL WHEN CLICK ELEMENT TO UPDATE
        $(document).on('click', '.modal-edit-unit', function () {
            $.ajax({
                type: "GET",
                url: $(this).data('route'),
                data: {
                    warehouse_id: $(this).data('warehouseid'),
                    product_id: $(this).data('productid'),
                },
                success: function (response) {
                    $('#warehouse_create').after(response.html)
                    $('#calculation_unit_update').modal('show')
                    $('#calculation_unit_update select').select2({
                        width: '100%',
                        dropdownParent: $('#calculation_unit_update')
                    })
                }
            });
        })

        $('body').click(function (e) {
            if (!$('#calculation_unit_update').hasClass('show')) {
                $('#calculation_unit_update').remove();
            }
        });
    });

    function destroyModal() {
        $('#calculation_unit_update').remove();
    }

</script>

@endpush
