<?php use Illuminate\Support\Facades\Session; ?>
@extends('layout')
@section('content')
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
        echo '<p style="color: red;font-size: 20px;text-align: center;">'.$error.'</p>';
        Session::put('error',NULL);
    }
    ?>
    <div style="background-color: aliceblue;" class="boday">
        @foreach($update_customer as $key => $value)
        <form action="{{route('update.customer.save',['customer_id'=>$value->customer_id])}}" method="post">
            @csrf

            <div class="wr_content">
                <h3 class="title1">THÊM MỚI DỊCH VỤ</h3>

                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Khách hàng:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <input type="text" name="customer_name" value="{{$value->customer_name}}" required="">
                    </div>
                </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Address:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <input type="text" name="customer_address" value="{{$value->customer_address}}" required="">
                    </div>
                </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Email:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <input type="text" name="customer_email" value="{{$value->customer_email}}" required="">
                    </div>
                </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Phone:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <input type="number" name="customer_phone" value="{{$value->customer_phone}}" required="">
                    </div>
                </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Contact:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <input type="text" name="customer_contact" value="{{$value->customer_contact}}" required="">
                    </div>
                </div>
                <div class="wr_container wr_action">
                    <input class="wr_add" type="submit" value="Thêm mới"><input class="wr_cancel" type="button" value="Hủy" onclick="window.history.back()" >
                </div>
            </div>
        </form>
            @endforeach
    </div>
@endsection
