@extends('layout.master')

@section('title', 'Đăng ký tài khoản doanh nghiệp')

@push('css')
    <link href="{{ asset('public/css/account.css') }}" rel="stylesheet" type='text/css' />
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center text-primary text-uppercase">Đăng ký tài khoản doanh nghiệp</h3>
            </div>
        </div>
        <form action="{{ route('company.post.register') }}" method="post" enctype="multipart/form-data">
            @csrf
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $err)
                        {{ $err }}<br>
                    @endforeach
                </div>
            @endif
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="number" class="form-control" name="phone"
                            placeholder="Mời nhập Số điện thoại đăng ký giao dịch" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="fullname" placeholder="Mời nhập Tên người đại diện"
                            required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" name="company_name" placeholder="Mời nhập Tên công ty"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="company_licensen_id"
                            placeholder="Mời nhập Mã số thuế" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Mời nhập mật khẩu"
                            required>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" name="repassword" placeholder="Mời nhập lại mật khẩu"
                            required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <select name="sel_province" class="form-control" data-placeholder=" Cấp tỉnh " required>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control " name="sel_ward" data-placeholder=" Cấp xã " required>
                            <option value=""> Cấp xã </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <select class="form-control " name="sel_district" data-placeholder=" Cấp huyện " required>
                            <option value=""> Cấp huyện </option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <input type="text" class="form-control mt-0" name="address" placeholder="Mời nhập địa chỉ chi tiết">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Giấy phép kinh doanh mặt trước <sup class="text-danger">*</sup></label>
                        <input type='file' id="companylicensenfront" name="company_licensen_image_front"
                            class="d-none" required accept="image/png, image/gif, image/jpeg" />
                        <label class="w-100" for="companylicensenfront"><img id="preview-company-front"
                                src="{{ asset('public/company_licensen/company_license_default.jpeg') }}"
                                class="w-100" style="height: 300px" />
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Giấy phép kinh doanh mặt sau <sup class="text-danger">*</sup></label>
                        <input type='file' id="companylisencenback" name="company_licensen_image_back"
                            class="d-none" required accept="image/png, image/gif, image/jpeg" />
                        <label class="w-100" for="companylisencenback"><img id="preview-company-back"
                                src="{{ asset('public/company_licensen/company_license_default.jpeg') }}"
                                class="w-100" style="height: 300px" />
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group text-center">
                        <button class="btn btn-primary" type="submit">Xác nhận đăng ký</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/address.js') }}"></script>
    <script>
        function readURL(input, s) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    s.attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#companylicensenfront").change(function() {
            readURL(this, $('#preview-company-front'));
        });
        $("#companylisencenback").change(function() {
            readURL(this, $('#preview-company-back'));
        });
    </script>
@endpush
