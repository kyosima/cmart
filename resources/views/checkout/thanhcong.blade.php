@extends('layout.master')

@section('title', 'Đặt hàng thành công')

@push('css')
    <link rel="stylesheet" href="{{asset('css/thanhtoan.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
@endpush

    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center">Đặt hàng thành công</h3>
            </div>
        </div>
    </div>
    @endsection

@push('scripts')
@endpush