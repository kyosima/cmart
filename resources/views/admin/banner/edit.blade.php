@extends('admin.layout.master')

@section('title', 'Sửa Banner')

@push('css')
<link rel="stylesheet" href="{{ asset('public/css/admin/jquery-ui.css') }}">
<style>
    .image_link{
        cursor: move;
    }
    .image_link i{
        position: absolute;
    }
</style>
@endpush
@section('content')
<x-alert />
<div class="m-3">
    <div class="wrapper bg-white p-4">
        <div class="d-flex justify-content-between">
            <h2>Sửa {{ typeBanner($type) }}</h2>
            <div class="row check_have">
                <div class="col text-right">
                    <button class="add_picture btn btn-outline-info" data-preview="div.reorder-photos-list">
                        Thêm ảnh
                    </button>
                </div>
            </div>
        </div>
        <div class="portlet-body">
            <form id="formBanner" action="{{ route('admin.banner.update') }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="type" value="{{ $type }}">
                <div class="row reorder-photos-list">
                @forelse($banner as $value)
                    <div class="col-xs-12 col-md-12 ui-sortable-handle mt-4">
                        <div style="float:none;position: relative;" class="image_link">
                            <div class="form-group mb-3">
                                <label for="">Liên kết</label>
                                <input type="text" name="link[]" class="form-control" placeholder="Liên hết" value="{{$value->link}}">
                            </div>
                            
                            <img class="img-thumbnail show_img" src="{{asset($value->image)}}" alt="">
                            <i class="fas fa-trash-alt"></i>
                        </div>
                        <input type="hidden" name="image[]" value="{{ $value->image }}">
                        <input type="hidden" name="id[]" value=" {{ $value->id }}">
                    </div>
                @empty
                @endforelse  
                </div>
                <button type="submit" class="btn btn-primary">Lưu lại</button>
            </form>
        </div>
    </div>
</div>
<div class="footer text-center">
    <spans style="font-size: 12px;">Copyright©2005-2021 . All rights reserved</spans>
</div>

@endsection

@push('scripts')
<script src="{{ asset('public/js/admin/jquery-ui.js') }}"></script>
<script src="{{ asset('public/packages/ckfinder/ckfinder.js') }}"></script>
<script src="{{ asset('public/js/admin/banner.js') }}"></script>

@endpush
