<?php use Illuminate\Support\Facades\Session; ?>
@extends('layout')
@section('content')
    <h2 style="text-align: center" class="title1">Sửa thông tin Khách Hàng</h2>
        <?php
        $message = Session::get('message');
        if($message){
            echo '<p style="color: green;font-size: 20px;text-align: center;">'.$message.'</p>';
            Session::put('message',NULL);
        }
        ?>
        <?php
        $error = Session::get('error');
        if($error){
        echo '<p style="color: green;font-size: 20px;text-align: center;">'.$error.'</p>';
        Session::put('error',NULL);
        }
        ?>
                <div style="background-color: aliceblue;">
                    @foreach($update_service as $key => $value)
        <form action="{{route('add.service.update.save',['id'=>$value->services_id])}}" method="post">
            @csrf
            <div class="wr_content">
                <h3 class="title1">CẬP NHẬT DỊCH VỤ</h3>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Khách hàng:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <select name="customer_id" id="Name" class="form-control input-sm m-bot15 choose" required="">
                            <option value="{{$value->Customer->customer_id}}">{{$value->Customer->customer_name}}</option>
                            @foreach($customer as $key => $value1)
                                <option value="{{$value1->customer_id}}">{{$value1->customer_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Ngày bắt đầu:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input_date">
                        <input type="date" name="start_date" value="{{$value->start_date}}" required="">
                    </div>
                </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Ngày kết thúc:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input_date">
                        <input type="date" name="end_date" value="{{$value->end_date}}"  required="">
                    </div>
                </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Địa chỉ:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input choose"  id="Address">
                        <input type="text" name="Address" value="{{$value->Customer->customer_address}}" readonly required="">
                    </div>
                </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Tên sản phẩm:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <select name="product_id" id="Product" class="form-control input-sm m-bot15 choose_product" required="">
                            <option value="{{$value->product_id}}">{{$value->Product->product_name}}</option>
                            @foreach($product as $key => $value1)
                                <option value="{{$value1->product_id}}">{{$value1->product_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Serial:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input choose_product" id="Serial">
                        <input type="text" name="Serial" value="{{$value->Product->product_serial}}" readonly required="">
                    </div>
                </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Kỹ sư lắp đặt:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <select name="installation_engineer" class="form-control input-sm m-bot15">
                            <option value="{{$value->installation_engineer_id}}">{{$value->User->name}}</option>
                            @foreach($user as $key => $value2)
                                <option value="{{$value2->id}}">{{$value2->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Tình trạng:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <select name="Status" class="form-control input-sm m-bot15">
                                    <option value="{{$value->Status}}">{{$value->StatusService->Status_name}}</option>
                                    @foreach($Status_service_list as $key => $value3)
                                        <option value="{{$value3->Status_id}}">{{$value3->Status_name}}</option>
                                    @endforeach
                                </select>
                    </div>
                </div>
                <div class="wr_container wr_action">
                    <input class="wr_add" type="submit" value="Cập nhật"><input class="wr_cancel" type="button" value="Hủy" onclick="window.history.back()" >
                </div>
            </div>
        </form>

    @endforeach
@endsection
