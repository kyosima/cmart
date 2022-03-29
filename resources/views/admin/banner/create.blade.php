@extends('admin.layout.master')

@section('title', 'Thêm Banner')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/admin/jquery-ui.css') }}">
    <style>
        .image_link {
            cursor: move;
        }

        .image_link i {
            position: absolute;
        }
        .form-group{
            padding: 10px 0px;
        }

    </style>
@endpush
@section('content')
    <x-alert />
    <div class="m-3">
        <div class="wrapper bg-white p-4">
            <div class="d-flex justify-content-between">
                <h2>Thêm banner</h2>
                {{-- <div class="row check_have">
                    <div class="col text-right">
                        <button class="add_picture btn btn-outline-info" data-preview="div.reorder-photos-list">
                            Thêm ảnh
                        </button>
                    </div>
                </div> --}}
            </div>
            @if (session('message'))
            <div class="portlet-status mb-2">
                <div class="caption bg-success p-3">
                    <span class="caption-subject bold uppercase text-light">{{ session('message') }}</span>
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="portlet-body">
                <form id="formBanner" action="{{ route('admin.banner.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="file">
                        <img id="preview-banner" src="{{asset('public/image/banner/banner-default.png')}}" class="w-100" alt="">
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Chọn Trang hiển thị <sup class="text-danger">*</sup></label>
                                <select name="id_location" id="" class="form-control" required>
                                    <option value="">Mời nhập trang hiển thị</option>
                                    @foreach ($locations as $location)
                                        <option value="{{$location->id}}">{{$location->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Đơn vị sử dụng <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" name="unit_name" placeholder="Mời nhập đơn vị sử dụng" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Hạn sử dụng <sup class="text-danger">*</sup></label>
                                <input type="date" class="form-control" name="expire_date" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Liên kết <sup class="text-danger">*</sup></label>
                                <input type="text" class="form-control" name="link" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Lưu lại</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="footer text-center">
        <span style="font-size: 12px;">Copyright©2005-2021 . All rights reserved</span>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('public/js/admin/jquery-ui.js') }}"></script>
    <script src="{{ asset('public/packages/ckfinder/ckfinder.js') }}"></script>
    <script src="{{ asset('public/js/admin/banner.js') }}"></script>
@endpush
