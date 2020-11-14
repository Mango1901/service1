 <?php
        use Illuminate\Support\Facades\Session;
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
 <link rel="stylesheet" href="{{asset('CongtyTamViet/css/style.css')}}">
 <link href="{{asset('CongtyTamViet/css/font-awesome.min.css')}}" rel="stylesheet">
 <link href="{{asset('CongtyTamViet/css/font-awesome.min.css')}}" rel="stylesheet">
 <link href="{{asset('CongtyTamViet/css/font-awesome.min.css')}}" rel="stylesheet">
 <link href="{{asset('CongtyTamViet/css/bootstrap.min.css')}}" rel="stylesheet">
 <div class="bgr_nen">
    <div class="userbox">
        <form action="{{route('save.register')}}" method="POST">
            @csrf
            <div>
                <label class="icon-field"><i class="fa fa-user"></i> Tên người dùng</label>
                <input required="" type="text" name="name" placeholder="Name">
            </div>
            <div>
                <label class="icon-field"><i class="fa fa-keyboard-o"></i> Email</label>
                <input required="" type="email" name="email" placeholder="Email">
            </div>
            <div>
                <label class="icon-field"><i class="fa fa-key"></i> Password</label>
                <input required="" type="password" name="password" placeholder="Password">
            </div>
            <div>
                <label class="icon-field"><i class="fa fa-pencil"></i> Confirm Password</label>
                <input required="" type="password" name="confirm_password" placeholder="Password">
            </div>
            <div class="flex_c">
                <input type="submit" class="btn btn-primary" value="Đăng ký" class="btn btn1">
            </div>
        </form>
    </div>
 </div>