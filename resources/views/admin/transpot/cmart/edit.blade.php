@extends('admin.layout.master')

@section('title', 'Dịch vụ vận chuyển C-Mart')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/admin/transpot.css') }}" type="text/css">
@endpush

@section('content')
    <div class="m-3">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('transpot.cmart.update', $transpot_price_detail->id) }}" method="post"
                    enctype="multipart/form">
                    @csrf
                    @method('put')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="cart-title"><a href="{{ route('transpot.cmart.index') }}"><i
                                        class="fas fa-chevron-left"></i></a> Bảng phí của
                                {{ $transpot_price_detail->user_level->name }} hình thức vận
                                chuyển {{ $transpot_price_detail->type == 1 ? 'Tiêu chuẩn' : 'Tốc độ' }}</h5>
                            <div class="card-tool">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="transpot-form">

                                <div class="row justify-content-center">
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form">
                                            <div class="form-group">
                                                <label for="">Phạm vi số gam nhỏ nhất</label>
                                                <input id="ip_limiWeightMin" type="text" min="0" 
                                                    class="form-control"
                                                    value="{{ $transpot_price_detail->limit_weight_min }}" required
                                                    data-parsley-required-message="Không được để trống">
                                                <input id="limiWeightMin" type="hidden" name="limit_weight_min"
                                                    value="{{ $transpot_price_detail->limit_weight_min }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Phạm vi số gam lớn nhất nhất</label>
                                                <input id="ip_limiWeightMax" type="text" min="0" 
                                                    class="form-control"
                                                    value="{{ $transpot_price_detail->limit_weight_max }}" required
                                                    data-parsley-required-message="Không được để trống">
                                                <input id="limiWeightMax" type="hidden" name="limit_weight_max"
                                                    value="{{ $transpot_price_detail->limit_weight_max }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Phí tối thiểu</label>
                                                <input id="ip_feeMin" type="text" min="0" 
                                                    class="form-control" value="{{ $transpot_price_detail->fee_min }}"
                                                    required data-parsley-required-message="Không được để trống">
                                                <input id="feeMin" type="hidden" name="fee_min"
                                                    value="{{ $transpot_price_detail->fee_min }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Phí tối thiểu</label>
                                                <input id="ip_feeDefault" type="text" min="0" 
                                                    class="form-control" value="{{ $transpot_price_detail->fee_default }}"
                                                    required data-parsley-required-message="Không được để trống">
                                                <input id="feeDefault" type="hidden" name="fee_default"
                                                    value="{{ $transpot_price_detail->fee_default }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Phí suất đóng gói</label>
                                                <input id="ip_feePackage" type="text" min="0" 
                                                    class="form-control" value="{{ $transpot_price_detail->fee_package }}"
                                                    required data-parsley-required-message="Không được để trống">
                                                <input id="feePackage" type="hidden" name="fee_package"
                                                    value="{{ $transpot_price_detail->fee_package }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="row justify-content-center">
                                <div class="col-6 text-center">
                                    <button class="btn btn-primary w-100" type="submit">Lưu lại</button>
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

    <script>
        easyNumberSeparator({
            selector: '#ip_limiWeightMin',
            separator: '.',
            resultInput: '#limiWeightMin',
        })
        easyNumberSeparator({
            selector: '#ip_limiWeightMax',
            separator: '.',
            resultInput: '#limiWeightMax',
        })
        easyNumberSeparator({
            selector: '#ip_feeMin',
            separator: '.',
            resultInput: '#feeMin',
        })
        easyNumberSeparator({
            selector: '#ip_feeDefault',
            separator: '.',
            resultInput: '#feeDefault',
        })
        easyNumberSeparator({
            selector: '#ip_feePackage',
            separator: '.',
            resultInput: '#feePackage',
        })
    </script>
@endpush
