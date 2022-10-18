@extends('layout.master')

@section('title', 'Lịch sử đặt hàng')

@push('css')
    <link href="{{ asset('public/css/home.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/account.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <h3 class="text-center">DANH SÁCH ĐƠN HÀNG</h3>
            </div>
        </div>
        <div class="d-flex row justify-content-center">
            <div class="col-md-6 col-12">
                <input id="myInput" class="form-control" type="text" placeholder="Mời nhập mã đơn hàng">
                <div class="table-responsive">
                    <table class="table styled-table table-sortable">
                        <thead>
                            <tr>
                                <th>Mã giao dịch</th>

                                <th>Trạng thái</th>
                                <th>Chi tiết đơn hàng</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @foreach ($orders as $order)
                                @foreach ($order->order_stores as $order_store)
                                    <tr>
                                        <td>{{ $order_store->order_store_code }}</td>
                                        <td>
                                            {!! orderStatus($order_store->status) !!}
                                        </td>
                                        <td style="text-align: center"><a target="_blank"
                                                href="{{ route('getCbill', ['order_code' => $order->order_code]) }}">Xem</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                            <!-- and so on... -->
                        </tbody>
                    </table>
                </div>

            </div>


        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                const myArray = value.split("-");
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(myArray[0]) > -1)
                });
            });
        });
    </script>
    <script type="text/JavaScript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="{{ asset('public/js/shipping.js') }}"></script>
    <script>
        function sortTableByColumn(table, column, asc = true) {
            const dirModifier = asc ? 1 : -1;
            const tBody = table.tBodies[0];
            const rows = Array.from(tBody.querySelectorAll("tr"));

            // Sort each row
            const sortedRows = rows.sort((a, b) => {
                const aColText = a.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim();
                const bColText = b.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim();

                return aColText > bColText ? (1 * dirModifier) : (-1 * dirModifier);
            });

            // Remove all existing TRs from the table
            while (tBody.firstChild) {
                tBody.removeChild(tBody.firstChild);
            }

            // Re-add the newly sorted rows
            tBody.append(...sortedRows);

            // Remember how the column is currently sorted
            table.querySelectorAll("th").forEach(th => th.classList.remove("th-sort-asc", "th-sort-desc"));
            table.querySelector(`th:nth-child(${ column + 1})`).classList.toggle("th-sort-asc", asc);
            table.querySelector(`th:nth-child(${ column + 1})`).classList.toggle("th-sort-desc", !asc);
        }

        document.querySelectorAll(".table-sortable th").forEach(headerCell => {
            headerCell.addEventListener("click", () => {
                const tableElement = headerCell.parentElement.parentElement.parentElement;
                const headerIndex = Array.prototype.indexOf.call(headerCell.parentElement.children,
                    headerCell);
                const currentIsAscending = headerCell.classList.contains("th-sort-asc");

                sortTableByColumn(tableElement, headerIndex, !currentIsAscending);
            });
        });
    </script>
@endpush
