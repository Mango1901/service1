<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
	{{-- <link rel="stylesheet" title="style" href="source/assets/dest/css/style.css"> --}}
    <title>Xuất file PDF Service </title>
</head>

<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    tr td{
        margin: 10px 0;
        padding: 10px 0;
    }
    body,h1,h3,h4,span {
    font-family: DejaVu Sans;
    }
    /*.page-break {
        page-break-after: always;
    }*/
   
</style>
<body>
     <div class="container">
       <div class="row">
           <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Số Serial</th>
                    <th>Model</th>
                    <th>Trạng thái</th>
                    <th>Ngày lắp đặt</th>
                    <th>Ngày hết hạn</th>
                    <th>Tên khách hàng</th>
                    <th>Kĩ sư lắp đặt</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($service as $service)
                  <tr>
                    <td>{{$service->product_serial}}</td>
                    <td>{{$service->Product->product_model}}</td>
                    <td>{{$service->StatusService->Status_name}}</td>
                    <td>{{Carbon\Carbon::parse($service->start_date )->format('d-m-Y')}}</td>
                    <td>{{Carbon\Carbon::parse($service->end_date )->format('d-m-Y')}}</td>
                    <td>{{$service->Customer->customer_name}}</td>
                    <td>{{$service->User->name}}</td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
       </div>
   </div>       
</body>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
{{-- <script src="source/assets/dest/js/dataTables.bootstrap.min.js"></script> --}}
</html>