<table class="styled-table table-sortable">
        <thead>
            <tr style="text-align:center">
                <th>Mã khách hàng</th>
                <th>Số dư C</th>
                <th>Bình quân C</th>
                <th>Tăng do CK</th>
                <th>Tăng do TK</th>
                <th>Tăng do TL C</th>
                <th>Tăng do TL M</th>
                <th>Tăng do hoàn ĐH hủy</th>
                <th>Tổng tăng</th>
                <th>Tổng giảm</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $v)
            <tr>
                <td>{{$v->code_customer}}</td>
                <td>{{$v->point_c->point_c}}</td>
                <td>{{$v->point_c->point_c}}</td>
                <td>{{$tongpointnhan[$v->id - 1]->getHistoryChuyenKhoan
                    ->where('type',1)->where('created_at','>=',$today)->sum('amount')}}</td>
                <td>{{$tongpointnhan[$v->id - 1]->getHistoryChuyenKhoan
                    ->where('type',3)->where('created_at','>=',$today)->sum('amount')}}</td>
                <td>{{$tongpointnhan[$v->id - 1]->getHistoryChuyenKhoan
                    ->where('type',5)->where('created_at','>=',$today)->sum('amount')}}</td>
                <td>{{$tienViM[$v->id - 1]->getViM->where('id_vi',1)->sum('amount')}}</td>
                <td>{{$tongpointnhan[$v->id - 1]->getHistoryChuyenKhoan
                    ->where('type',4)->where('created_at','>=',$today)->sum('amount')}}</td>
                <td>
                    {{$tongpointnhan[$v->id - 1]->getHistoryChuyenKhoan->where('type',1)->where('created_at','>=',$today)->sum('amount') +
                        $tongpointnhan[$v->id - 1]->getHistoryChuyenKhoan->where('type',4)->where('created_at','>=',$today)->sum('amount') +
                        $tongpointnhan[$v->id - 1]->getHistoryChuyenKhoan->where('type',5)->where('created_at','>=',$today)->sum('amount') +
                        $tongpointnhan[$v->id - 1]->getHistoryChuyenKhoan->where('type',3)->where('created_at','>=',$today)->sum('amount') +
                        $tienViM[$v->id - 1]->getViM->where('id_vi',1)->where('created_at','>=',$today)->sum('amount')}}
                </td>
                <td>{{$tienGiam[$v->id - 1]->getTienGiam
                    ->where('type',2)->where('created_at','>=',$today)->sum('amount')}}</td>
            </tr>
            @endforeach
        </tbody>
</table>