@extends('admin.layout.master')

@section('title', 'Sản phẩm-Tất cả sản phẩm')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/product.css') }}" type="text/css">
    <script src="https://cdn.jsdelivr.net/gh/amiryxe/easy-number-separator/easy-number-separator.js"></script>
@endpush

@section('content')
    <div class="m-3">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('product.store') }}" method="post" data-parsley-validate="">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 class="cart-title">Tất cả sản phẩm</h5>
                            <div class="card-tool">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="productTable" class="table table-bordered table-striped table-main"
                                    width="100%">
                                    <thead class=" bg-dark text-light" style="vertical-align: middle;">
                                        <tr>
                                            <th>ID</th>
                                            <th class="title-text">
                                                Mã Sản phẩm
                                            </th>
                                            <th class="title-text">
                                                Tên sản phẩm
                                            </th>
                                            <th class="title-text">
                                                C
                                            </th>
                                            <th class="title-text">
                                                M
                                            </th>
                                            <th class="title-text">
                                                Phí xử lý
                                            </th>
                                            <th class="title-text">
                                                Phân loại
                                            </th>
                                            <th class="title-text">
                                                Trọng lượng vận chuyển
                                            </th>
                                            <th class="title-text">
                                                Trạng thái
                                            </th>
                                            <th class="title-text">
                                                Thao tác
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('/js/admin/product.js') }}"></script>

    <script>
          function formatNum(num, separator, fraction) {
            var str = num.toLocaleString('en-US');
            str = str.replace(/\./, fraction);
            str = str.replace(/,/g, separator);
            return str;
        }
        $(document).ready(function() {
            $('#productTable').DataTable({

                order: [
                    [1, 'desc']
                ],
                responsive: true,
                lengthMenu: [
                    [25, 50, -1],
                    [25, 50, "All"]
                ],
                ajax: "{{ route('product.indexDatatable') }}",
                columnDefs: [{
                        targets: 0,
                        render: function(data, type, row) {
                            return `${row.id}`
                        }
                    },
                    {
                        targets: 1,
                        render: function(data, type, row) {
                            return `${row.sku}`
                        }
                    },
                    {
                        targets: 2,
                        type: "html",

                        render: function(data, type, row) {
                            return `<a style="text-decoration: none;" href="${window.location.href}/edit/${row.id}">${row.title}</a>`
                        }
                    },
                    {
                        targets: 3,
                        render: function(data, type, row) {
                            return `${row.product_price.cpoint}`
                        }
                    },
                    {
                        targets: 4,
                        render: function(data, type, row) {
                            return `${row.product_price.mpoint}`
                        }
                    },
                    {
                        targets: 5,
                        render: function(data, type, row) {
                            if(row.product_price.fee_process != null){
                                return formatNum(row.product_price.fee_process , '.', ',');

                            }else{
                                return formatNum( 0, '.', ',');

                            }

                        }
                    },
                    {
                        targets: 6,
                        render: function(data, type, row) {
                            // return new Intl.NumberFormat('vi-VN', {
                            //     style: 'currency',
                            //     currency: 'VND'
                            // }).format(row.product_price.shock_price)
                            if (row.is_variation == 0 ) {
                                return `Thường`;
                            } else {
                                return `Có biến thể`;
                            }
                        }
                    },
                    {
                        targets: 7,
                        render: function(data, type, row) {
                            return  ``;
                        }
                    },
                    {
                        targets: 8,
                        render: function(data, type, row) {
                            if (row.status == 1) {
                                return `Hoạt động`
                            }else{
                                return `Ngưng hoạt động`
                            }
                         

                        }
                    },
                    
                    {
                        targets: 9,
                        type: 'html',
                        render: function(data, type, row) {
                            return ``
                        }
                    },
                ],
            
               
            });
        });
    </script>
@endpush
