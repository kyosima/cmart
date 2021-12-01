@extends('admin.layout.master')

@section('title', 'Quản Lý Banner')


@section('content')
<x-alert />
<div class="m-3">
    <div class="wrapper bg-white p-4">
        <div class="portlet-title d-flex justify-content-between align-items-center">
            <div class="title-name d-flex align-items-center">
                <div class="caption">
                    <i class="fa fa-anchor icon-drec" aria-hidden="true"></i>
                    <span class="caption-subject text-uppercase">
                        DANH SÁCH BANNER </span>
                    <span class="caption-helper"></span>
                </div>
                
            </div>

        </div>
        <hr>
        <div class="portlet-body">
            <div class="pt-3" style="overflow-x: auto;">
                <table id="tblInfoCompany" class="table table-hover table-main">
                    <thead class="thead1" style="vertical-align: middle;">
                        <tr>
                            <th class="title-text">
                                Loại Banner 
                            </th>
                            
                            <th class="title-text title4" >Thao tác</th>
                        </tr>
                    </thead>
                    <tbody style="color: #748092; font-size: 14px; vertical-align: middle;">
                        @foreach ($banner as $key => $item)
                            <tr>
                                <td>{{ $item }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a href="{{ route('admin.banner.edit', $key) }}" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<div class="footer text-center">
    <spans style="font-size: 12px;">Copyright©2005-2021 . All rights reserved</spans>
</div>

@endsection

@push('scripts')

@endpush
