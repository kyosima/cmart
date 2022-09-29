@extends('admin.layout.master')

@section('title', 'Dịch vụ vận chuyển C-Mart')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/admin/transpot.css') }}" type="text/css">
@endpush

@section('content')
    <div class="m-3">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="cart-title">Dịch vụ vận chuyển C-Mart</h5>
                        <div class="card-tool">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <p><b>Hình thức vận chuyển Tiêu chuẩn</b></p>
                                <ul class="list-cmart-price-detail">
                                    @foreach ($transpot_normal_price_details as $item)
                                        <li><a class="btn btn-secondary w-100" href="{{ route('transpot.cmart.edit', $item->id) }}">Bảng phí của {{ $item->user_level->name }}</a> </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <p><b>Hình thức vận chuyển Tốc độ</b></p>
                                <ul class="list-cmart-price-detail">
                                    @foreach ($transpot_fast_price_details as $item)
                                        <li><a class="btn btn-secondary w-100" href="{{ route('transpot.cmart.edit', $item->id) }}">Bảng phí của {{ $item->user_level->name }}</a> </li>
                                    @endforeach
                                </ul>
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
            </div>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
@endpush
