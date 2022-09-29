@extends('admin.layout.master')

@section('title', 'Kho hàng/Cửa hàng')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/store.css') }}" type="text/css">
@endpush

@section('content')
    <div class="m-3">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="cart-title">Sản phẩm cửa hàng {{ $store->title }}</h5>
                        <div class="card-tool">
                            <button class="btn btn-info text-light addProductStore"
                                data-url="{{ route('store.addProduct', $store->id) }}">Thêm sản phẩm</button>
                            <a class="btn btn-primary" href="{{ route('store.edit', $store->id) }}">Sửa thông tin</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="store-info">
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="block">
                                        <b for="">Giới thiệu</b>
                                        <p>{{ $store->introduce }}</p>
                                    </div>
                                    <div class="block">
                                        <b for="">Địa chỉ</b>
                                        <p> {{ $store->store_address->address }},{{ $store->store_address->ward?->tenphuongxa }},
                                            {{ $store->store_address->district?->tenquanhuyen }},
                                            {{ $store->store_address->province?->tentinhthanh }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="block">
                                        <b for="">Admin</b>
                                        <p>
                                            @foreach ($store->store_admins as $item)
                                                {{ $item->admin->email }} |
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="block">
                                        <b for="">Tồn kho</b>
                                        <p>
                                            {{formatNumber($store->store_products->sum('quantity'))}} sản phẩm
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="tableStoreProduct" class="table table-bordered table-striped table-main"
                                width="100%">
                                <thead class=" bg-dark text-light" style="vertical-align: middle;">
                                    <tr>
                                        <th class="title-text">
                                            Tên sản phẩm
                                        </th>
                                        <th class="title-text">
                                            Hiển thị cho
                                        </th>
                                        <th>Loại sản phẩm</th>
                                        <th class="title-text">
                                            Số lượng
                                        </th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($store->store_products as $store_product)
                                        @include('admin.store.include.row_store_product', $store_product)
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-area">

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('/public/js/admin/store.js') }}"></script>
@endpush
