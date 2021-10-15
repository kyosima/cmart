@extends('admin.layout.master')

@section('title', 'New Page')


@section('content')
<div class="m-3">
    <div class="wrapper bg-white p-4">
        <div class="portlet-body">
            <form action="{{ route('info-company.store') }}" class="needs-validation" method="post" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="in_title" class="form-label">Title:</label>
                    <input type="text" class="form-control" id="in_title" name="in_title" placeholder="Title" required>
                    <div class="invalid-feedback">
                        Please enter your a title.
                    </div>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="inStatus" class="form-label">Status</label>
                        <select class="form-select" id="inStatus" name="in_status" required>
                            <option value="1">Acitve</option>
                            <option value="0">Deactive</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid state.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="inStatus" class="form-label">Type</label>
                        <select class="form-select" id="inStatus" name="in_status" required>
                            @foreach($type as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid state.
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
