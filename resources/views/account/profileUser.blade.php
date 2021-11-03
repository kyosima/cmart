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
                <form action="{{url('thong-tin-tai-khoan')}}" method="POST" role="form" enctype="multipart/form-data">
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
                    Member Vip
                @elseif($profileUser->level==2)
                    Cộng tác viên
                @else
                    Member bình thường
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
                @if($profileUser->check_kyc == 2 || $profileUser->check_kyc == 0 )
                    <!-- <div class="col-md-12"><div class="alert alert-danger">Hiện bạn chưa được duyệt KYC thành công, mời bạn nhập đầy đủ thông tin để admin xét duyệt để nhận nhiều yêu đãi từ chúng tôi!</div></div> -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>

                <div class="row mt-2">

                    <div class="col-md-12"><label class="labels">Họ Tên</label><input type="text" name="hoten" class="form-control" placeholder="first name" value="{{$profileUser->hoten}}"></div>
                </div>
                <div class="row mt-3">
                    
                    <div class="col-md-12"><label class="labels">Số điện thoại</label><input type="text" name="phone" class="form-control" placeholder="Enter phone number" value="{{$profileUser->phone}}"></div>
                    <div class="col-md-12 mt-2"><label class="labels">Giấy tờ tùy thân</label>
                        <select class="form-select" name="type_cmnd" aria-label="Default select example">
                            @if($profileUser->type_cmnd == 0)
                                <option value="0" selected>Chọn loại giấy tờ tùy thân</option>
                            @elseif($profileUser->type_cmnd == 1)
                                <option value="1" selected>Chứng minh nhân dân</option>
                            @elseif($profileUser->type_cmnd == 2)
                                <option value="2" selected>Căn cước công dân</option>
                            @elseif($profileUser->type_cmnd == 3)
                                <option value="3" selected>Hộ chiếu</option>
                            @else
                            @endif  
                            
                            @if($profileUser->type_cmnd != 1)
                                <option value="1">Chứng minh nhân dân</option>
                            @else
                            @endif

                            @if($profileUser->type_cmnd != 2)
                                <option value="2">Căn cước công dân</option>
                            @else
                            @endif
                            
                            @if($profileUser->type_cmnd != 3)
                                <option value="3">Hộ chiếu</option>
                            @else
                            @endif
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
                        <select name="city" class="form-control select2 choose city" id="city" data-placeholder="---Chọn tỉnh thành---" required>
                            <option value="">-- Chọn tỉnh thành/thành phố --</option>
                            @foreach ($province as $key => $k)
                                <option value="{{$k->matinhthanh}}">{{ $k->tentinhthanh }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mt-2">
                        <select name="district" class="form-control select2 choose district" id="district" data-placeholder="---Chọn tỉnh thành---">
                            <option value="">--Chon Phuong Xa--</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-2">
                        <select name="ward" class="form-control select2 choose ward" id="ward" data-placeholder="---Chọn tỉnh thành---">
                            <option value="">--Chon Quan Huyen--</option>
                        </select>
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">
                        Save Profile
                    </button></div>
                    @else
                    <div class="col-md-12">
                    <div class="alert alert-success">Bạn đã được xét duyệt KYC thành công. Để thay đổi thông tin liên hệ vui lòng liên lạc admin</div>
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
    <script type='text/javascript'>
        $(document).ready(function(){
            $('.choose').on('change',function(){
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                if(action == 'city') {
                    result = 'district';
                } else {
                    result = 'ward';
                }
                $.ajax({
                    url : '{{url('/thong-tin-tai-khoan')}}',
                    method: 'POST',
                    data:{action:action, ma_id:ma_id,_token:_token},
                    success: function (data) {
                        $('#'+result).html(data);
                    }
                })
            });
        })
    </script>
@endpush

