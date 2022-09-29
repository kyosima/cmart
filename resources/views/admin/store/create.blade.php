@extends('admin.layout.master')

@section('title', 'Kho hàng/Cửa hàng')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/store.css') }}" type="text/css">
@endpush

@section('content')
    <div class="m-3">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('store.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="cart-title">Thêm cửa hàng</h5>
                            <div class="card-tool">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Tên cửa hàng <sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" placeholder="Nhập tên cửa hàng"
                                            name="title" value="" required
                                            data-parsley-required-message="Không được để trống">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Giới thiệu</label>
                                        <textarea name="introduce" class="w-100" rows="3" placeholder="Nhập giới thiệu cửa hàng"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Admin cửa hàng <sup class="text-danger">*</sup></label>
                                        <select class="selectpicker form-control" id="selectAdmins" name="admin_ids[]"
                                            required data-parsley-required-message="Không được để trống" multiple>
                                            @foreach ($admins as $admin)
                                                <option value="{{ $admin->id }}">{{ $admin->email }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Chọn quốc gia <sup class="text-danger">*</sup></label>
                                        <select class="form-control selectpicker" id="selectCountry" name="country_id"
                                            required data-parsley-required-message="Không được để trống" data-url={{route('country.getLocation')}}>
                                                <option value="">Chọn quốc gia</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        <p>
                                            <a class="text-primary" data-toggle="collapse" href="#collapseExample"
                                                role="button" aria-expanded="false" aria-controls="collapseExample">
                                                Thêm quốc gia
                                            </a>
                                        </p>
                                        <div class="collapse" id="collapseExample">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control"
                                                   name="country_name" placeholder="Nhập tên quốc gia">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" id="addCountry" type="button" data-url="{{route('country.store')}}">Thêm</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="locationCountry">
                                      
                                    </div>
                                    <div class="form-group">
                                        <label for="">Địa chỉ chi tiết <sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" name="address"
                                            placeholder="Nhập địa chỉ chi tiết" required
                                            data-parsley-required-message="Không được để trống">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-center">
                                <div class="col-md-6 col-xs-12">
                                    <button class="btn btn-primary w-100" type="submit">Thêm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src={{ asset('/public/js/admin/store.js') }}></script>
@endpush
