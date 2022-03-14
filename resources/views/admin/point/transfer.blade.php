@extends('admin.layout.master')

@section('title', 'Chuyển khoản C')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/amcharts.css') }}" type="text/css">
    <style>
        .form-group {
            padding: 10px 5px;
        }

        .method2 {
            display: none;
        }

    </style>
@endpush

@section('content')

    <div class="m-3">
        <div class="  p-4">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-12 ">
                    @if (Session::has('message'))
                        <p class="alert alert-danger text-center">{{ Session::get('message') }}</p>
                    @endif
                    <div class="bg-white wrapper p-4">
                        <form action="{{ route('point.postTransfer') }}" class="form" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="code_customer"
                                    placeholder="Mã HSKH nhận C" required>
                            </div>
                            <div class="form-group">
                                <select name="method" class="form-control" required>
                                    <option value="1">Chuyển nhanh</option>
                                    <option value="2">Phong tỏa</option>
                                    <option value="3">Hoàn tiền GD</option>
                                </select>
                            </div>
                            <div class="form-group method2">
                                <label for="">Thời gian nhận</label>
                                <input type="datetime-local" class="form-control" name="time" value="">
                            </div>
                            <div class="form-group">
                                <textarea name="content" class="w-100" cols="30" rows="10" placeholder="Nội dung chuyển khoản"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Số dư hiện tại</label>
                                <input type="number" class="form-control" name="old_balance"
                                    value="{{ $cmart_wallet->point_c }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Giá trị giao dịch</label>
                                <input type="number" class="form-control" name="amount" value=""
                                    max="{{ $cmart_wallet->point_c }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Số dư cuối</label>
                                <input type="number" class="form-control" name="new_balance"
                                    value="{{ $cmart_wallet->point_c }}" readonly>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100">Chuyển khoản</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $('input[name="amount"]').on('keyup', function() {
            if (BigInt(($(this).val()) > BigInt($('input[name="old_balance"]').val()))) {
                $(this).val($('input[name="old_balance"]').val());
                $('input[name="new_balance"]').val(0);
            } else {
                $('input[name="new_balance"]').val($('input[name="old_balance"]').val() - $(this).val());
            }
        });
        $('select[name="method"]').on('change', function() {
            if ($(this).val() == 2) {
                $('.method2').css('display', 'block');
            } else {
                $('.method2').css('display', 'none');
            }
        });
    </script>
@endpush
