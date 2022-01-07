@extends('admin.layout.master')

@section('title', 'Chỉnh sửa cửa hàng')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/quanlysanpham.css') }}" type="text/css">
@endpush

@section('content')
    <div class="m-3">
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
                            Chỉnh sửa cửa hàng</span>
                    </div>
                </div>
            </div>
            <hr>
            <div class="portlet-body">
                @if (auth()->guard('admin')->user()->can('Chỉnh sửa mã ưu đãi'))
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
                                                value="{{ old('store_name', $store->name) }}">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group d-flex mb-2">
                                        <label class="col-md-3 control-label">Địa chỉ cửa hàng<span class="required"
                                                aria-required="true">(*)</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="store_address" class="form-control" required
                                                value="{{ old('store_address', $store->address) }}">
                                        </div>
                                    </div>

                                    <div class="form-group d-flex mb-2">
                                        <label class="col-md-3 control-label">Thành phố:<span class="required"
                                                aria-required="true">(*)</span></label>
                                        <div class="col-md-9">
                                            <select class="form-control js-location" id="selectCity" name="id_province" data-type="city"
                                                data-placeholder="Chọn tỉnh/thành">
                                                <option></option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->matinhthanh }}" {{ $city->matinhthanh == $store->id_province ? 'selected' : '' }} >{{ $city->matinhthanh }} -
                                                        {{ $city->tentinhthanh }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex mb-2">
                                        <label class="col-md-3 control-label">Quận/ huyện:<span class="required"
                                                aria-required="true">(*)</span></label>
                                        <div class="col-md-9">
                                            <select class="form-control js-location" id="selectDistrict" name="id_district"
                                                data-type="district" data-placeholder="Chọn quận/huyện">
                                                @foreach ($districts as $district)
                                                    <option value="{{$district->maquanhuyen}}"
                                                        @if ($district->maquanhuyen == $store->id_district)
                                                            selected
                                                        @endif
                                                    >
                                                        {{$district->maquanhuyen}} - {{$district->tenquanhuyen}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex mb-2">
                                        <label class="col-md-3 control-label">Phường/ Xã:<span class="required"
                                                aria-required="true">(*)</span></label>
                                        <div class="col-md-9">
                                            <select id="selectWard" name="id_ward" data-type="ward"
                                                data-placeholder="Chọn phường/xã" class="form-control js-location">
                                                @foreach ($wards as $ward)
                                                    <option value="{{$ward->maphuongxa}}"
                                                        @if ($ward->maphuongxa == $store->id_ward)
                                                            selected
                                                        @endif
                                                    >
                                                        {{$ward->maphuongxa}} - {{$ward->tenphuongxa}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label text-left">Sản phẩm:</label>
                                        <div class="col-md-12">
                                            <select class="form-control select-product" id="select-product" name="products[]" multiple data-storeid="{{$store->id}}">
                                                @if (is_array(old('products')))
                                                    @foreach (old('products') as $product)
                                                        <option value="{{ $product }}" selected="selected">{{ App\Models\Product::where('id', $product)->value('name') }} (#{{$product}})</option>
                                                    @endforeach
                                                @else 
                                                    @if (count($products) > 0)
                                                        @foreach ($products as $item)
                                                            <option value="{{$item->id}}" selected>{{$item->name}} (#{{$item->id}})</option>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div id="show_products">
                                        @if (count($products) > 0)
                                            @foreach ($products as $product)
                                                @include('admin.store.product_store', ['product' => $product, 'store' => $store])
                                            @endforeach
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-info">Cập nhật cửa hàng</button>
                        </div>

                    </div>
                </form>

                @if (auth()->guard('admin')->user()->can('Xóa mã ưu đãi'))
                    <form action="{{ route('store.delete', $store->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa cửa hàng</button>
                        {{-- <a class="btn btn-danger" href="{{route('store.deleteProductStore', [$store->id, 2])}}">Xóa cửa hàng</a>
                        <a class="btn btn-danger" href="{{ url('admin/cua-hang/san-pham/'.$store->id.'/2')}}">Xóa cửa hàng</a> --}}
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
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
            $('.js-location').select2({
                width: '100%',
            })
            $('.for_user').select2();

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
                                $.each(response.data, function(idx, val) {
                                    html += "<option value='" + val.maquanhuyen + "'>" +
                                        val.maquanhuyen + " - " + val.tenquanhuyen +
                                        "</option>";
                                });
                                $('#selectDistrict').html('').append(html);
                                $('#selectWard').html('');
                            } else {
                                html = "<option>Mời bạn chọn Phường/Xã</option>";
                                $.each(response.data, function(idx, val) {
                                    html += "<option value='" + val.maphuongxa + "'>" +
                                        val.maphuongxa + " - " + val.tenphuongxa +
                                        "</option>";
                                });
                                $('#selectWard').html('').append(html);
                            }

                        }
                    }
                });
            });
        });
    </script>

    <script>
        $('#select-product').select2({
            width: '100%',
            multiple: true,
            minimumInputLength: 3,
            dataType: 'json',
            delay: 250,
            ajax: {
                url: `{{ route('store.getProduct') }}`,
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
            placeholder: 'Chọn sản phẩm...',
            templateResult: formatRepoSelection,
            templateSelection: formatRepoSelection
        })

        function formatRepoSelection(repo) {
            if (repo.text) {
               return repo.text
            } else {
                return `${repo.name} (#${repo.id})`;
            }
        }

        $('#select-product').change(function() {
            // let arr_id = $(this).val()
            let arr_id = $('option', this).filter(':selected:last').val()
            console.log(arr_id);
            console.log('get last', arr_id);
            $.ajax({
                type: "GET",
                url: "{{route('store.getListProduct')}}",
                data: {
                    product_id: arr_id,
                    store_id: $(this).data('storeid')
                },
                success: function (response) {
                    $('#show_products').append(response.html)
                }
            });
        })
    </script>
    {{-- ajax show product and product category --}}

@endpush
