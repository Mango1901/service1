@extends('layout')
@section('content')
<div class="container">
    <h3 class="jumbotron">Laravel Multiple Images Upload Using Dropzone</h3>
    <form method="post" action="{{url('image/upload/store')}}" enctype="multipart/form-data"
          class="dropzone" id="dropzone">
        @csrf
    </form>
<div>
<style>
    body {font-family: Arial, Helvetica, sans-serif;}

    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {opacity: 0.7;}

    /* The Modal (background) */
    .pdmodal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }
    /* Add Animation */
    .modal-content, #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {-webkit-transform:scale(0)}
        to {-webkit-transform:scale(1)}
    }

    @keyframes zoom {
        from {transform:scale(0)}
        to {transform:scale(1)}
    }

    /* The Close Button */
    .close_image_preview {
        position: absolute;
        top: 70px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }
    .close_image_preview:hover,
    .close_image_preview:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
        .modal-content {
            width: 100%;
        }
    }
</style>
@foreach($store_image as $key => $value)
<div class="ccol-xs-6 col-sm-4">
    <div class="thmb">
        <div class="btn-group fm-group">
            <button type="button" class="btn btn-default dropdown-toggle fm-toggle" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu pull-right fm-menu" role="menu">

                <li><a href="#" onclick="showImage('{{URL::to('CongtyTamViet/uploads/'.$value->store_image_file)}}')"><i class="fa fa-picture-o"></i> View image</a></li>
                <li><a href="{{route('image.download',['store_image_id'=>$value->store_image_id])}}"><i class="fa fa-download"></i> Download</a></li>
                <li><a href="{{route('image.delete_file',['store_image_id'=>$value->store_image_id])}}" ><i class="fa fa-trash-o"></i>Delete</a></li>
            </ul>
        </div><!-- btn-group -->
        <div class="thmb-prev">
            <img src="{{asset('CongtyTamViet/uploads/'.$value->store_image_file)}}" class="img-responsive" alt="" width="200" height="200">
        </div>
        <!-- The Modal -->
        <div id="pdpreviewimgmodel" class="pdmodal">
            <span class="close_image_preview" onclick="closePreviewimage()"><i class="fa fa-times" aria-hidden="true"></i></span>
            <img class="modal-content" id="img01">
        </div>
    </div><!-- thmb -->
</div><!-- col-xs-6 -->
@endforeach
@endsection
