@extends('admin.layout.master')

@section('title', 'Chi tiết cửa hàng')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
@endpush

@section('content')
    <div class="m-3">
        <div class="wrappr bg-white p-4">
            <div class="row">
                <div class="col-12">
                    <p><b>Thống kê đơn hàng của cửa hàng </b></p>
                    <form action="" method="get">
                        <div class="row my-2">

                            <div class="col-md-5 col-12">
                                <label for="">
                                    Chọn thời gian bắt đầu
                                </label>
                                <input type="datetime-local" class="form-control" name="time_start"
                                    @if (isset($time_start)) value="{{ $time_start }}" @endif required>
                            </div>
                            <div class="col-md-5 col-12">
                                <label for="">
                                    Chọn thời gian kết thúc
                                </label>
                                <input type="datetime-local" class="form-control" name="time_end"
                                    @if (isset($time_end)) value="{{ $time_end }}" @endif required>
                            </div>
                            <div class=" col-md-2 col-6">
                                <label for="">
                                </label>
                                <button class="btn btn-primary w-100" type="submit">
                                    Lọc
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="">
                            <thead class="bg-dark text-light">
                                <tr style="text-align:center">
                                    <th>Số ĐH Đã đặt hàng</th>
                                    <th>Số ĐH Đã thanh toán</th>
                                    <th>Số ĐH Đang xử lý</th>
                                    <th>Số ĐH Đang vận chuyển</th>
                                    <th>Số ĐH Hoàn thành</th>
                                    <th>Số ĐH Hủy</th>
                                    <th>Tổng giá trị Sản phẩm ĐH hoàn thành</th>
                                    <th>Tổng VAT Sản phẩm H hoàn thành</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="text-align:center">
                                    <td>{{ formatNumber(count($order_stores_confirm)) }}</td>
                                    <td>{{ formatNumber(count($order_stores_payment)) }}</td>
                                    <td>{{ formatNumber(count($order_stores_process)) }}</td>
                                    <td>{{ formatNumber(count($order_stores_ship)) }}</td>
                                    <td>{{ formatNumber(count($order_stores_success)) }}</td>
                                    <td>{{ formatNumber(count($order_stores_cancel)) }}</td>
                                    <td>{{ formatNumber($order_stores_success->sum('total')) }}</td>
                                    <td>{{ formatNumber($order_stores_success->sum('vat_products')) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="m-3" id="store-main" data-storeid="{{ $store->id }}">
        <div class="wrapper bg-white p-4">
            @if (session('success'))
                <div class="portlet-status mb-2">
                    <div class="caption bg-success p-3">
                        <span class="caption-subject bold uppercase text-light">{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="portlet-title">
                <div class="title-name">
                    <div class="caption">
                        <i class="fa fa-product-hunt icon-drec" aria-hidden="true"></i>
                        <span class="caption-subject bold uppercase">
                            Tạo+xóa+sửa CH</span>
                    </div>
                </div>
            </div>
            <hr>
            <div class="portlet-body">
                @if (auth()->guard('admin')->user()->can('Tạo+xóa+sửa CH'))
                    <form action="{{ route('store.update', $store->id) }}" method="post">
                        @csrf
                        @method('PUT')
                @endif
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Tên cửa hàng<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="store_name" class="form-control" required
                                            value="{{ old('store_name', $store->name) }}"
                                            {{ auth()->guard('admin')->user()->can('Tạo+xóa+sửa CH') ||auth()->guard('admin')->user()->can(config('custom-config.name-all-permission'))? '': 'readonly' }}>
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Admin CH<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <select multiple class="form-control select-owner" id="select-owner" name="id_owner[]"
                                            {{ auth()->guard('admin')->user()->can('Tạo+xóa+sửa CH') ||auth()->guard('admin')->user()->can(config('custom-config.name-all-permission'))? '': 'disabled' }}>
                                           
                                                @foreach (explode(',', $store->id_owner) as $id)
                                                    @php
                                                        $owner = App\Models\Admin::findOrFail($id);
                                                    @endphp
                                                    <option value="{{ $owner->id }}" selected>
                                                        {{ $owner->fullname }}
                                                        ({{ $owner->email }})
                                                    </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Địa chỉ cửa hàng<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <input type="text" name="store_address" class="form-control" required
                                            value="{{ old('store_address', $store->address) }}"
                                            {{ auth()->guard('admin')->user()->can('Tạo+xóa+sửa CH') ||auth()->guard('admin')->user()->can(config('custom-config.name-all-permission'))? '': 'readonly' }}>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Cấp tỉnh:<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="selectCity" name="sel_province" data-type="city"
                                            data-placeholder="Chọn tỉnh/thành"
                                            {{ auth()->guard('admin')->user()->can('Tạo+xóa+sửa CH') ||auth()->guard('admin')->user()->can(config('custom-config.name-all-permission'))? '': 'disabled' }}>
                                            <option value="{{ $store_province->PROVINCE_ID }}" selected>
                                                {{ $store_province->PROVINCE_NAME }}
                                            </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Cấp huyện:<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="selectDistrict" name="sel_district"
                                            data-type="district" data-placeholder="Chọn quận/huyện"
                                            {{ auth()->guard('admin')->user()->can('Tạo+xóa+sửa CH') ||auth()->guard('admin')->user()->can(config('custom-config.name-all-permission'))? '': 'disabled' }}>
                                            <option value="{{ $store_district->DISTRICT_ID }}" selected>
                                                {{ $store_district->DISTRICT_NAME }}
                                            </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group d-flex mb-2">
                                    <label class="col-md-3 control-label">Cấp Xã:<span class="required"
                                            aria-required="true">(*)</span></label>
                                    <div class="col-md-9">
                                        <select id="selectWard" name="sel_ward" data-type="ward"
                                            data-placeholder="Chọn phường/xã" class="form-control"
                                            {{ auth()->guard('admin')->user()->can('Tạo+xóa+sửa CH') ||auth()->guard('admin')->user()->can(config('custom-config.name-all-permission'))? '': 'disabled' }}>
                                            <option value="{{ $store_ward->WARDS_ID }}" selected>
                                                {{ $store_ward->WARDS_NAME }}
                                            </option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-12 control-label text-left">Sản phẩm:</label>
                                    <div class="col-md-12">
                                        <select class="form-control select-product" id="select-product" name="products[]"
                                            multiple data-storeid="{{ $store->id }}">
                                            @if (is_array(old('products')))
                                                @foreach (old('products') as $product)
                                                    <option value="{{ $product }}" selected>
                                                        {{ App\Models\Product::where('id', $product)->value('name') }}
                                                        (#{{ $product }})
                                                    </option>
                                                @endforeach
                                            @else
                                                @if (count($products) > 0)
                                                    @foreach ($products as $item)
                                                        <option value="{{ $item->id }}" selected>{{ $item->name }}
                                                            (#{{ $item->id }})
                                                        </option>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div id="show_products" class="row">
                                    @if (count($products) > 0)
                                        @foreach ($products as $product)
                                            @include('admin.store.product_store', [
                                                'product' => $product,
                                                'store' => $store,
                                                'admin' => $admin,
                                            ])
                                        @endforeach
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    @if (auth()->guard('admin')->user()->can('Tạo+xóa+sửa CH') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-info">Cập nhật cửa hàng</button>
                        </div>
                </div>
                </form>
                @endif

                @if (auth()->guard('admin')->user()->can('Tạo+xóa+sửa CH') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                    <form action="{{ route('store.delete', $store->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa cửa
                            hàng</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/address.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        @if (auth()->guard('admin')->user()->can('Tạo+xóa+sửa CH'))
            // $(document).ready(function() {
            // $("form").validate({
            // rules: {
            // store_name: {
            // required: true,
            // },
            // store_address: {
            // required: true,
            // },
            // id_province: {
            // required: true,
            // },
            // id_district: {
            // required: true,
            // },
            // id_ward: {
            // required: true,
            // },
        
            // },
            // messages: {
            // store_name: "Không được để trống",
            // store_address: "Không được để trống",
            // id_province: "Không được để trống",
            // id_district: "Không được để trống",
            // id_ward: "Không được để trống",
            // }
            // });
            // $('.js-location').select2({
            // width: '100%',
            // })
            // $('.for_user').select2();
        
            // $('.js-location').change(function(e) {
            // e.preventDefault();
            // let route = '{{ route('store.getLocation') }}';
            // let type = $(this).attr('data-type');
            // let parentId = $(this).val();
            // $.ajaxSetup({
            // headers: {
            // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // }
            // });
            // $.ajax({
            // type: "GET",
            // url: route,
            // data: {
            // type: type,
            // parent: parentId
            // },
            // success: function(response) {
            // if (response.data) {
            // let html = '';
            // let element = '';
            // if (type == 'city') {
            // html = "<option>Mời bạn chọn Quận/Huyện</option>";
            // $.each(response.data, function(idx, val) {
            // html += "<option value='" + val.maquanhuyen + "'>" +
                // val.maquanhuyen + " - " + val.tenquanhuyen +
                // "</option>";
            // });
            // $('#selectDistrict').html('').append(html);
            // $('#selectWard').html('');
            // } else {
            // html = "<option>Mời bạn chọn Phường/Xã</option>";
            // $.each(response.data, function(idx, val) {
            // html += "<option value='" + val.maphuongxa + "'>" +
                // val.maphuongxa + " - " + val.tenphuongxa +
                // "</option>";
            // });
            // $('#selectWard').html('').append(html);
            // }
        
            // }
            // }
            // });
            // });
            // });
            //
        @endif
    </script>

    @if (auth()->guard('admin')->user()->can('Tạo+xóa+sửa CH') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
        <script>
            $('#select-product').select2({
                width: '100%',
                multiple: true,
                minimumInputLength: 3,
                dataType: 'json',
                ajax: {
                    delay: 350,
                    url: `{{ route('store.getProduct') }}`,
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term,
                        }
                        return query;
                    },
                    processResults: function(data) {
                        return {
                            results: data.data
                        };
                    },
                    cache: true
                },
                placeholder: 'Chọn sản phẩm...',
                templateResult: formatRepoSelection,
                templateSelection: formatRepoSelection
            })

            $('#select-product').on('select2:unselecting', function(e) {
                let id_product = e.params.args.data.id
                let id_store = $('#store-main').data('storeid')

                if (confirm('Bạn chắc chắn muốn xóa sản phẩm này ra khỏi cửa hàng?')) {
                    $(`#product-box-${id_product}`).remove();
                    var wanted_option = $(`#select-product option[value="${id_product}"]`);
                    wanted_option.prop('selected', false);

                    $.ajax({
                        url: '{{ url('admin/cua-hang/san-pham/') }}' + '/' + id_store + '/' + id_product,
                        type: 'DELETE',
                        success: function(response) {
                            $.toast({
                                heading: 'Thành công',
                                text: `Xóa thành công`,
                                position: 'top-right',
                                icon: 'success'
                            });
                        },
                        error: function(data) {
                            $.toast({
                                heading: 'Thất bại',
                                text: 'Thực hiện không thành công',
                                position: 'top-right',
                                icon: 'error'
                            });
                        }
                    });
                } else {
                    e.preventDefault();
                }
            });

            $('#select-product').on('select2:select', function() {
                let arr_id = $('option', this).filter(':selected:last').val()
                $.ajax({
                    type: "GET",
                    url: "{{ route('store.getListProduct') }}",
                    data: {
                        product_id: arr_id,
                        store_id: $(this).data('storeid')
                    },
                    success: function(response) {
                        $('#show_products').append(response.html)
                    }
                });
            })


            $('#select-owner').select2({
                width: '100%',
                multiple: true,
                minimumInputLength: 3,
                dataType: 'json',
                ajax: {
                    delay: 350,
                    url: `{{ route('store.getListOwner') }}`,
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            search: params.term,
                        }
                        return query;
                    },
                    processResults: function(data) {
                        return {
                            results: data.data
                        };
                    },
                    cache: true
                },
                placeholder: 'Chọn chủ cửa hàng...',
                templateResult: formatRepoSelectionOwner,
                templateSelection: formatRepoSelectionOwner
            })

            function formatRepoSelectionOwner(repo) {
                if (repo.text) {
                    return repo.text
                } else {
                    return `${repo.fullname} (#${repo.email})`;
                }
            }

            function formatRepoSelection(repo) {
                if (repo.text) {
                    return repo.text
                } else {
                    return `${repo.name} (#${repo.id})`;
                }
            }
        </script>
    @endif
@endpush
