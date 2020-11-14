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
        <button class="btn btn1"><a href="{{route('company.admin')}}">Hiển thị Admin</a></button>
    </div>
    <div class="userbox">
        <div class="header-account">
            <i class="fa fa-key"></i>
            <h2>Đăng Ký Admin</h2>
        </div>
        <form action="{{route('save.register.company.admin')}}" method="POST">
            @csrf
            <div>
                <label class="icon-field">Tên người dùng</label>
                <input required="" type="text" name="name" placeholder="Name:">
            </div>
            <div>
                <label class="icon-field">Email</label>
                <input required="" type="email" name="email" placeholder="Email:">
            </div>
            <div>
                <label class="icon-field">Mật khẩu</label>
                <input required="" type="password" name="password" placeholder="Password:">
            </div>
            <div>
                <label class="icon-field">Tên công ty</label>
                <input required="" type="text" name="company_name" placeholder="Company Name:">
            </div>
            <div>
                <input type="submit" class="btn1 btn btn-primary" value="Đăng ký">
            </div>
        </form>
    </div>
@endsection
