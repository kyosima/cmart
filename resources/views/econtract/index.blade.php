@extends('layout.master')

@section('title', 'Xác thực thông tin tài khoản')
@push('css')

    <link rel="stylesheet" href="{{ asset('public/sdk_econtract/vnpt-econtract.min.css') }}">
    <script src="{{ asset('public/sdk_econtract/vnpt-econtract.min.js')}}"></script>
@endpush
@section('content')
    <div class="container">
        <div class="row d-none">
            <div class="col-md-12 col-12">
                <div class="">
                    <label>Access Token:</label>
                    <input class="form-control" type="text" id="accesstoken" style="margin-bottom: 16px" value="">
                </div>
              
                <div class="">
                    <label>ID hợp đồng:</label>
                    <span><i>(Nhập ID hợp đồng đối với trường hợp muốn vào thẳng màn hình view hợp đồng)</i></span>
                    <input class="form-control" type="text" id="contractGroupId" style="margin-bottom: 16px" value="{{$contractId}}">
    
                </div>
               <div>
                <label>Hành động (action):</label>
                <input class="form-control" type="text" id="action" style="margin-bottom: 16px" value="SIGN">
               </div>
           
    
              
            </div>
          
        </div>
        <div class="row">
            <div class="col-md-12 col-xs-12 text-center">
                <button class="btn btn-primary btn-open-webview"
                onclick="openWebview()">Xem và ký hợp đồng giao dịch</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    VNPTeContract.init();

    VNPTeContract.callBackEndSign = function (data) {
        console.log(data);
        if (data) {
            if (data.status == "SIGN_SUCCESS") {
                console.log("Ký thành công!");
                location.href = "{{route('econtract.signSuccess')}}";
            } else if (data.status == "CANCEL") {
                console.log("Tắt popup và huỷ phiên làm việc với VNPT eContract!");
            }
        }
    }

    function openWebview() {
        var accessToken = document.getElementById("accesstoken");
        var contractGroupId = document.getElementById("contractGroupId");
        var action = document.getElementById("action");

        var data = {
            accessToken: accessToken.value,
            contractId: contractGroupId.value,
            action: action.value
        }
        VNPTeContract.open(data);
    }
</script>
@endpush
