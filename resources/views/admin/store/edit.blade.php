@extends('admin.layout.master')

@section('title', 'Kho hàng/Cửa hàng')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/store.css') }}" type="text/css">
@endpush

@section('content')
    <div class="m-3">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('store.update', $store->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="cart-title">Sửa cửa hàng</h5>
                            <div class="card-tool">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Tên cửa hàng <sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" placeholder="Nhập tên cửa hàng" name="title"
                                            value="{{$store->title}}" required data-parsley-required-message="Không được để trống">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Giới thiệu</label>
                                        <textarea name="introduce" class="w-100" rows="3" placeholder="Nhập giới thiệu cửa hàng">{{$store->introduce}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Admin cửa hàng <sup class="text-danger">*</sup></label>
                                        <select class="selectpicker form-control" id="selectAdmins" name="admin_ids[]"
                                            required data-parsley-required-message="Không được để trống" multiple>
                                            @foreach($admins as $admin)
                                                <option value="{{$admin->id}}" {{in_array($admin->id,$store->admins->pluck('id')->toArray())? 'selected' : ''}}>{{$admin->email}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <label for="">Chọn quốc gia <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" value="{{$store->store_address->country->name}}" readonly>
                                    @if($store->store_address->country_id == 1)
                                        <div class="form-group">
                                            <label for="">Chọn tỉnh thành <sup class="text-danger">*</sup></label>
                                            <select class="form-control selectpicker" id="selectProvince" name="province_id"
                                                required data-parsley-required-message="Không được để trống" data-edit="{{$store->store_address->province->matinhthanh}}">
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Chọn quận huyện <sup class="text-danger">*</sup></label>
                                            <select class="form-control selectpicker" id="selectDistrict" name="district_id"
                                                required data-parsley-required-message="Không được để trống">
                                                <option value="{{$store->store_address->district->maquanhuyen}}" selected>{{$store->store_address->district->tenquanhuyen}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Chọn phường xã <sup class="text-danger">*</sup></label>
                                            <select class="form-control selectpicker" id="selectWard" name="ward_id" required
                                                data-parsley-required-message="Không được để trống">
                                                <option value="{{$store->store_address->ward->maphuongxa}}" selected>{{$store->store_address->ward->tenphuongxa}}</option>
                                            </select>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="">Địa chỉ chi tiết <sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" name="address" value="{{$store->store_address->address}}"
                                            placeholder="Nhập địa chỉ chi tiết" required
                                            data-parsley-required-message="Không được để trống">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-center">
                                <div class="col-md-6 col-xs-12">
                                    <button class="btn btn-primary w-100" type="submit">Sửa</button>
                                </div>
                            </form>
                                <div class="col-md-6 col-xs-12">
                                    <form action="{{route('store.delete')}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="store_id" value="{{ $store->id}}">
                                        <button class="btn btn-danger w-100">Xóa</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src={{ asset('/public/js/admin/store.js') }}></script>
    <script src={{ asset('/public/js/admin/address.js') }}></script>
@endpush
