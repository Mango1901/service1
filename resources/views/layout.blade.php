<?php use Illuminate\Support\Facades\Session;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cong Ty Tam Viet</title>
    <meta name="_token" content="{{csrf_token()}}"/>
    <link href="{{asset('CongtyTamViet/css/dropzone.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('CongtyTamViet/css/style.css')}}">
    <link href="{{asset('CongtyTamViet/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('CongtyTamViet/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('CongtyTamViet/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <script src="{{asset('CongtyTamViet/ckeditor/ckeditor.js')}}"></script>
</head>
<body>
<div class="wrapper">
    <div class="logo">
        <a href="{{route('/')}}"><img  src="{{URL::to('CongtyTamViet/imgs/logo.jpg')}}" width="150px" height="100px"></a>
        <a href="{{route('/')}}"><h1 class="title">Công Ty TNHH Đầu Tư Thương Mại Dịch Vụ Kỹ Thuật Tâm Việt</h1></a>
    </div>
    <div class="menu">
        <ul>
            <li><a href="{{route('/')}}">QUẢN LÝ DỊCH VỤ</a></li>
            <li><a href="{{route('category')}}">LOẠI SẢN PHẨM</a></li>
            <li><a href="{{route('product')}}">SẢN PHẨM</a></li>
            <li><a href="{{route('customer')}}">KHÁCH HÀNG</a></li>
            <li><a href="{{route('add.user.update.password',['id'=>Session::get('id')])}}">ĐỔI MẬT KHẨU</a></li>
            @can('is-admin')
            <li><a href="{{route('user')}}">QUẢN LÝ NGƯỜI DÙNG</a></li>
            @endcan
            @can('is-root')
                <li><a href="{{route('company.admin')}}">QUẢN LÝ ADMIN</a></li>
            @endcan
            <li><a href="{{route('logout')}}">THOÁT</a></li>
        </ul>
    </div>
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{route('/')}}">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        @for($i = 0; $i <= count(Request::segments()); $i++)
            <li>
                <a href="">{{Request::segment($i)}}</a>
                @if($i < count(Request::segments()) & $i > 0)
                    {!!'<i class="fa fa-angle-right"></i>'!!}
                @endif
            </li>
        @endfor
    </ul>
    <div class="bgr_nen">
        @yield('content')
    </div>
</div>
</body>
<br>
<div class="clear">
</div>
<footer>
    <div class=" footer">
        <p>
            <a target="_black" href="http://congtyphuongdong.vn" style="color:white">Phát triền bởi công ty cổ phần công nghệ và giải pháp Phương Đông</a>
        </p>
    </div>
</footer>
<script scr="{{asset('CongtyTamViet/js/popper.min.js')}}"></script>
<script src="{{asset('CongtyTamViet/js/jquery.min.js')}}"></script>
<link href="{{asset('CongtyTamViet/css/select2.min.css')}}" rel="stylesheet" />
<script src="{{asset('CongtyTamViet/js/select2.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('CongtyTamViet/lightWeightPopup.js-master/lightweightpopup.css')}}" type="text/css">
<script src="{{asset('CongtyTamViet/lightWeightPopup.js-master/lightWeightPopup.js')}}"></script>
<link href="{{asset('CongtyTamViet/css/bootstrap.min.css')}}" rel="stylesheet">
<script src="{{asset('CongtyTamViet/js/bootstrap.min.js')}}"></script>
</html>
<script>
    $(function () {
        $('#Product').select2();
        $('#Name').select2();
        $('#Engineer').select2();
        $('.choose').change(function () {
            var action = $(this).attr('id');
            var customer_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';

            if(action == 'Name'){
                result = 'Address';
            }
            $.ajax({
                url: '{{route("print.customer.address")}}',
                method:'POST',
                data:{action:action,customer_id:customer_id,_token:_token},
                success:function (data) {
                    $('#'+result).html(data);
                }

            });
        })
    })
    $(function () {
        $('.choose_product').change(function () {
            var action = $(this).attr('id');
            var product_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            if(action == 'Product'){
                result = 'Serial';
            }
            $.ajax({
                url: '{{route("print.product.serial")}}',
                method:'POST',
                data:{action:action,product_id:product_id,_token:_token},
                success:function (data) {
                    $('#'+result).html(data);
                }

            });
        })
    })
</script>
<script>
    // Get the modal
    var modal = document.getElementById("pdpreviewimgmodel");
    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");

    function showImage(url) {
        modal.style.display = "block";
        modalImg.src = url;
        captionText.innerHTML = this.alt;
    }
    function closePreviewimage() {
        modal.style.display = "none";
    }
</script>
<script>
    $(document).ready(function() {
        $(".register").lightWeightPopup({width:"90%", height:"80%"});
        $(".category").lightWeightPopup({width:"60%", height:"35%"});
        $(".product").lightWeightPopup({width:"90%", height:"75%"});
        $(".customer").lightWeightPopup({width:"90%", height:"65%",  backgroundColor:"green"});
    });
</script>




