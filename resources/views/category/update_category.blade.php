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
    <h3 class="title1">THÊM MỚI Loại sản phẩm</h3>
    @foreach($update_category as $key => $value)
    <form action="{{route('update.category.save',['category_id'=>$value->category_id])}}" method="post">
        @csrf
        <div class="wr_container">
            <div class="wr_name">
                <label class="wr_lb">Tên loại sản phẩm:</label><span class="wr_require">*</span>
            </div>
            <div class="wr_input">
                <input type="text" name="category_name" value="{{$value->category_name}}" required="">
            </div>
        </div>
        <div class="wr_container wr_action">
            <input type="submit" class="wr_add" value="Thêm mới"><input class="wr_cancel" type="button" value="Hủy" onclick="window.history.back()">
        </div>
    </form>
    @endforeach
</div>
@endsection
