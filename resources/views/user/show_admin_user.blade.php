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
    <h2 style="" class="title1">Liệt kê user<button class="btn btn-add btn1 btn-primary" style="float: right;"><a style="color: white" href="{{route('register.company.admin')}}">+ Thêm mới</a></button></h2>
    <table class="tb table-bordered">
        <tr class="bgr">
            <td>Tên tài khoản admin</td>
            <td>Email</td>
            <td>Tên công ty</td>
            <td>Quyền</td>
            <td>Action</td>
        </tr>
        @foreach($user as $key => $value)
            <tr class="bgr4">
                <td>{{$value->name}}</td>
                <td>{{$value->email}}</td>
                <td>{{$value->Company->company_name}}</td>
                <td>{{$value->roles}}</td>
                <td class="text-center"><a href="{{route('add.company.admin.update',['company_id'=>$value->company_id])}}" title="Sửa thông tin">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a href="{{route('delete.company.admin',['company_id'=>$value->company_id])}}" title="Xoá thông tin" onclick="return confirm('Bạn có chắc chắn muốn xoá người dùng này!')">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="paginate" style="float: right;height: 55px">
    {{ $user->links() }}
@endsection
