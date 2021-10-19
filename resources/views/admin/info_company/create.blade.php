@extends('admin.layout.master')

@section('title', 'New Page')


@section('content')
<x-alert />
<div class="m-3">
    <div class="wrapper bg-white p-4">
        <div class="portlet-body">
        <div class="d-flex justify-content-end align-items-center">
                <a href="{{route('info-company.index')}}" class="btn btn-success"><i class="fa fa-list" aria-hidden="true"></i> List</a>
            </div>
            <form action="{{ route('info-company.store') }}" class="needs-validation" method="post" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="in_name" class="form-label">Title:</label>
                    <input type="text" class="form-control" id="in_name" name="in_name" placeholder="Title" value="{{ old('in_name') }}" required>
                    <div class="invalid-feedback">
                        Please enter your a title.
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="inStatus" class="form-label">Status</label>
                        <select class="form-select" id="inStatus" name="in_status" required>
                            <option value="1">Acitve</option>
                            <option value="0">Deactive</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid state.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="inStatus" class="form-label">Type</label>
                        <select class="form-select" id="inStatus" name="in_type" required>
                            @foreach($type as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid state.
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="in_sort" class="form-label">Sort:</label>
                        <input type="number" class="form-control" id="in_sort" name="in_sort" min="0" placeholder="Number sort" value="{{ old('in_sort') }}">
                        <div class="invalid-feedback">
                            Please enter your a number sort.
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Content:</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="btn btn-info">Create</button>
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
