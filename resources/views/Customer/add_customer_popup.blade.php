<?php use Illuminate\Support\Facades\Session; ?>
<link rel="stylesheet" href="{{asset('CongtyTamViet/css/style.css')}}">
<link href="{{asset('CongtyTamViet/css/font-awesome.min.css')}}" rel="stylesheet">
<link href="{{asset('CongtyTamViet/css/font-awesome.min.css')}}" rel="stylesheet">
<link href="{{asset('CongtyTamViet/css/font-awesome.min.css')}}" rel="stylesheet">
<link href="{{asset('CongtyTamViet/css/bootstrap.min.css')}}" rel="stylesheet">
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
<style>
    iframe{
        height: 435px;
    }
</style>
    <div style="background-color: aliceblue;" class="boday">
        <form action="{{route('add.customer.save')}}" method="post">
            @csrf
            <div class="wr_content">
                <div class="center">
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Khách hàng:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <input type="text" name="customer_name" required="">
                    </div>
                </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Address:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <input type="text" name="customer_address" required="">
                    </div>
                </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Email:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <input type="email" name="customer_email" required="">
                    </div>
                </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Phone:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <input type="number" name="customer_phone" required="">
                    </div>
                </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Contact:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <input type="text" name="customer_contact" required="">
                    </div>
                </div>
                <div class="wr_container wr_action">
                    <input class="wr_add" type="submit" value="Thêm mới">
                    <input class="wr_cancel" type="button" value="Hủy" onclick="window.history.back()"  >
                </div>
                </div>
            </div>
        </form>
    </div>
