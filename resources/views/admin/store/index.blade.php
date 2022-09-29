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
                        <h5 class="cart-title">Danh sách cửa hàng</h5>
                        <div class="card-tool">
                            <a class="btn btn-primary" href="{{ route('store.create') }}">Thêm cửa hàng</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tableStores" class="table table-bordered table-striped table-main" width="100%">
                                <thead class=" bg-dark text-light" style="vertical-align: middle;">
                                    <tr>
                                        <td>ID</td>
                                        <th class="title-text">
                                            Tên cửa hàng
                                        </th>
                                        <th class="title-text">
                                            Admin
                                        </th>
                                        <th class="title-text">
                                            Địa chỉ
                                        </th>
                                        <th class="title-text">
                                            Số lượng tồn kho
                                        </th>
                                        <th class="title-text">
                                            Thao tác
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stores as $store)
                                        <tr>
                                            <td>{{$store->id}}</td>
                                            <td>
                                                {{ $store->title }}
                                            </td>
                                            <td>
                                                @foreach ($store->admins as $admin)
                                                    {{ $admin->email }} |
                                                @endforeach
                                            </td>
                                            <td>
                                                {{ $store->store_address->address }},{{ $store->store_address->ward?->tenphuongxa }},
                                                {{ $store->store_address->district?->tenquanhuyen }},
                                                {{ $store->store_address->province?->tentinhthanh }}
                                            </td>
                                            <td></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="actionMenu{{ $store->id }}" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-h"></i>
                                                    </button>
                                                    <div class="dropdown-menu"
                                                        aria-labelledby="actionMenu{{ $store->id }}">
                                                        <a class="dropdown-item" href="{{route('store.show', $store->id)}}">Quản lý sản phẩm</a>
                                                        <a class="dropdown-item" href="{{route('store.edit', $store->id)}}">Sửa thông tin</a>
                                                        <span class="dropdown-item" >
                                                            <form action="{{route('store.delete')}}" method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <input type="hidden" name="store_id" value="{{ $store->id}}">
                                                                <button class="btn btn-danger w-100">Xóa</button>
                                                            </form>
                                                        </span>
                                                    </div>
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
        </div>
    </div>
@endsection

@push('scripts')
@endpush
