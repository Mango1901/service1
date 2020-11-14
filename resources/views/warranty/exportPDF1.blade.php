<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" title="style" href="source/assets/dest/css/style.css">
    <title>Xuất file PDF bản 2 </title>
</head>
<style>
    .page-break {
        page-break-after: always;
    }
     table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    .color-span{
        color:#337ab7;
    }
    .color-span-bold{
        color:#283d92;
    }
    .name-h3{
        font-weight: bold;
    }
    tr p, td p{
        padding:0px 0 0 10px;
    }
    tr td,p,.status{
        /*margin: 10px 0;*/
        /*padding: 10px 0;*/

    }

    p,span{
        font-weight: bold;
        font-size: 12px;
    }
    .border-bottom{
        border-bottom: 1px solid ;

    }.border-bottom-doted{
        border-style: none none dashed none;
        height: 20px;
        margin: 30 0 20px 0;
        padding-bottom: 10px;
    }

    h1,h3,h4{
        font-weight: bold;
    }
   @font-face {
      font-family: 'Open Sans';
      font-style: normal;
      font-weight: normal;
      src: url(http://themes.googleusercontent.com/static/fonts/opensans/v8/cJZKeOuBrn4kERxqtaUH3aCWcynf_cDxXwCLxiixG1c.ttf) format('truetype');
    }
    @font-face {
      font-family: 'glyphicons-halflings-regular';
      font-style: normal;
      font-weight: normal;
      src: url(fonts/glyphicons-halflings-regular.ttf) format('truetype');
    }
    body,h1,h3,h4,span {
    font-family: DejaVu Sans;
    }

</style>
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$date = date("Ymd");
$hour = date("His");
?>
<body>
    @foreach($customer as $customer1)
    @foreach($warrantyDetails as $warrantyDetails1)
    @foreach($service as $services1 )
    <div class="container">
        <div class="row">
            <div>
                <img src="{{url('CongtyTamViet/imgs/banner.png')}}" width="100%" alt="">
            </div>
             <h1 class="name-h1" style="text-align:center;margin:0">BIÊN BẢN KỸ THUẬT</h1>
            <h3 class="name-h3" style="color:rgb(237,125,49);text-align:center;margin:0">Customer Service Report</h3>
            <p style="text-align:center">Số/<span style="color: #77abd6;;margin:0">No::{{$date}}-{{$hour}}</span></p>
            <div class="border-bottom">
                <p style="display:inline">Tên khách hàng/<span class="color-span">Customer Name:</span> </p>
                <span name="name" style="font-weight: normal;">{{$customer1->customer_name}}</span>
            </div>
            <div class="border-bottom">
                <p style="display:inline" >Địa chỉ/<span class="color-span">Address:</span> </p>
                <span name="address" style="font-weight: normal;">{{$customer1->customer_address }}</span>
            </div>
            <div class="border-bottom">
                <div class="row ">
                    <div class="col-md-6 col-xs-6 ">
                        <p style="display:inline">Người liên hệ/<span class="color-span">Contact Name:</span> </p>
                        <span name="contact" style="font-weight: normal;">{{$customer1->customer_contact  }}</span>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <p style="display:inline">Điện Thoại/<span class="color-span">Tel:</span> </p>
                        <span name="phone" style="font-weight: normal;">{{$customer1->customer_phone  }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        <h4 class="border-bottom">THÔNG TIN THIẾT BỊ <span style="color:rgb(237,125,49);font-size: 19px;">/ EQUIPMENT INFOMATION</span></h4>
        </div>
        @foreach($product as $key => $product1)
        <div class="row">
            <div class="border-bottom">

                <p style="display:inline" >Loại thiết bị/<span class="color-span" > Equipment type :</span> </p>
                <span name="" style="font-weight: normal;">{{$product1->Category->category_name}}</span>
            </div>
            <div class="border-bottom">
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <p style="display:inline" >Ngày hỏng/ <span class="color-span">Date:</span> </p>
                        <span name="date_ex" style="font-weight: normal;">{{$warrantyDetails1->warranty_date}}</span>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <p style="display:inline"><span class="color-span">Model:</span></p>
                        <span name="model" style="font-weight: normal;">{{$product1->product_model}}</span>
                    </div>
                </div>
            </div>
            <div class=" border-bottom">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <p style="display:inline"><span class="color-span">Serial No:</span> </p>
                        <span name="date_ex" style="font-weight: normal;">{{$product1->product_serial}}</span>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
        <div class="row">
            <h4>Chi tiết <span style="color:rgb(237,125,49);font-size: 19px;">/ Service Details</span></h4>
             <div class="row">
                <div class="col-md-3 col-xs-3">
                    <p style="display:inline">Kiểu dịch vụ / <p style="color: blue;">Service type </p> </p>
                </div>
                <div class="col-md-3 col-xs-3">
                    @if($services1->Status == 1)
                    <input type="checkbox" name="warranty" value="" checked="">
                    @else
                    <input type="checkbox" name="warranty" value="">
                    @endif
                    <p style="display:inline">Bảo hành / <p style="color: blue;">Warranty</p> </p>
                </div>
                <div class="col-md-3 col-xs-3">
                    @if($services1->Status == 2)
                    <input type="checkbox" name="" value="" checked="">
                    @else
                    <input type="checkbox" name="" value="">
                    @endif
                    <p style="display:inline">Bảo trì / <p style="color: blue;">Maintanance </p> </p>
                </div>
                <div class="col-md-3 col-xs-3">
                    @if($services1->Status == 3 || $services1->Status == 4)
                        <input type="checkbox" name="" value="" checked="">
                    @else
                        <input type="checkbox" name="" value="">
                    @endif
                    <p style="display:inline">Tính phí / <p style="color: blue;">Chargeable </p> </p>
                </div>
            </div>
            <table style="width:100%">
                <tr>
                  <td style="width: 30%;"><p style="display:inline">Tình trạng/<span class="color-span">Status/Error</span> </p></td>
                  <td> <p style="font-weight: normal;">{{$warrantyDetails1->warranty_status_error}}</p> </td>
                </tr>
                <tr>
                    <td style="width: 30%;"><p style="display:inline;line-height: 70px">Công việc đã thực hiện </p></td>
                    <td><p style="font-weight: normal;">{!!$warrantyDetails1->job_details  !!}</p></td>
                </tr>
                <tr>
                    <td style="width: 30%;"><p style="display:inline;line-height: 150px">Kết quả kiểm tra</p></td>
                    <td><p style="font-weight: normal;">{!! $warrantyDetails1->survey_results !!}</p></td>
                </tr>
                <tr>
                    <td style="width: 30%;"><p style="display:inline;line-height: 70px">Nguyên nhân/<span class="color-span">Origin of trouble</span> </p></td>
                    <td><p style="font-weight: normal;">{{$warrantyDetails1->warranty_cause}}</p></td>
                </tr>
                <tr>
                    <td style="width: 30%;"><p style="display:inline;line-height: 80px">Cách khắc phục/<span class="color-span">Solution</span> </p></td>
                    <td><p style="font-weight: normal;">{{$warrantyDetails1->warranty_solution}}</p></td>
                </tr>
                <tr>
                    <td style="width: 30%;"><p style="display:inline">Linh Kiện đã thay thế</p></td>
                    <td><p style="font-weight: normal;">{{$warrantyDetails1->replacement_components}}</p></td>
                </tr>
              </table>
              <!-- <br> -->
        </div>
          <div class="border-bottom page-break" style="display: flex;">
            <div class=" ">
                <p style="">Tình trạng sau khi sửa chữa /<br> <span class="color-span">Status after service:</span> </p>
            </div>
            <div class="row" style="float: right;">
                <div class="col-md-6 col-xs col-sm-6 status" >
                    @if($warrantyDetails1->warranty_status ==1)
                    <input type="checkbox" name="" value="" checked="">
                    @else
                    <input type="checkbox" name="" value="" >
                    @endif
                    <p style="display:inline;">Hoàn thành/ <span class="color-span-bold">Complete</span> </p>
                </div>
                <div class="col-md-6 col-xs col-sm-6 status">
                    @if($warrantyDetails1->warranty_status ==2)
                        <input type="checkbox" name="" value="" checked="">
                    @else
                        <input type="checkbox" name="" value="" >
                    @endif
                    <p style="display:inline ">Chưa hoàn thành / <span class="color-span-bold">Incomplete</span> </p>
                </div>
                <div class="col-md-6 col-xs col-sm-6 status">
                    @if($warrantyDetails1->warranty_status ==3)
                        <input type="checkbox" name="" value="" checked="">
                    @else
                        <input type="checkbox" name="" value="" >
                    @endif
                    <p style="display:inline ">Chờ thay thế linh kiện / <span class="color-span-bold">Pending for spares</span> </p>
                </div>
                <div class="col-md-6 col-xs col-sm-6 status">
                    @if($warrantyDetails1->warranty_status ==4)
                        <input type="checkbox" name="" value="" checked="">
                    @else
                        <input type="checkbox" name="" value="">
                    @endif
                    <p style="display:inline ">Theo dõi thêm / <span class="color-span-bold">Under observation</span> </p>
                </div>
            </div>
        </div>
        {{-- <div class="border-bottom page-break">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <p style="">Tình trạng sau khi sửa chữa / <span class="color-span">Status after service:</span> </p>
                </div>
                <div class="col-md-8 col-sm-8">
                  <div class="row">

                    <div class="col-md-6 col-xs col-sm-6 status" >
                        @if($warrantyDetails1->warranty_status ==1)
                        <input type="checkbox" name="" value="" checked="">
                        @else
                        <input type="checkbox" name="" value="" >
                        @endif
                        <p style="display:inline;">Hoàn thành/ <span class="color-span-bold">Complete</span> </p>
                    </div>
                    <div class="col-md-6 col-xs col-sm-6 status">
                        @if($warrantyDetails1->warranty_status ==2)
                            <input type="checkbox" name="" value="" checked="">
                        @else
                            <input type="checkbox" name="" value="" >
                        @endif
                        <p style="display:inline ">Chưa hoàn thành / <span class="color-span-bold">Incomplete</span> </p>
                    </div>
                    <div class="col-md-6 col-xs col-sm-6 status">
                        @if($warrantyDetails1->warranty_status ==3)
                            <input type="checkbox" name="" value="" checked="">
                        @else
                            <input type="checkbox" name="" value="" >
                        @endif
                        <p style="display:inline ">Chờ thay thế linh kiện / <span class="color-span-bold">Pending for spares</span> </p>
                    </div>
                    <div class="col-md-6 col-xs col-sm-6 status">
                        @if($warrantyDetails1->warranty_status ==4)
                            <input type="checkbox" name="" value="" checked="">
                        @else
                            <input type="checkbox" name="" value="">
                        @endif
                        <p style="display:inline ">Theo dõi thêm / <span class="color-span-bold">Under observation</span> </p>
                    </div>
                  </div>
                </div>
            </div>
        </div> --}}
        <div class="border-bottom-doted">
            <p style="display:inline;padding-bottom: 10px">Ghi chú / <span class="color-span">Remark: </span> </p>
            <div class="div-empty border-bottom" >
                <p style="font-weight: normal;">{{$warrantyDetails1->warranty_notes}}</p>
                </div>
            </div>
        <br>
        <div style="">
            {{-- <div class="col-sm-1"></div> --}}
            <span class="event-span" style=" font-size: 11px;text-align: center;">EVENTS|<p style=" display: inline;font-size: 11px">Thời gian bắt đầu/<span class="color-span" style="font-size: 11px"> Start of service: {{Carbon\Carbon::parse($warrantyDetails1->start_date)->format('d/m/Y')}}  </span> | Thời gian kết thúc/<span class="color-span" style="font-size: 11px"> End of service: {{Carbon\Carbon::parse($warrantyDetails1->end_date)->format('d/m/Y')}} </span></p></span>
            {{-- </div> --}}
        </div>
       {{--  <div class="row" style="display: flex;">
            <div class="col-md-1"></div>
            <div class="col-xs-2" style=" line-height: 30px;height: 50px"><span class="color-span">EVENTS |  </span>
            </div>
            <div style="" class="col-xs">
                <p style="">Thời gian bắt đầu/<span class="color-span"> Start of service: {{$warrantyDetails1->warranty_hour}} ,{{Carbon\Carbon::parse($warrantyDetails1->start_date)->format('d/m/Y')}}  </span> </p>
                <p style=""> Thời gian kết thúc/<span class="color-span"> End of service: {{$warrantyDetails1->warranty_hour2}}, {{Carbon\Carbon::parse($warrantyDetails1->end_date)->format('d/m/Y')}} </span> </p>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-3  col-xs-6" style="text-align:center"><h4 >KỸ SƯ THỰC HIỆN</h4><h5 class="color-span-bold">SERVICE ENGINEER</h5></div>
            <div class="col-md-1"></div>
            <div class="col-md-2"></div>
            <div class="col-md-2 col-xs-6" style="text-align:center"><h4>KHÁCH HÀNG</h4><h5 class="color-span-bold">CUSTOMER</h5></div>
            <div class="col-md-"></div>
        </div>
    </div>
    @if(!$loop->last)
        <div class="page-break"></div>
    @endif
    @endforeach
    @endforeach
    @endforeach

</body>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="source/assets/dest/js/dataTables.bootstrap.min.js"></script>
</html>
