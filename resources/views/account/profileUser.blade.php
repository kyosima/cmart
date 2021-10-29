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

                <form action="profileUser" method="POST" role="form" enctype="multipart/form-data">
                @csrf
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                @if($profileUser->avatar != null)
                    <img src="{{asset('/public/storage/upload/'.$profileUser->avatar)}}" width="150px" height="150px"/>
                    <input type="file" class="form-control" name="avatar" id="img_avatar" style="display: none">
                    <label for="img_avatar" class="btn btn-primary profile-button mt-2">Cập nhật avatar</label>
                @else
                    <img class="rounded-circle mt-3" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    <input type="file" class="form-control" name="avatar" id="img_avatar" style="display: none">
                    <label for="img_avatar" class="btn btn-primary profile-button mt-2">Cập nhật avatar</label>
                @endif

                <span class="font-weight-bold">{{$profileUser->name}}</span><span class="text-black-50">{{$profileUser->email}}</span><span> 
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

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>

                <div class="row mt-2">
                    @if($profileUser->check_kyc == 2 || $profileUser->check_kyc == 0 )
                    <div class="col-md-12"><label class="labels">Họ Tên</label><input type="text" name="hoten" class="form-control" placeholder="first name" value="{{$profileUser->hoten}}"></div>
                </div>
                <div class="row mt-3">
                    
                    <div class="col-md-12"><label class="labels">Số điện thoại</label><input type="text" name="phone" class="form-control" placeholder="Enter phone number" value="{{$profileUser->phone}}"></div>
                    <div class="col-md-12 mt-2"><label class="labels">Giấy tờ tùy thân</label>
                        <select class="form-select" name="type_cmnd" aria-label="Default select example">
                          <option selected>
                                @if($profileUser->type_cmnd == 0)
                                    Chọn loại giấy tờ tùy thân
                                @elseif($profileUser->type_cmnd == 1)
                                    Chứng minh nhân dân
                                @elseif($profileUser->type_cmnd == 2)
                                    Căn cước công dân
                                @elseif($profileUser->type_cmnd == 3)
                                    Hộ chiếu
                                @else
                                @endif  
                          </option>
                          <option value="1">Chứng minh nhân dân</option>
                          <option value="2">Căn cước công dân</option>
                          <option value="3">Hộ chiếu</option>
                        </select>
                        <input type="text" class="form-control" name="cmnd" placeholder="Mời nhập số CMND/CCCD/Hộ chiếu" value="{{$profileUser->cmnd}}">
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Ảnh CMND</label>
                        @if($profileUser->cmnd_image != null)
                        <img id="imgFileUpload" alt="Select File" title="Select File" src="{{asset('/public/storage/upload/'.$profileUser->cmnd_image)}}" width="100%" height="250px" style="cursor: pointer" />
                        <br />
                        <span id="spnFilePath"></span>
                        <input type="file" id="FileUpload1" style="display: none" name="image_cmnd" id="img_cmnd" />
                        @else
                        <p style="color:red">
                            <input type="file" class="form-control" name="image_cmnd" id="img_cmnd" style="display: none">
                            <label for="img_cmnd">Click vào đây để chọn ảnh CMND của bạn</label>
                        </p>
                        @endif
                    </div>
                    <div class="col-md-12 mt-2"><label class="labels">Address Line 1</label></div>
                    
                    <div class="col-md-6 mt-1">
                        <input type="text" name="address" class="form-control" placeholder="Địa chỉ" value="{{$profileUser->address}}">
                    </div>
                    <div class="col-md-6 mt-1">
                        <select name="tinhthanh" class="form-control select2" data-placeholder="---Chọn tỉnh thành---" required>
                            
                            @if($profileUser->id_tinhthanh != null)
                                @foreach ($province as $value)
                                <option value="{{$value->matinhthanh}}">{{ $value->tentinhthanh }}</option>
                                @endforeach
                            @else
                                <option value="">---Chọn tỉnh thành---</option>
                                @foreach ($province as $value)
                                <option value="{{$value->matinhthanh}}">{{ $value->tentinhthanh }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6 mt-2">
                        <select name="phuongxa" class="form-control select2" data-placeholder="---Chọn tỉnh thành---" required>
                            @if($profileUser->id_phuongxa != null)
                                @foreach ($ward as $value)
                                <option value="{{$value->maphuongxa}}">{{ $value->tenphuongxa }}</option>
                                @endforeach
                            @else
                                <option value="">---Chọn phường xã---</option>
                                @foreach ($ward as $value)
                                <option value="{{$value->maphuongxa}}">{{ $value->tenphuongxa }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-6 mt-2">
                        <select name="quanhuyen" class="form-control select2" data-placeholder="---Chọn tỉnh thành---" required>
                            @if($profileUser->id_quanhuyen != null)
                                @foreach ($district as $value)
                                <option value="{{$value->maquanhuyen}}">{{ $value->tenquanhuyen }}</option>
                                @endforeach
                            @else
                                <option value="">---Chọn quận huyện---</option>
                                @foreach ($district as $value)
                                <option value="{{$value->maquanhuyen}}">{{ $value->tenquanhuyen }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                    @else
                    <div class="col-md-12">
                        <p>Họ tên: {{$profileUser->hoten}}</p>
                        <p>Số điện thoại: {{$profileUser->phone}}</p>
                        <p>Giấy tờ tùy thân: 
                                @if($profileUser->type_cmnd == 0)
                                    Chọn loại giấy tờ tùy thân
                                @elseif($profileUser->type_cmnd == 1)
                                    Chứng minh nhân dân
                                @elseif($profileUser->type_cmnd == 2)
                                    Căn cước công dân
                                @elseif($profileUser->type_cmnd == 3)
                                    Hộ chiếu
                                @else
                                @endif  

                                - {{$profileUser->cmnd}}
                        </p>
                        <p>Ảnh CMND: </p>
                        <p><img title="Select File" src="{{asset('/public/storage/upload/'.$profileUser->cmnd_image)}}" width="100%" height="250px" /></p>
                        <p>Địa chỉ: {{$profileUser->address}} - {{$profileUser->id_phuongxa}} - {{$profileUser->id_quanhuyen}} - {{$profileUser->id_tinhthanh}}</p>
                    </div>
                    @endif
                </div>



                
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
  <script type="text/JavaScript" 
src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js">
</script>
    <script type='text/javascript'>
    window.onload = function () {
        var fileupload = document.getElementById("FileUpload1");
        var filePath = document.getElementById("spnFilePath");
        var image = document.getElementById("imgFileUpload");
        image.onclick = function () {
            fileupload.click();
        };
        fileupload.onchange = function () {
            var fileName = fileupload.value.split('\\')[fileupload.value.split('\\').length - 1];
            filePath.innerHTML = "<b>Selected File: </b>" + fileName;
        };
    };
    </script>
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

