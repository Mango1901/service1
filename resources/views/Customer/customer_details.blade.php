@extends('layout')
@section('content')
    <div class="div-btn">
        <a href="javascript:" data-href="{{route('add.customer')}}" class="btn btn-primary customer" data-content="iframe" data-title="Thêm Mới Khách Hàng">+ Thêm mới</a>
    </div>

    <table class="tb table-bordered ">
        <tr class="bgr">
            <td>Tên khách hàng</td>
            <td>Email</td>
            <td>Địa chỉ</td>
            <td>Số điện thoại</td>
            <td>Khách hàng giao tiếp</td>
            <td></td>
        </tr>
        @foreach($customer as $key => $value)
            @can('view',$value)
            <tr class="bgr4">
                <td>{{$value->customer_name}}</td>
                <td>{{$value->customer_email}}</td>
                <td >{{$value->customer_address}}</td>
                <td>{{$value->customer_phone}}</td>
                <td>{{$value->customer_contact}}</td>
                    @can('update',$value)
                    <td class="text-center">
                        <a href="{{route('update.customer',['customer_id'=>$value->customer_id])}}" title="Sửa thông tin">
                            <i class="fa fa-pencil"></i>
                        </a>
                   @endcan
                    @can('delete',$value)
                    <a href="{{route('delete.customer',['customer_id'=>$value->customer_id])}}" title="Xoá thông tin" onclick="return confirm('Bạn có chắc chắn muốn xoá bản ghi này!')">
                        <i class="fa fa-trash"></i>
                    </a>
                    @endcan
                </td>
            </tr>
            @endcan
        @endforeach
    </table>
    <div class="paginate" style="float: right;height: 55px">
        {{ $customer->links() }}
    </div>
@endsection
