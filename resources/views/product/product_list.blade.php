<?php use Illuminate\Support\Facades\Session; ?>
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
        echo '<p style="color: red;font-size: 20px;text-align: center;">'.$error.'</p>';
        Session::put('error',NULL);
    }
    ?>
    <h2 style="" class="title1">LIỆT KÊ SẢN PHẨM</h2>
    <a href="javascript:" data-href="{{route('add.product')}}" class="btn btn-primary mb-3 product" data-content="iframe" data-title="Thêm Mới Sản Phẩm">Thêm mới</a>
    {{-- <h2 style="" class="title1"></h2> --}}

    <table class="tb table-bordered">
        <tr class="bgr">
            <td>Category Name</td>
            <td>Product Name</td>
            <td>Product Model</td>
            <td>Product Serial</td>
            <td>Product Notes</td>
            <td>Product Images</td>
            <td>Action</td>
        </tr>
        @foreach($product as $key => $value)
            @can('view',$value)
            <tr class="bgr4">
                <td style="">{{$value->Category->category_name}}</td>
                <td style="">{{$value->product_name}}</td>
                <td style="">{{$value->product_model}}</td>
                <td style="">{{$value->product_serial}}</td>
                <td style="">{{$value->product_notes}}</td>
                <td class="text-center"><img src="{{URL::to('CongtyTamViet/uploads/'.$value->product_image)}}" width="200" height="150"></td>

                <td class="text-center">
                    @can('update',$value)
                    <a href="{{URL::to('/update-product/'.$value->product_id)}}" title="Sửa thông tin">
                        <i class="fa fa-pencil"></i>
                    </a>
                    @endcan
                        @can('delete',$value)
                    <a href="{{route('delete.product',['product_id'=>$value->product_id])}}" title="Xoá thông tin" onclick="return confirm('Bạn có chắc chắn muốn xoá người dùng này!')">
                        <i class="fa fa-trash"></i>
                    </a>
                        @endcan
                </td>
            </tr>
            @endcan
        @endforeach
    </table>
    <div class="paginate" style="float: right;height: 55px">
        {{ $product->links() }}
    </div>
       {{--  <div>
            <button class="btn btn1 btn-primary"><a style="color: white" href="{{URL::to('add-product')}}">+ Thêm mới</a></button>
        </div> --}}
        <br>

@endsection
