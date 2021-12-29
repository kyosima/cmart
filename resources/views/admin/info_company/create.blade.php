@extends('admin.layout.master')

@section('title', 'Tạo trang mới')


@section('content')
<x-alert />
<div class="m-3">
    <div class="wrapper bg-white p-4">
        <div class="portlet-body">
        <div class="d-flex justify-content-end align-items-center">
            @if(auth()->guard('admin')->user()->can('Xem DS trang đơn'))
            <a href="{{route('info-company.index')}}" class="btn btn-success"><i class="fa fa-list" aria-hidden="true"></i> DS Trang</a>
            @endif
        </div>
            <form action="{{ route('info-company.store') }}" class="needs-validation" method="post" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="in_name" class="form-label">Tiêu đề:</label>
                    <input type="text" class="form-control" id="in_name" name="in_name" placeholder="Tiêu đề" value="{{ old('in_name') }}" required>
                    <div class="invalid-feedback">
                        Vui lòng nhập tiêu đề
                    </div>
                    <div class="valid-feedback">
                        Hợp lệ!
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="inStatus" class="form-label">Trạng thái</label>
                        <select class="form-select" id="inStatus" name="in_status" required>
                            <option value="1">Hoạt động</option>
                            <option value="0">Ngưng</option>
                        </select>
                        <div class="invalid-feedback">
                            Vui lòng chọn.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="inStatus" class="form-label">Loại</label>
                        <select class="form-select" id="inStatus" name="in_type" required>
                            @foreach($type as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Vui lòng chọn.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="in_sort" class="form-label">Thứ tự:</label>
                        <input type="number" class="form-control" id="in_sort" name="in_sort" min="0" placeholder="Số thứ tự" value="{{ old('in_sort') }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Nội dung:</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="btn btn-info">Tạo</button>
            </form>
        </div>
    </div>
</div>
<div class="footer text-center">
    <spans style="font-size: 12px;">Copyright©2005-2021 . All rights reserved</spans>
</div>

@endsection

@push('scripts')
<script src={{ asset('/public/packages/ckeditor/ckeditor.js') }}></script>
<script src={{ asset('js/admin/validate-form.js') }}></script>

<script>
    CKEDITOR.replace( 'description' );
</script>
@endpush
