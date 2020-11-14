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
<div style="background-color: aliceblue;">
    <div class="wr_content">
    <div class="center">
    <form action="{{route('product.save')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="wr_container">
            <div class="wr_name">
                <label class="wr_lb">Product Name:</label><span class="wr_require">*</span>
            </div>
            <div class="wr_input">
                <input type="text" name="product_name" required="">
            </div>
        </div>
        <div class="wr_container">
            <div class="wr_name">
                <label class="wr_lb">Category Name:</label><span class="wr_require">*</span>
            </div>
            <div class="wr_input">
                <select name="category_name" class="form-control input-sm m-bot15">
                    @foreach($category as $key=>$value)
                        <option value="{{$value->category_id}}">{{$value->category_name}}</option>
                    @endforeach
                </select>
                <a href="javascript:" data-href="{{route('add.category')}}" class="category" data-content="iframe">Thêm mới</a>
            </div>
        </div>
        <div class="wr_container">
            <div class="wr_name">
                <label class="wr_lb">Product Serial:</label><span class="wr_require">*</span>
            </div>
            <div class="wr_input">
                <input type="text" name="product_serial" required="">
            </div>
        </div>
        <div class="wr_container">
            <div class="wr_name">
                <label class="wr_lb">Product Model:</label><span class="wr_require">*</span>
            </div>
            <div class="wr_input">
                <input type="text" name="product_model" required="">
            </div>
        </div>
        <div class="wr_container">
            <div class="wr_name">
                <label class="wr_lb">Product Notes:</label><span class="wr_require">*</span>
            </div>
            <div class="wr_input">
                <input type="text" name="product_notes" required="">
            </div>
        </div>
        <div class="wr_container">
            <div class="wr_name">
                <label class="wr_lb">Product Image:</label><span class="wr_require">*</span>
            </div>
            <div class="wr_input">
                <input type="file" name="product_image" required="" accept="image/x-png,image/gif,image/jpeg,image/jpg" >
            </div>
        </div>
        <div class="wr_container wr_action">

            <input class="wr_add" type="submit" value="Thêm mới"><input class="wr_cancel" type="button" value="Hủy" onclick="window.history.back()" >
        </div>
    </form>
    </div>
    </div>
</div>
<script src="{{asset('CongtyTamViet/JS/jquery.js')}}"></script>
<link rel="stylesheet" href="{{asset('CongtyTamViet/lightWeightPopup.js-master/lightweightpopup.css')}}" type="text/css">
<script src="{{asset('CongtyTamViet/lightWeightPopup.js-master/lightWeightPopup.js')}}"></script>
<script>
    $(document).ready(function() {
        $(".category").lightWeightPopup({width:"70%", height:"70%", title:"Thêm Mới Loại Sản Phẩm"});
    });
</script>
