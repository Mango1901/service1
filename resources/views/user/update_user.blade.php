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
    <div>
        <button class="btn btn1"><a href="{{route('user')}}">Hiển thị kĩ sư</a></button>
    </div>
    <div class="userbox">
        <div class="header-account">
            <i class="fa fa-key"></i>
            <h2>Sửa thông tin</h2>
        </div>
        @foreach($user as $key => $value)
        <form action="{{route('add.user.update.save',['id'=>$value->id])}}" method="POST">
            @csrf
            <div>
                <label class="icon-field">Tên người dùng</label>
                <input required="" type="text" name="name" value="{{$value->name}}">
            </div>
            <div>
                <label class="icon-field">Email</label>
                <input required="" type="email" name="email" value="{{$value->email}}">
            </div>
            <div>
                <input type="submit" value="Update" class="btn btn1">
            </div>
        </form>
            @endforeach
    </div>
@endsection
