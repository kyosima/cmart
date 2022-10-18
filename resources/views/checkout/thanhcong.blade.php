@extends('layout.master')

@section('title', 'Đặt hàng thành công')

@push('css')
    <style>
        .notice-email {
            display: none;
        }
    </style>
@endpush

@section('content')
   
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <h3 class="text-center">THÔNG BÁO XÁC NHẬN ĐẶT HÀNG THÀNH CÔNG</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <button class="btn btn-primary text-light" data-toggle="modal" data-target="#share-cbill"><i
                        class="fa fa-share"></i> Chia sẻ C-Bill</button>
            </div>
        </div>
        <div class="modal fade" id="share-cbill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="form-share-cbill" action="{{ route('share.CBill') }}" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Chia sẻ C-Bill</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="order_code" value="{{ $order->order_code }}">
                                <input type="email" name="email" class="form-control"
                                    placeholder="Mời nhập Email cần chia sẻ" required>
                            </div>
                            <div class="notice-email alert alert-success m-0 text-center">
                                <p class="m-0"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Chia sẻ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-12">
                @include('order_tracking.c_bill', [
                    'order' => $order,
                ])
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/share_cbill.js') }}"></script>
@endpush
