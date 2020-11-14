@extends('layout')
@section('content')
    <h3 class="title1">TÙY CHỌN HIỂN THỊ</h3>
        <form action="{{route('get.item')}}" method="get">
        @csrf
        <div class="display">
            @foreach($status_services as $key => $value)
                <input type="checkbox" name="status_value_{{$value->Status_id}}" value="{{$value->Status_id}}"><span id="status_sv" >{{$value->Status_name}}</span>
            @endforeach
            <input type="submit" class="btn btn-primary" value="Search"/>
        </div>
    </form>
    <div class="status">
        <form action="{{route('search.list')}}" method="post">
            @csrf
            <div class="search_box pull-right">
                <input  type="text" name="search_submit" placeholder="Search" required=""/>
                <button class="btn3"> <i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
    <div class="div-btn">
        <button class="btn btn1 btn-primary"><a style="color: white" href="{{route('service')}}">+ Thêm mới</a></button>
    </div>
    <table class="tb table-bordered ">
        <tr class="bgr">
            <td>Số Serial</td>
            <td>Model</td>
            <td>Trạng thái</td>
            <td>Ngày lắp đặt</td>
            <td>Ngày hết hạn</td>
            <td>Kĩ sư lắp đặt</td>
            <td>Tên khách hàng</td>
            <td>Trạng thái</td>
        </tr>
        @foreach($service_details as $key => $value)
            @can('view',$value)
            <tr>
                <td class="seri"><a href="{{route('warranty.details',['services_id'=>$value->services_id])}}">{{$value->Product->product_serial}}</a></td>
                <td>{{$value->Product->product_model}}</td>
                <td>{{$value->StatusService->Status_name}}</td>
                <td>{{$value->start_date}}</td>
                <td>{{$value->end_date}}</td>
                <td>{{$value->User->name}}</td>
                <td>{{$value->Customer->customer_name}}</td>
                <td class="text-center">
                    @if(Session::get('id') == $value->user_id || Session::get('roles') === 'admin' || Session::Get('roles') === 'root')
                    <a href="{{route('add.service.update',['id'=>$value->services_id])}}" title="Sửa thông tin">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a href="{{route('delete.service',['id'=>$value->services_id])}}" title="Xoá thông tin" onclick="return confirm('Bạn có chắc chắn muốn xoá bản ghi này!')">
                        <i class="fa fa-trash"></i>
                    </a>
                        @endif

                </td>
            </tr>
            @endcan
        @endforeach
    </table>
    <div class="paginate" style="float: right;height: 55px">
        {{ $service_details->links() }}
    </div>
@endsection
