@extends('layout.master')

@section('title', 'Trang chủ')

@push('css')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet" type="text/css">
    
@endpush
    
@section('content')
<style>
    
.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}

</style>

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">{{$profileUser->name}}</span><span class="text-black-50">{{$profileUser->email}}</span><span> 
                @if($profileUser->level==1)
                    Member thân thiết
                @elseif($profileUser->level==2)
                    Cộng tác viên
                @elseif($profileUser->level==3)
                    Khách hàng Vip
                @else
                    Khách hàng thương mại
                @endif
            </span></div>
            <div class="text-center"><button class="btn btn-primary profile-button" type="button">Tích lũy: {{$profileUser->tichluyC}} point</button></div>
            <div class="text-center mt-2"><button class="btn btn-primary profile-button" type="button">Lịch sử giao dịch</button></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">

                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                        {{$err}}<br>
                    @endforeach
                </div>
                @endif

                @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
                @endif

                <form  method="POST" action="{{url('thong-tin-tai-khoan')}}">
               @csrf
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Họ Tên</label><input type="text" name="hoten" class="form-control" placeholder="first name" value="{{$profileUser->hoten}}"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Số điện thoại</label><input type="text" name="phone" class="form-control" placeholder="Enter phone number" value="{{$profileUser->phone}}"></div>
                    <div class="col-md-12"><label class="labels">Address Line 1</label><input type="text" name="address" class="form-control" placeholder="Địa chỉ" value="{{$profileUser->address}}"></div>
                    <div class="col-md-12"><label class="labels">Số CMND</label><input type="text" class="form-control" name="cmnd" placeholder="Số CMND" value="{{$profileUser->cmnd}}"></div>
                </div>
<!--                 <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value=""></div>
                    <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state"></div>
                </div> -->
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><span><input type="checkbox" id="changePassword" name="changePassword"> Đổi mật khẩu</span></div><br>
                <div class="col-md-12"><label class="labels">Password</label><input type="password" class="form-control password" name="password" placeholder="Password" disabled></div> <br>
                <div class="col-md-12"><label class="labels">Nhập lại password</label><input type="password" class="form-control password" name="passwordAgain" placeholder="Re-Password" disabled></div>
            </div>
        </div>
    </div>
</div>
</div>
</div>













@endsection
    
@push('scripts')
  
    <script type='text/javascript'>
        $(document).ready(function(){
            $("#changePassword").change(function(){
                if($(this).is(":checked")) {
                    $(".password").removeAttr('disabled');
                }
                else {
                    $(".password").attr('disabled','');
                }
            });
        });
    </script>
@endpush

