@extends('admin.layout.master')

@section('title', $transpot_service->title)

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/admin/transpot.css') }}" type="text/css">
@endpush
@section('modals')
    <div class="modal fade" id="addTranspotToModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="systemTitleModal">Thêm tỉnh đến</h5>
                    <button type="button" class="close btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formCreateTranspotVariation" action="{{ route('transpot.cross_province.transpot_to.store') }}"
                    method="post" enctype="multipart/form">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="">Tỉnh đi</label>
                                    <input type="hidden" name="province_id" value="">
                                    <input type="text" id="provinceName" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="">Chọn tỉnh đến</label>
                                    <select name="transpot_to" class="form-control" id="">

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('content')

    <div class="m-3">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="cart-title">{{ $transpot_service->title }}</h5>
                        <div class="card-tool">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <div id="accordion">
                                    @foreach ($provinces as $province)
                                        <div class="card mb-2">
                                            <div class="card-header load-variation" id="province{{ $province->matinhthanh }}"
                                                data-toggle="collapse" data-target="#collapse{{ $province->matinhthanh }}"
                                                aria-expanded="true" aria-controls="collapse{{ $province->matinhthanh }}"
                                                role="button" >
                                                <h5 class="mb-0">
                                                    <b class=" text-danger">
                                                        {{ $province->tentinhthanh }}
                                                    </b>
                                                </h5>
                                            </div>

                                            <div id="collapse{{ $province->matinhthanh }}" class="collapse"
                                                aria-labelledby="province{{ $province->tentinhthanh }}"
                                                data-parent="#accordion" data-url="{{route('transpot.cross_province.get_list_variation', $province->matinhthanh)}}">
                                                
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/admin/transpot.js') }}"></script>
@endpush
