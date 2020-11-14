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
        ?>
        <?php
        $error = Session::get('error');
        if($error){
            echo '<p style="color: red;font-size: 20px;text-align: center;">'.$error.'</p>';
            Session::put('error',NULL);
        }
        ?>
        <div class="wr_content">
            <form action="{{route('category.save')}}" method="post">
            @csrf
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Tên loại sản phẩm:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <input type="text" name="category_name" required="">
                    </div>
                </div>
                <div class="wr_container wr_action">
                    <input type="submit" class="wr_add" value="Thêm mới">
                </div>
        </form>
        </div>

