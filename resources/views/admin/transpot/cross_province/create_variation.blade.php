@extends('admin.layout.master')

@section('title', 'Điểm đi ' . $province_from->tentinhthanh)

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/admin/transpot.css') }}" type="text/css">
@endpush

@section('content')
    <div class="m-3">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('transpot.cross_province.variation.store')}}" method="post" enctype="multipart/form">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="cart-title">Thêm điểm đến mới</h5>
                            <div class="card-tool">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Điểm đi</label>
                                        <input type="text" class="form-control" name="province_id"
                                            value="{{ $province_from->tentinhthanh }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Chọn định danh khách hàng</label>
                                        <select class="form-control" name="user_level_id" id="">
                                            @foreach($user_levels as $level)
                                                <option value="{{$level->id}}">{{$level->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Chọn điểm đến</label>
                                        <select name="transpot_to" class="form-control" id="">
                                            @foreach ($provinces as $province)
                                                <option value="{{ $province->matinhthanh }}">{{ $province->tentinhthanh }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @for ($i = 1; $i < 3; $i++)
                                    <div class="col-md-6 col-xs-12">
                                        <p><b>Bảng phí {{ $i == 1 ? 'Tiêu chuẩn' : 'Tốc độ' }}</b></p>
                                        <div class="transpot-form">
                                            <input type="hidden" name="type[]" value="{{ $i }}">
                                            <div class="form-group">
                                                <label for="">Phạm vi số gam nhỏ nhất</label>
                                                <input id="ip_limiWeightMin{{ $i }}" type="text"
                                                    min="0" class="form-control" value="" required
                                                    data-parsley-required-message="Không được để trống">
                                                <input id="limiWeightMin{{ $i }}" type="hidden"
                                                    name="limit_weight_min[]" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Phạm vi số gam lớn nhất nhất</label>
                                                <input id="ip_limiWeightMax{{ $i }}" type="text"
                                                    min="0" class="form-control" value="" required
                                                    data-parsley-required-message="Không được để trống">
                                                <input id="limiWeightMax{{ $i }}" type="hidden"
                                                    name="limit_weight_max[]" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Phí tối thiểu</label>
                                                <input id="ip_feeMin{{ $i }}" type="text" min="0"
                                                    class="form-control" value="" required
                                                    data-parsley-required-message="Không được để trống">
                                                <input id="feeMin{{ $i }}" type="hidden" name="fee_min[]"
                                                    value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Phí tối thiểu</label>
                                                <input id="ip_feeDefault{{ $i }}" type="text" min="0"
                                                    class="form-control" value="" required
                                                    data-parsley-required-message="Không được để trống">
                                                <input id="feeDefault{{ $i }}" type="hidden"
                                                    name="fee_default[]" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Phí suất đóng gói</label>
                                                <input id="ip_feePackage{{ $i }}" type="text" min="0"
                                                    class="form-control" value="" required
                                                    data-parsley-required-message="Không được để trống">
                                                <input id="feePackage{{ $i }}" type="hidden"
                                                    name="fee_package[]" value="" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Phí suất trọng lượng</label>
                                                <input id="ip_feeWeight{{ $i }}" type="text" min="0"
                                                    class="form-control" value="" required
                                                    data-parsley-required-message="Không được để trống">
                                                <input id="feeWeight{{ $i }}" type="hidden"
                                                    name="fee_weight[]" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-center">
                                <div class="col-md-6 col-xs-12">
                                    <button class="btn btn-primary w-100">Thêm điểm đến</button>
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
    <script src="https://cdn.jsdelivr.net/gh/amiryxe/easy-number-separator/easy-number-separator.js"></script>
    @for ($i = 1; $i < 3; $i++)
        <script>
            easyNumberSeparator({
                selector: '#ip_limiWeightMin{{ $i }}',
                separator: '.',
                resultInput: '#limiWeightMin{{ $i }}',
            })
            easyNumberSeparator({
                selector: '#ip_limiWeightMax{{ $i }}',
                separator: '.',
                resultInput: '#limiWeightMax{{ $i }}',
            })
            easyNumberSeparator({
                selector: '#ip_feeMin{{ $i }}',
                separator: '.',
                resultInput: '#feeMin{{ $i }}',
            })
            easyNumberSeparator({
                selector: '#ip_feeDefault{{ $i }}',
                separator: '.',
                resultInput: '#feeDefault{{ $i }}',
            })
            easyNumberSeparator({
                selector: '#ip_feePackage{{ $i }}',
                separator: '.',
                resultInput: '#feePackage{{ $i }}',
            })
            easyNumberSeparator({
                selector: '#ip_feeWeight{{ $i }}',
                separator: '.',
                resultInput: '#feeWeight{{ $i }}',
            })
        </script>
    @endfor
@endpush
