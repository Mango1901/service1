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
            <h3 class="title1">SỬA THÔNG TIN</h3>
        @foreach($user as $key => $value)
            <form action="{{route('add.user.update.password.save',['id'=>$value->id])}}" method="POST">
                @csrf
                <div class="userbox" >
                        <div>
                            <label class="icon-field"><i class="fa fa-user"></i> Email</label>
                            <input required="" type="email" name="email" value="{{$value->email}}" readonly>
                        </div>
                        <div>
                            <label class="icon-field"><i class="fa fa-keyboard-o"></i> Password</label>
                            <input required="" type="password" name="password">
                        </div>

                        <div>
                            <label class="icon-field"><i class="fa fa-pencil"></i> New Password</label>
                            <input required="" type="password" name="new_password">
                        </div>
                        <div>
                            <label class="icon-field"><i class="fa fa-magic"></i> New Password Confirm</label>
                            <input required="" type="password" name="confirm_password" >
                        </div>
                    <div class="flex_c">
                        <input type="submit" value="Sửa mật khẩu" class="btn btn-danger">
                    </div>
                </div>

            </form>
        @endforeach
@endsection
