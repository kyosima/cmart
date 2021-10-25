@extends('admin.layout.master')

@section('title', 'Đơn hàng')

@section('content')
<x-alert />
<!-- Team -->
<div class="team m-3">
    <div class="team_container py-3 px-4">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<ul class="list-group list-group-flush">
								<div class="d-flex justify-content-between align-items-center">
									<p>
										<span class="caption-subject"><i class="fas fa-cart-plus"></i> DANH SÁCH ĐƠN HÀNG</span>
										<button class="btn btn_success"><i class="fas fa-plus"></i> Thêm
											mới</button>
										<button class="btn btn_success"><i class="far fa-file-excel"></i>
											Xuất Excel</button>
									</p>

									<span>
										<span data-bs-toggle="collapse" href="#collapseExample" role="button"
											aria-expanded="false" aria-controls="collapseExample">
											<i class="fas fa-chevron-down"></i>
										</span>&nbsp;
										<span><i class="fas fa-sync-alt"></i></span>&nbsp;
										<span><i class="fas fa-expand"></i></span>
									</span>
								</div>
								<div class="collapse show" id="collapseExample">
									<div class="row mb-3">
										<div class="col-sm-9"></div>
										<div class="col-sm-3">
											<button type="button" class="btn btn-success"
												style="max-width: 400px; background-color: #11101D; color: #fff;">
												<str>Tổng doanh thu trong tháng</str><br>
												<span
													style="font-size: 20px; font-weight: bold; text-align: left;">{{number_format($doanh_thu)}} đ</span>
											</button>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12" style="overflow-x: auto;">
											<table id="tblOrder" class="table table-hover align-middle">
												<thead>
													<tr>
														<th class="title">ID</th>
														<!-- <th class="title"><input class="form-check" type="checkbox"></th> -->
														<th class="title">Người đặt</th>
														<th class="title">Trạng thái</th>
														<th class="title">Tổng tiền</th>
														<th class="title">Ngày tạo</th>
														<th class="title" style="width:75px;">Thao tác</th>
													</tr>
												</thead>
												<tbody style="color: #748092; font-size: 14px;">
													@foreach ( $orders as $order)
													<tr>
														<td>#{{$order->id}}</td>
														<!-- <td><input type="checkbox" name="" id=""></td> -->
														<td>{{$order->order_info->fullname}}</td>
														<td class="change-status-{{$order->id}}">{!! orderStatus($order->status) !!}</td>
														<td>{{number_format($order->total)}} đ</td>
														<td>{{date('d-m-Y H:i:s', strtotime($order->created_at))}}</td>
														
														<td>
															<div class="btn-group" role="group" aria-label="Basic mixed styles example">
																@if(auth()->guard('admin')->user()->can('Xem đơn hàng'))
																<a href="{{route('order.show', ['order' => $order->id])}}" class="btn bg-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
																@endif
																@if(auth()->guard('admin')->user()->can('Xem DS đơn hàng'))
																<button type="button" data-url="{{route('order.delete', ['order' => $order->id])}}" class="btn btn-danger ajax-delete"><i class="fa fa-trash"></i></button>
																@endif
															</div>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap5.min.js"></script>
	<script type="text/javascript" src="{{ asset('js/admin/ajax-form.js') }}"></script>
    <!-- format language -->
    <script>
        $(document).ready(function() {
            $('#tblOrder').DataTable({
                columnDefs: [
                    { orderable: false, targets: 5 }
                ],
                "language": {
                    "emptyTable": "Không có dữ liệu nào !",
                    "info": "Hiển thị _START_ đến _END_ trong số _TOTAL_ mục nhập",
                    "infoEmpty": "Hiển thị 0 đến 0 trong số 0 mục nhập",
                    "infoFiltered": "(Có _TOTAL_ kết quả được tìm thấy)",
                    "lengthMenu": "Hiển thị _MENU_ bản ghi",
                    "search": "Tìm kiếm",
                    "zeroRecords": "Không có bản ghi nào tìm thấy !",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                        "previous": '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                    }
                }
            });
        });
    </script>

@endpush
