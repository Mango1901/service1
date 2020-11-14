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
    <h2 style="" class="title1">LIỆT KÊ LOẠI SẢN PHẨM </h2>
    <a href="javascript:" data-href="{{route('add.category')}}" class="btn btn1 btn-primary category" data-content="iframe" data-title="Thêm Mới Loại Sản Phẩm">+ Thêm mới</a>
    <table class="tb table-bordered ">
        <tr class="bgr">
            <td width="80%">Name</td>
            <td>Action</td>
            {{-- <td></td> --}}
        </tr>
        @foreach($category as $key => $value)
            @can('view',$value)
            <tr class="bgr4">
                <td style="">{{$value->category_name}}</td>
                <td class="text-center">
                    @can('update',$value)
                    <a href="{{route('update.category',['category_id'=>$value->category_id])}}" title="Sửa thông tin">
                        <i class="fa fa-pencil"></i>
                    </a>
                    @endcan
                        @can('delete',$value)
                    <a href="{{route('delete.category',['category_id'=>$value->category_id])}}" title="Xoá thông tin" onclick="return confirm('Bạn có chắc chắn muốn xoá người dùng này!')">
                        <i class="fa fa-trash"></i>
                    </a>
                        @endcan
                </td>
            </tr>
            @endcan
        @endforeach
    </table>
    <div class="paginate" style="float: right;height: 55px">
        {{ $category->links() }}
    </div>
@endsection
