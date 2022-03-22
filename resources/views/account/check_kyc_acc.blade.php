@extends('layout.master')

@section('title', 'Trang chủ')

@push('css')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet" type="text/css">
    
@endpush
    
@section('content')

<style>
    .nen_kyc {
        width: 100%;
        border: 1px solid gray;
        background: #e1efbb url({{url('public/nen_kyc.jpg')}});
    }
</style>
<div class="container">
<div class="row" style="padding: 100px 0px; width: 100%">
<div class="col-md-12"><div class="alert alert-danger text-center">Hiện bạn chưa được EKYC thành công, mời bạn nhập đầy đủ thông tin để admin xét duyệt để nhận nhiều yêu đãi từ chúng tôi!</div></div>
    <div class="col-md-12">
        <p style="width: 100%">
            <button type="button" class="btn btn-primary btn-lg btn-block text-uppercase"> 
                <a href="{{ route('ekyc.getVerify')}}" class="text-white">Tôi muốn EKYC để xác định quyền lợi !!</a>
            </button>
        </p>
    </div>
    <div class="col-md-6">
        <button type="button" class="btn btn-danger btn-lg btn-block text-uppercase">QUYỀN LỢI KHÁCH HÀNG</button>
    </div>
    <div class="col-md-6">
        <button type="button" class="btn btn-danger btn-lg btn-block text-uppercase">Lịch sử giao dịch</button>
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

