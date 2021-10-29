@extends('admin.layout.master')

@section('title', 'Dashboard')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/amcharts.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
@endpush

    @section('content')

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Level</th>
                                <th>Edit</th>
                                <th>Check KYC</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $k)
                            <tr class="odd gradeX" align="center">
                                <td>{{$k->id}}</td>
                                <td>{{$k->name}}</td>
                                <td>{{$k->email}}</td>
                                <td>{{$k->phone}}</td>
                                <td>@if($k->level == 1)
                                        {{"Member Vip"}}
                                    @else
                                        {{"Member Thuong"}}
                                    @endif
                                </td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="profile/{{$k->id}}"> Edit</a></td>
                                <td>
                                    @if($k->check_kyc == 0)
                                        Chưa duyệt!
                                    @elseif($k->check_kyc == 1)
                                        Đồng ý
                                    @else
                                        Từ chối
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    @endsection


@push('scripts')
    <script src="{{ asset('js/admin/amcharts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/serial.js') }}" type="text/javascript"></script>
@endpush