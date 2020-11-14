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
    <div class="wr_content">
        <h3 class="title1">THÊM sản phẩm</h3>
    @foreach($update_product as $key => $value)
    <form action="{{route('update.product.save',['product_id'=>$value->product_id])}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="wr_container">
            <div class="wr_name">
                <label class="wr_lb">Tên sản phẩm:</label><span class="wr_require">*</span>
            </div>
            <div class="wr_input">
                <input type="text" name="product_name" value="{{$value->product_name}}" required="">
            </div>
        </div>
        <div class="wr_input">
            <select name="category_name" id="Name" class="form-control input-sm m-bot15 choose" required="">
                <option value="{{$value->category_id}}">{{$value->Category->category_name}}</option>
                @foreach($category as $key => $value1)
                    <option value="{{$value1->category_id}}">{{$value1->category_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="wr_container">
            <div class="wr_name">
                <label class="wr_lb">Product Serial:</label><span class="wr_require">*</span>
            </div>
            <div class="wr_input">
                <input type="text" name="product_serial" value="{{$value->product_serial}}" required="">
            </div>
        </div>
        <div class="wr_container">
            <div class="wr_name">
                <label class="wr_lb">Product Model:</label><span class="wr_require">*</span>
            </div>
            <div class="wr_input">
                <input type="text" name="product_model" value="{{$value->product_model}}" required="">
            </div>
        </div>
        <div class="wr_container">
            <div class="wr_name">
                <label class="wr_lb">Product Notes:</label><span class="wr_require">*</span>
            </div>
            <div class="wr_input">
                <input type="text" name="product_notes" value="{{$value->product_notes}}" required="">
            </div>
        </div>
        <div class="wr_container">
            <div class="wr_name">
                <label class="wr_lb">Product Image:</label><span class="wr_require">*</span>
            </div>
            <div class="wr_input">
                <img src="{{URL::to('CongtyTamViet/uploads/'.$value->product_image)}}" >
                <input type="file" name="product_image" accept="image/x-png,image/gif,image/jpeg,image/jpg">
            </div>
        </div>
        <div class="wr_container wr_action">
            <input type="submit" class="wr_add" value="Thêm mới"><input class="wr_cancel" type="button" value="Hủy" onclick="window.history.back()">
        </div>
    </form>
    @endforeach
    </div>
@endsection
