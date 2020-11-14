@extends('layout')
@section('content')

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
<div class="wrapper">
    <h2 style="text-align: center" class="title1">Thông tin khách hàng</h2>
    <table class="tb2 table-bordered text-center">
        @foreach($service as $key => $value)
            @can('view',$value)
        <tr>
            <td class="bold">KHÁCH HÀNG</td>
            <td colspan="5" class="bold">{{$value->customer_name}}</td>
        </tr>
        <tr>
            <td class="bold">ĐỊA CHỈ</td>
            <td colspan="5">{{$value->customer_address}}</td>
        </tr>
        <tr>
            <td class="bold">MODEL</td>
            <td>{{$value->product_model}}</td>
            <td class="bold">Số Serial</td>
            <td colspan="3">{{$value->product_serial}}</td>
        </tr>
        <tr>
            <td class="bold">NGÀY LẮP ĐẶT</td>
            <td>{{$value->start_date}}</td>
            <td class="bold">NGÀY HẾT HẠN BH</td>
            <td>{{$value->end_date}}</td>
            <td class="bold">TÌNH TRẠNG</td>
            <td style="background-color:lightcoral">
            <?php
                if($value->Status == 0){
                    echo 'Trong bảo hành';
                }else if ($value->Status == 1){
                    echo 'Trong bảo trì';
                }else if ($value->Status == 2){
                    echo 'Hết hạn bảo hành bảo trì';
                } else {
                    echo 'Máy sửa chữa bên ngoài';
                }
                ?></td>
        </tr>
        <tr>
            <td class="bold">KĨ SƯ LẮP ĐẶT</td>
            <td>{{$value->name}}</td>
        </tr>
            @endcan
        @endforeach
    </table>
    <!--lich su bao hanh bao duong-->
    <h2 style="text-align: center" class="title1">Lịch Sử Bảo Hành</h2>
    <div style="background-color: aliceblue;" class="tb1">
    <div class="baohanh">
        {{-- <div class="bold">LỊCH SỬ BẢO HÀNH - BẢO DƯỠNG </div> --}}
        @foreach($warranty_details as $key => $value2)
            @can('view',$value2)
        <table cellpadding="10" border="1" cellspacing="0" class="tb3 table-bordered text-center" style="margin-bottom: 20px">
            <tr class="bold">
                <td>Ngày</td>
                <td>Giờ</td>
                <td>Kĩ sư thực hiện</td>
                <td>Linh kiện thay thế</td>
                <td>Kết quả</td>
            </tr>
            <tr>
                <td>{{$value2->warranty_date}}</td>
                <td>Từ {{$value2->warranty_hour}} đến {{$value2->warranty_hour2}}</td>
                <td>{{$value2->name}}</td>
                <td>{!!$value2->replacement_components  !!}</td>
                <td>{{$value2->results}}</td>
            </tr>
            <tr class="bold">
                <td class="bold">Diễn giải</td>
                <td colspan="2" class="bold">Công việc đã thực hiện</td>
                <td colspan="2" class="bold">Kết quả khảo sát</td>
            </tr>
            <tr>
                <td colspan="3">
                    {{$value2->job_details }}
                </td>
                <td colspan="2">
                    {{ $value2->survey_results }}
                </td>
            </tr>
            <tr>
                    <td colspan="5" style="text-align: center">
                        @can('update',$value2)
                        <a href="{{route('add.warranty.details.update',['services_id'=>$value2->services_id,'id'=>$value2->warranty_id])}}" title="Sửa thông tin">
                        <i class="btn btn1 btn-primary">Sửa thông tin</i>
                        </a>
                        @endcan
                        <a href="{{route('export.warranty',['services_id'=>$value2->services_id,'id'=>$value2->warranty_id])}}" class="btn-primary btn1 btn in">Xuất file PDF bản 1</a><a href="{{route('export.warranty.version2',['services_id'=>$value2->services_id,'id'=>$value2->warranty_id])}}" class="btn-primary btn1 btn in">Xuất file PDF bản 2</a></td>
            </tr>
        </table>
            @endcan
        @endforeach
        <div>
            @foreach($store_image as $key => $value4)
                @can('view',$value4)
                <div class="ccol-xs-6 col-sm-4">
                    <div class="thmb">
                        <div class="btn-group fm-group">
                            <button class="btn btn-default dropdown-toggle fm-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                            </button>
                            @php
                                $check_file = $value4->store_image_file;
                                $ext = pathinfo($check_file, PATHINFO_EXTENSION);
                            @endphp
                            <ul class="dropdown-menu pull-left fm-menu" role="menu">
                                @if($ext == 'xlsx' || $ext == 'doc' || $ext == 'docx' || $ext == 'odt')
                                    <li><a href="#" onclick="showImage('{{URL::to('CongtyTamViet/imgs/download123456789.png')}}')"><i class="fa fa-picture-o"></i> View image</a></li>
                                @elseif($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'gif')
                                    <li><a href="#" onclick="showImage('{{URL::to('CongtyTamViet/uploads/'.$value4->store_image_file)}}')"><i class="fa fa-picture-o"></i> View image</a></li>
                                @else
                                    <li><a href="#"></a></li>
                                @endif

                                <li><a href="{{route('image.download',['store_image_id'=>$value4->store_image_id])}}"><i class="fa fa-download"></i> Download</a></li>
                                @can('delete',$value4)
                                <li><a href="{{route('image.delete_file',['store_image_id'=>$value4->store_image_id])}}" onclick="return confirm('Are you want to delete?')" ><i class="fa fa-trash-o"></i>Delete</a></li>
                                @endcan
                            </ul>
                        </div><!-- btn-group -->
                        @if($ext == 'xlsx' || $ext == 'doc' || $ext == 'docx' || $ext == 'odt')
                            <div class="thmb-prev">
                                <img src="{{URL::to('CongtyTamViet/imgs/download123456789.png')}}" class="img-responsive" alt="" width="200" height="200">
                            </div>
                        @elseif($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'gif')
                            <div class="thmb-prev">
                                <img src="{{URL::to('CongtyTamViet/uploads/'.$value4->store_image_file)}}" class="img-responsive" alt="" width="200" height="200">
                            </div>
                        @else
                            <div class="thmb-prev"> </div>
                        @endif
                        <!-- The Modal -->
                        <div id="pdpreviewimgmodel" class="pdmodal">
                            <span class="close_image_preview" onclick="closePreviewimage()"><i class="fa fa-times" aria-hidden="true"></i></span>
                            <img class="modal-content" id="img01">
                        </div>
                    </div><!-- thmb -->
                </div><!-- col-xs-6 -->
                @endcan
            @endforeach
        </div>
            <hr class="btn-primary">
        @foreach($service as $key => $value3)
            @can('view',$value3)
        <div>
            <button class="btn btn1 btn-primary"><a style="color: white" href="{{route('add.warranty.details',['services_id'=>$value3->services_id])}}">+ Thêm mới</a></button>
        </div>
            @endcan
        @endforeach
    </div>
    </div>
</div>

@endsection

