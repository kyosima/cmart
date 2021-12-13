@extends('layout.master')

@section('title', 'Trang chủ')

@push('css')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet" type="text/css">
    
@endpush
    
@section('content')
<style>
.rounded-circle {
    border-radius: 50% !important;
}
img {
    vertical-align: middle;
    border-style: none;
}
.text-muted {
    color: #aeb0b4 !important;
}
.text-muted {
    font-weight: 300;
}
.form-control {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #4d5154;
    background-color: #ffffff;
    background-clip: padding-box;
    border: 1px solid #eef0f3;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}


</style>

<div class="container">
<div class="row justify-content-center">
    <div class="col-12 col-lg-10 col-xl-8 mx-auto">
        <h2 class="h3 mb-4 page-title"></h2>
        <div class="my-4">
            <form action="{{url('thong-tin-tai-khoan')}}" method="POST" role="form" enctype="multipart/form-data">
            @csrf    
                <div class="row mt-5 align-items-center">
                    <div class="col-md-3 text-center mb-5">
                        <div class="avatar avatar-xl">
                            @if($profileUser->avatar != null)
                                <img src="{{asset('/public/images/'.$profileUser->avatar)}}" width="150px" height="150px"/>
                                <input type="file" class="form-control" name="avatar" id="img_avatar" style="display: none">
                                <label for="img_avatar" class="btn btn-primary profile-button mt-2">Cập nhật avatar</label>
                            @else
                                <img class="rounded-circle mt-3" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                                <input type="file" class="form-control" name="avatar" id="img_avatar" style="display: none">
                                <label for="img_avatar" class="btn btn-primary profile-button mt-2">Cập nhật avatar</label>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <h4 class="mb-1">{{$profileUser->phone}}</h4>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-7">
                                <p class="text-muted" style="margin:0">
                                    <span class="text-black-50">{{$profileUser->email}}</span><span> 
                                </p>
                                <p class="text-muted">
                                    @if($profileUser->level==1)
                                        Member Vip
                                    @elseif($profileUser->level==2)
                                        Cộng tác viên
                                    @else
                                        Member bình thường
                                    @endif
                                </p>
                                <div class="">Tích lũy: {{$profileUser->tichluyC}} point</div>
                            </div>
                            <div class="col">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4" />
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstname">Họ và tên</label>
                        <input type="text" name="hoten" class="form-control" value="{{$profileUser->hoten}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastname">Số điện thoại</label>
                        <!-- <input type="text" name="phone" class="form-control" placeholder="Enter phone number" value="{{$profileUser->phone}}" readonly> -->
                        <input type="text" name="phone" class="form-control" placeholder="Enter phone number" value="{{$profileUser->phone}}">
                    </div>
                </div>
                <div class="form-group">
                    <select class="form-select mb-1" name="type_cmnd" aria-label="Default select example">
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
                    <input type="text" class="form-control" name="cmnd" value="{{$profileUser->cmnd}}">
                </div>
                <div class="form-group">
                    <label for="inputAddress5">Ảnh CMND</label>
                        @if($profileUser->cmnd_image != null)
                        <img id="imgFileUpload" src="{{asset('/public/images/'.$profileUser->cmnd_image)}}" width="100%" height="250px" style="cursor: pointer" />
                        <br />
                        <span id="spnFilePath"></span>
                        <input type="file" id="FileUpload1" style="display: none" name="image_cmnd" id="img_cmnd" />

                        @else
                        <p>
                            <input class="form-control" type="file" accept="image/*" onchange="loadFile(event)" name="image_cmnd">
                            <img id="output"/>
                        </p>
                        @endif
                </div>
                <div class="form-group">
                    <label for="inputAddress5">Ảnh CMND mặt sau</label>
                        @if($profileUser->cmnd_image2 != null)
                        <img id="imgFileUpload" src="{{asset('/public/images/'.$profileUser->cmnd_image2)}}" width="100%" height="250px" style="cursor: pointer" />
                        <br />
                        <span id="spnFilePath"></span>
                        <input type="file" id="FileUpload1" style="display: none" name="image_cmnd2" id="img_cmnd2" />
                        @else
                            <input class="form-control" type="file" accept="image/*" onchange="loadFile2(event)" name="image_cmnd2">
                            <img id="output2"/>
                        @endif
                </div>
                <div class="form-group">
                    <label for="inputAddress5">Địa chỉ</label>
                    <input type="text" name="address" class="form-control" value="{{$profileUser->address}}">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="">Tỉnh/ Thành phố<sup class="text-danger">*</sup></label>
                        @if($profileUser->id_tinhthanh == null)
                        <select name="sel_province" class="form-control select2"
                            data-placeholder="---Chọn tỉnh thành---" required>
                            <option value="">---Chọn tỉnh thành---</option>
                                @foreach ($province as $value)
                                    <option value="{{ $value->matinhthanh }}">{{ $value->tentinhthanh }}
                                    </option>
                                @endforeach
                        </select>
                        @else
                        <select name="sel_province" class="form-control select2"
                            data-placeholder="---Chọn tỉnh thành---" required>
                                <option value="{{ $profileUser->id_tinhthanh }}">
                                {{DB::table("province")->join('users', 'users.id_tinhthanh', '=', 'province.matinhthanh')
                                    ->where('province.matinhthanh','=',auth()->user()->id_tinhthanh)->select('province.tentinhthanh')->first()->tentinhthanh}}
                                </option>
                                @foreach ($province as $value)
                                    <option value="{{ $value->matinhthanh }}">{{ $value->tentinhthanh }}
                                    </option>
                                @endforeach
                        </select>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Quận/ Huyện<sup class="text-danger">*</sup></label>
                        @if($profileUser->id_quanhuyen == null)
                        <select class="form-control select2" name="sel_district"
                            data-placeholder="---Chọn quận huyên---" required>
                            <option value="">---Chọn quận huyên---</option>
                        </select>
                        @else
                        <select class="form-control select2" name="sel_district"
                            data-placeholder="---Chọn quận huyên---" required>
                            <option value="{{ $profileUser->id_tinhthanh }}">
                            {{DB::table("district")->join('users', 'users.id_quanhuyen', '=', 'district.maquanhuyen')
                                ->where('district.maquanhuyen','=',auth()->user()->id_quanhuyen)->select('district.tenquanhuyen')->first()->tenquanhuyen}}
                            </option>
                        </select>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Phường/ Xã<sup class="text-danger">*</sup></label>
                        @if($profileUser->id_phuongxa == null)
                        <select class="form-control select2" name="sel_ward"
                            data-placeholder="---Chọn phường xã---" required>
                            <option value="">---Chọn phường xã---</option>
                        </select>
                        @else
                        <select class="form-control select2" name="sel_ward"
                            data-placeholder="---Chọn phường xã---" required>
                            <option value="{{$profileUser->id_phuongxa}}">
                                {{DB::table("ward")->join('users', 'users.id_phuongxa', '=', 'ward.maphuongxa')
                                    ->where('ward.maphuongxa','=',auth()->user()->id_phuongxa)->select('ward.tenphuongxa')->first()->tenphuongxa}}
                            </option>
                        </select>
                        @endif
                    </div>
                </div>
                <hr class="my-4" />
                <div class="row mb-4">
                    <div class="col-md-6">
                    <div class="d-flex justify-content-between align-items-center experience"><span><input type="checkbox" id="changePassword" name="changePassword"> Đổi mật khẩu</span></div>
                        <div class="form-group">
                            <label for="inputPassword5">Mật khẩu mới</label>
                            <input type="password" class="form-control password" name="password" placeholder="Password" disabled>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword6">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control password" name="passwordAgain" placeholder="Re-Password" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2">Làm mới mật khẩu</p>
                        <p class="small text-muted mb-2">Để làm mới mật khẩu bạn phải đạt đủ yêu cầu như sau</p>
                        <ul class="small text-muted pl-4 mb-0">
                            <li>Có ít nhất 8 ký tự</li>
                            <li>Không có ký tự đặc biệt</li>
                            <!-- <li>At least one special character</li>
                            <li>At least one number</li>
                            <li>Can’t be the same as a previous password</li> -->
                        </ul>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Lưu Thông Tin</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>


@endsection
    
@push('scripts')
  <script type="text/JavaScript" 
src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js">
</script>
<script src="{{ asset('public/js/shipping.js') }}"></script>





<script>
    window.addEventListener("load", function() {
        const slider = document.querySelector(".slider");
        const sliderMain = document.querySelector(".slider-product");
        const sliderItems = document.querySelectorAll(".slider-product-item");
        const nextBtn = document.querySelector(".slide-btn-next");
        const prevBtn = document.querySelector(".slide-btn-prev");
        const slideritemWidth = sliderItems[0].offsetWidth;
        console.log("slideritemWidth", slideritemWidth);
    });
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
    <!-- <script type='text/javascript'>
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
    </script> -->

    <script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
  var loadFile2 = function(event) {
    var output = document.getElementById('output2');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
    </script>   
@endpush

