<?php use Illuminate\Support\Facades\Session; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('CongtyTamViet/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('CongtyTamViet/css/font-awesome.min.css')}}">
</head>
<body>
<div class="container-fluid">
    <div class="bgr_login">
        <div class="title">CÔNG TY TNHH TAM VIỆT</div>
    </div>
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
    <div class="userbox" style="border-top: 8px solid red;">
        <div class="header-account">
            <i class="fa fa-key"></i>
            <h2>ĐĂNG NHẬP</h2>
        </div>
        <form action="{{route('login.save')}}" method="POST">
            @csrf
            <div>
                <label class="icon-field"><i class="fa fa-user"></i> Email</label>
                <input required="" type="email" name="email" placeholder="Email">
            </div>
            <div>
                <label class="icon-field"><i class="fa fa-pencil"></i> Password</label>
                <input required="" type="password" name="password" placeholder="Password">
            </div>
            <div class="flex_c">
                <input type="submit" value="Đăng nhập" class="btn btn1">
            </div>
        </form>
    </div>
</div>
</body>
</html>
