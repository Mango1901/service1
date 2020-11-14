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
    <a href="javascript:" data-href="{{route('register')}}" class="btn btn-primary mb-3 register" data-content="iframe" data-title="Thêm Mới Kỹ Sư"><i class="fa fa-fw fa-file-alt"></i>Thêm mới kĩ sư</a>
    <table class="tb table-bordered">
        <tr class="bgr">
            <td>Name</td>
            <td>Email</td>
            <td>Action</td>
        </tr>
        @foreach($user as $key => $value)
            <tr class="bgr4">
                <td>{{$value->name}}</td>
                <td>{{$value->email}}</td>
                <td class="text-center"><a href="{{route('add.user.update',['id'=>$value->id])}}" title="Sửa thông tin">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a href="{{route('delete.user',['id'=>$value->id])}}" title="Xoá thông tin" onclick="return confirm('Bạn có chắc chắn muốn xoá người dùng này!')">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="paginate" style="float: right;height: 55px">
    {{ $user->links() }}
@endsection
