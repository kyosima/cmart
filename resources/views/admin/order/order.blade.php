@extends('admin.layout.master')

@section('title', 'Đơn hàng')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/select2.css') }}" type="text/css">
@endpush

@section('content')
<x-alert />
<!-- Team -->
<div class="team m-3">
    <div class="team_container py-3 px-4">
		<div class="row">
			<div class="col-sm-12">
				<div class="card mb-3">
					<div class="card-body">
						<div class="d-flex justify-content-between align-items-center">
							<p></p>

								<span>
									<span data-bs-toggle="collapse" href="#collapseExample1" role="button"
										aria-expanded="false" aria-controls="collapseExample1">
										<i class="fas fa-chevron-down"></i>
									</span>&nbsp;
									<!-- <span><i class="fas fa-sync-alt"></i></span>&nbsp; -->
									<!-- <span><i class="fas fa-expand"></i></span> -->
								</span>
						</div>
						<div class="collapse show" id="collapseExample1">
							<div class="row">
								<div class="col-sm-6">
									<div class="chart-pie pt-4 pb-2">
										<canvas id="myPieChart"></canvas>
									</div>
									<div class="mt-4 text-center small">
										<span class="me-2">
											<i class="fas fa-circle text-primary"></i> Đã đặt hàng</i> 
										</span>
										<span class="me-3">
											<i class="fas fa-circle text-secondary"></i> Đã xác nhận thanh toán
										</span>
										<span class="me-2">
											<i class="fas fa-circle text-warning"></i> Đang xử lý
										</span>
										<span class="me-2">
											<i class="fas fa-circle text-info"></i> Đang vận chuyển
										</span>
										<span class="me-2">
											<i class="fas fa-circle text-success"></i> Hoàn thành
										</span>
										<span class="me-2">
											<i class="fas fa-circle text-danger"></i> Đã hủy
										</span>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="chart-pie pt-4 pb-2">
										<canvas id="myPieChart1"></canvas>
									</div>
									<div class="mt-4 text-center small">
										<span class="me-2">
											<i class="fas fa-circle text-primary"></i> Cmart(Nhận tại cửa hàng)</i> 
										</span>
										<span class="me-3">
											<i class="fas fa-circle text-secondary"></i> Cship(Trong HCM)
										</span>
										<span class="me-2">
											<i class="fas fa-circle text-warning"></i> Viettel Post
										</span>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<ul class="list-group list-group-flush">
							
							<div class="d-flex justify-content-between align-items-center">
								<p>
									<span class="caption-subject"><i class="fas fa-cart-plus"></i> DANH SÁCH ĐƠN HÀNG</span>
									{{-- <a class="btn btn_success" href="{{route('order.create')}}"><i class="fas fa-plus"></i> Thêm mới</a> --}}
									<a href="{{route('order.exports')}}" class="btn btn_success"><i class="far fa-file-excel"></i>
										Xuất Excel</a>
								</p>

								<span>
									<span data-bs-toggle="collapse" href="#collapseExample" role="button"
										aria-expanded="false" aria-controls="collapseExample">
										<i class="fas fa-chevron-down"></i>
									</span>&nbsp;
									<!-- <span><i class="fas fa-sync-alt"></i></span>&nbsp; -->
									<!-- <span><i class="fas fa-expand"></i></span> -->
								</span>
							</div>
							<div class="collapse show" id="collapseExample">
								<form action="{{ route('order.multiple') }}" method="post">
									@csrf
									<div class="row align-items-center mb-3">
										<div class="col-sm-9">
											<div class="input-group action-multiple" style="display:none">
											<select class="custom-select" name="action" required >
												<option value="">Chọn hành động</option>
												<option value="delete">Xóa</option>
												<optgroup label="Trạng thái">
													<option value="0">Đã đặt hàng</option>
													<option value="1">Đã xác nhận thanh toán</option>
													<option value="2">Đang xử lý</option>
													<option value="3">Đang vận chuyển</option>
													<option value="4">Hoàn thành</option>
													<option value="5">Đã hủy</option>
												</optgroup>
											</select>
											<div class="input-group-append">
												<button class="btn btn-outline-secondary" type="submit">Áp dụng</button>
											</div>
										</div></div>
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
														<th class="title" style="width: 30px;"><input class="form-check" name="checkAll" type="checkbox"></th>
														<th class="title">Mã giao dịch</th>
														<th class="title">GTTT sản phẩm</th>
														<th class="title">Trạng thái</th>
														<th class="title">Phí DVVC</th>
														<th class="title">Tổng GTGD</th>
														<th class="title">Ghi chú</th>
														<th class="title" style="width:75px;">Thao tác</th>
													</tr>
												</thead>
												<tbody style="color: #748092; font-size: 14px;">
													@foreach ( $orders as $order)
													<tr>
														<td><input type="checkbox" name="id[]" value="{{ $order->id }}"></td>
														<td><a target="_blank" href="{{route('order.viewPDF', ['order_code'=>$order->order_code])}}">{{$order->order_code}}</a></td>
														<td>{{number_format($order->sub_total)}} đ</td>
														<td>{!! orderStatus($order->status) !!}</td>
														<td>{{ number_format($order->shipping_total) }} đ</td>
														<td>{{number_format($order->total)}} đ</td>
														<td>{{ optional($order->order_info)->note }}</td>
														{{-- <td>
															<div class="btn-group" role="group" aria-label="Basic mixed styles example">
																@if(auth()->guard('admin')->user()->can('Xem đơn hàng'))
																<a href="{{route('order.show', ['order' => $order->id])}}" class="btn bg-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
																@endif
																@if(auth()->guard('admin')->user()->can('Xem DS đơn hàng'))
																<button type="button" data-url="{{route('order.delete', ['order' => $order->id])}}" class="btn btn-danger ajax-delete"><i class="fa fa-trash"></i></button>
																@endif
															</div>
														</td> --}}
														<td>
															<a class="btn modal-edit-unit"
															href="{{route('order.show', ['order' => $order->id])}}">
															<i class="fas fa-pen"></i>
														</a>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</form>
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
	<script src="{{ asset('/public/js/chart.js/Chart.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/admin/ajax-form.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/admin/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/order.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/checklist.js') }}"></script>
    <!-- format language -->

    <script>
        $(document).ready(function() {

            $('#tblOrder').DataTable({
                columnDefs: [
                    { orderable: false, targets: [0, 9] }
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
		// Set new default font family and font color to mimic Bootstrap's default styling
		Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
		Chart.defaults.global.defaultFontColor = '#858796';
		var array = ['Đã đặt hàng', 'Đã xác nhận thanh toán', 'Đang xử lý', 'Đang vận chuyển', 'Hoàn thành', 'Đã hủy'];
		var data = ['{{ $orders_count[0] ?? 0 }}', '{{$orders_count[1] ?? 0}}', '{{$orders_count[2] ?? 0}}', '{{$orders_count[3] ?? 0}}', '{{$orders_count[4] ?? 0}}', '{{$orders_count[5] ?? 0}}'];
		// Pie Chart Example
		var ctx = document.getElementById("myPieChart");
		var myPieChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
				labels: array,
				datasets: [{
					data: data,
					backgroundColor: ['#0d6efd', '#6c757d', '#ffc107', '#0dcaf0', '#198754', '#dc3545'],
					hoverBackgroundColor: ['#0d6efd', '#6c757d', '#ffc107', '#0dcaf0', '#198754', '#dc3545'],
					hoverBorderColor: "rgba(234, 236, 244, 1)",
				}],
			},
			options: {
				maintainAspectRatio: false,
				tooltips: {
					backgroundColor: "rgb(255,255,255)",
					bodyFontColor: "#858796",
					borderColor: '#dddfeb',
					borderWidth: 1,
					xPadding: 15,
					yPadding: 15,
					displayColors: false,
					caretPadding: 10,
				},
				legend: {
					display: false
				},
				cutoutPercentage: 80,
			},
		});
		data =  [ {{$shipping_method_count[0] ?? 0}}, {{$shipping_method_count[1] ?? 0}}, {{$shipping_method_count[2] ?? 0}}];
		var ctx1 = document.getElementById("myPieChart1");
		var myPieChart1 = new Chart(ctx1, {
			type: 'doughnut',
			data: {
				labels: ['Cmart(Nhận tại cửa hàng)', 'Cship(Trong HCM)', 'Viettel Post'],
				datasets: [{
					data: data,
					backgroundColor: ['#0d6efd', '#6c757d', '#ffc107'],
					hoverBackgroundColor: ['#0d6efd', '#6c757d', '#ffc107'],
					hoverBorderColor: "rgba(234, 236, 244, 1)",
				}],
			},
			options: {
				maintainAspectRatio: false,
				tooltips: {
					backgroundColor: "rgb(255,255,255)",
					bodyFontColor: "#858796",
					borderColor: '#dddfeb',
					borderWidth: 1,
					xPadding: 15,
					yPadding: 15,
					displayColors: false,
					caretPadding: 10,
				},
				legend: {
					display: false
				},
				cutoutPercentage: 80,
			},
		});
    </script>
@endpush
