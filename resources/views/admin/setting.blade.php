@extends('admin.layout.master')

@section('title', 'Cài đặt')

@push('css')
<link rel="stylesheet" href="{{ asset('css/admin/setting.css') }}" type="text/css">
@endpush

@section('content')
<x-alert />
    <!-- Team -->
    <div class="team m-3">
        <div class="team_container card py-3 px-4">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <ul id="myTab" class="nav flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" role="tab" aria-controls="home" aria-selected="true">Thông tin chung</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" id="maintenaceMode-tab" data-bs-toggle="tab" data-bs-target="#maintenaceMode" role="tab" aria-controls="maintenaceMode" aria-selected="true">Bảo trì</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" id="mail-tab" data-bs-toggle="tab" data-bs-target="#mail" role="tab" aria-controls="mail" aria-selected="true">Mail</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" id="social-tab" data-bs-toggle="tab" data-bs-target="#social" role="tab" aria-controls="social" aria-selected="true">Mạng xã hội</a>
                        </li>
                        
                    </ul>
                </div>
                <div class="col-md-8 col-lg-9">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <h3>Thông tin chung</h3>
                            <hr>
                            <form action="{{route('post.setting')}}" class="row g-3 needs-validation" method="post" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label for="storeName" class="form-label">Tên cửa hàng</label>
                                    <input type="text" class="form-control" id="storeName" name="store_name" placeholder="Tên cửa hàng" value="{{ $setting['store_name'] }}" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập trường này.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="storePhone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="storePhone" name="store_phone" placeholder="Số điện thoại" value="{{ $setting['store_phone'] }}" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập trường này.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="storeEmail" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="storeEmail" name="store_email" placeholder="Email cửa hàng" value="{{ $setting['store_email'] }}" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập trường này.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="storeAddress" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" id="storeAddress" name="store_address" placeholder="Địa chỉ" value="{{ $setting['store_address'] }}" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập trường này.
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="maintenaceMode" role="tabpanel" aria-labelledby="profile-tab">
                            <h3>Bảo trì</h3>
                            <hr>
                            <form action="{{route('post.maintenanceMode')}}" class="row g-3" method="post">
                                @csrf
                                <div class="form-check form-switch col-auto">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Bảo trì website</label>
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="in_action" {{checked($check_maintenance_mode, 1)}}>
                                    
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary btn-sm ms-5">Lưu lại</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="mail" role="tabpanel" aria-labelledby="mail-tab">
                            <h3>Mail</h3>
                            <hr>
                            <form action="{{route('post.setting')}}" class="row g-3 needs-validation" method="post" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label for="MailFromAddress" class="form-label">Mail nhận</label>
                                    <input type="Email" class="form-control" id="MailFromAddress" name="mail_from_address" placeholder="Mail nhận" value="{{ $setting['mail_from_address'] }}" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập trường này.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="mailFromName" class="form-label">Tên mail</label>
                                    <input type="text" class="form-control" id="mailFromName" name="mail_from_name" placeholder="Tên mail" value="{{ $setting['mail_from_name'] }}" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập trường này.
                                    </div>
                                </div>
                                
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                            <h3>Mạng xã hội</h3>
                            <hr>
                            <form action="{{route('post.setting')}}" class="row g-3 needs-validation" method="post" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label for="socialZalo" class="form-label">Zalo</label>
                                    <input type="text" class="form-control" id="socialZalo" name="social_zalo" placeholder="Số zalo" value="{{ $setting['social_zalo'] }}" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập trường này.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="socialFacebook" class="form-label">Facebook</label>
                                    <input type="text" class="form-control" id="socialFacebook" name="social_facebook" placeholder="ID facebook" value="{{ $setting['social_facebook'] }}" required>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập trường này.
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!-- Team -->
    <!-- footer -->
    <div class="d-flex justify-content-center pb-1 mt-4">
        <span class="footer__copyright">Copyright©2005-2021 . All rights reserved</span>
    </div>
    <!-- end footer -->

    <!-- scroll top -->
    <div class="scroll__top">
        <a href="#"><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i></a>
    </div>
    <!-- end scroll top -->
@endsection

@push('scripts')

<script src={{ asset('js/admin/validate-form.js') }}></script>
    <!-- format language -->

@endpush
