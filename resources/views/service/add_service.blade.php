<?php use Illuminate\Support\Facades\Session;
      use Carbon\Carbon;
?>
@extends('layout')
@section('content')
    <?php
    $message = Session::get('message');
    if($message){
        echo '<p style="color: green;font-size: 20px;text-align: center;">'.$message.'</p>';
        Session::put('message',NULL);
    }
    $error = Session::get('error');
    if($error){
        echo '<p style="color: green;font-size: 20px;text-align: center;">'.$error.'</p>';
        Session::put('error',NULL);
    }
    $carbon = Carbon::now();
    $start_date = $carbon->toDateString();
    $date = $carbon->addMonth(12);
    ?>
    <style>
        .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
        .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
        .autocomplete-selected { background: #F0F0F0; }
        /*.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }*/
        .autocomplete-group { padding: 2px 5px; }
        .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
    </style>
    <div style="background-color: aliceblue;" class="boday">
    <form action="{{route('add.service.save')}}" method="post">
        @csrf
        <h3 class="title1">THÊM MỚI DỊCH VỤ</h3>
    <div class="wr_content">

        <div class="center">
        <div class="wr_container">
            <div class="wr_name">
                <label class="wr_lb">Khách hàng:</label><span class="wr_require">*</span>
            </div>
            <div class="wr_input">
                <select name="customer_id" id="Name" class="form-control input-sm m-bot15 choose" required="">
                    <option value="">Chọn khách hàng</option>
                    @foreach($customer as $key => $value)
                        <option value="{{$value->customer_id}}">{{$value->customer_name}}</option>
                    @endforeach
                </select>
    <a href="javascript:" data-href="{{route('add.customer')}}" class="customer" data-content="iframe" data-title="Thêm mới khách hàng">Thêm mới khách hàng</a>
            </div>
        </div>
        <div class="wr_container">
            <div class="wr_name">
                <label class="wr_lb">Ngày bắt đầu:</label><span class="wr_require">*</span>
            </div>
            <div class="wr_input_date">
                <input type="date" name="start_date" value="{{$start_date}}" required="">
            </div>
        </div>
        <div class="wr_container">
            <div class="wr_name">
                <label class="wr_lb">Ngày kết thúc:</label><span class="wr_require">*</span>
            </div>
            <div class="wr_input_date">
                <input type="date" name="end_date" value="{{$date->toDateString()}}"  required="">
            </div>
        </div>
        <div class="wr_container">
            <div class="wr_name">
                <label class="wr_lb">Địa chỉ lắp đặt:</label><span class="wr_require">*</span>
            </div>
            <div class="wr_input choose" id="Address">
                <input type="text" name="Address" required="" readonly>
            </div>
        </div>
        <div class="wr_container">
            <div class="wr_name">
                <label class="wr_lb">Tên sản phẩm:</label><span class="wr_require">*</span>
            </div>
            <div class="wr_input">
                <select name="product_id" id="Product" class="form-control input-sm m-bot15 choose_product" required="">
                    <option value="">Chọn sản phẩm</option>
                    @foreach($product as $key => $value1)
                        <option value="{{$value1->product_id}}">{{$value1->product_name}}</option>
                    @endforeach
                </select>
                <a href="javascript:" data-href="{{route('add.product')}}" class="product" data-content="iframe" data-title="Thêm Mới Sản Phẩm">Thêm mới sản phẩm</a>
            </div>
        <div class="wr_container">
            <div class="wr_name">
                <label class="wr_lb">Serial:</label><span class="wr_require">*</span>
            </div>
            <div class="wr_input choose_product" id="Serial">
                <input type="text" name="Serial" readonly required="">
            </div>
        </div>
        <div class="wr_container">
            <div class="wr_name">
                <label class="wr_lb">Kỹ sư lắp đặt:</label><span class="wr_require">*</span>
            </div>
            <div class="wr_input">
                <select name="installation_engineer" id="Engineer" class="form-control input-sm m-bot15" required="">
                    <option value="">Chọn kĩ sư</option>
                    @foreach($user as $key => $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
                @if(Session::get('roles') === 'admin')
                    <a href="javascript:" data-href="{{route('register')}}" class="register" data-content="iframe" data-title="Thêm Mới Kỹ Sư">Thêm mới kĩ sư</a>
                @endif
            </div>
        </div>
        <div class="wr_container">
            <div class="wr_name">
                <label class="wr_lb">Tình trạng:</label><span class="wr_require">*</span>
            </div>
            <div class="wr_input">
                <select name="Status" class="form-control input-sm m-bot15">
                        @foreach($status_services as $key => $value2)
                    <option value="{{$value2->Status_id}}">{{$value2->Status_name}}</option>
                        @endforeach
                </select>
            </div>
        </div>
                <div class="wr_container wr_action">
                    <input class="wr_add" type="submit" value="Thêm mới">
                    <input class="wr_cancel" type="button" value="Hủy" onclick="window.history.back()" >
                </div>
        </div>
    </div>
    </div>
    </form>
    </div>
@endsection
