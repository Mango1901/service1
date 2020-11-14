<?php use Illuminate\Support\Facades\Session; ?>
@extends('layout')
@section('content')
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
            echo '<p style="color: green;font-size: 20px;text-align: center;">'.$error.'</p>';
            Session::put('error',NULL);
        }
        ?>
        @foreach($warranty_update as $key => $value)
        <form action="{{route('warranty.save.details.update',['services_id'=>$value->services_id,'id'=>$value->warranty_id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="wr_content">
            <h3 class="title1">CẬP NHẬT BẢO HÀNH</h3>

            <div class="wr_container">
                <div class="wr_name">
                    <label class="wr_lb">Ngày:</label><span class="wr_require">*</span>
                </div>
                <div class="wr_input_date">
                    <input type="date" name="warranty_date" value="{{$value->warranty_date}}" required="">
                </div>
            </div>

            <div class="wr_container">
                <div class="wr_name">
                    <label class="wr_lb">Thời gian:</label><span class="wr_require">*</span>
                </div>
                <div class="wr_time">
                    Từ  <input type="time" name="warranty_hour" value="{{$value->warranty_hour}}" required="">
                    Đến <input type="time" name="warranty_hour2" value="{{$value->warranty_hour2}}" required="">
                </div>
            </div>
            <div class="wr_container">
                <div class="wr_name">
                    <label class="wr_lb">Kỹ sư thực hiện:</label><span class="wr_require">*</span>
                </div>
                <div class="wr_input">
                    <select name="maintenance_engineer" class="form-control input-sm m-bot15">
                            <option value="{{$value->maintenance_engineer_id}}">{{$value->name}}</option>
                            @foreach($user as $key => $value2)
                                <option value="{{$value2->id}}">{{$value2->name}}</option>
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="wr_container">
                <div class="wr_name">
                    <label class="wr_lb">Linh kiện thay thế:</label><span class="wr_require">*</span>
                </div>
                <div class="wr_input">
                    <input type="text" name="replacement_components" value="{{$value->replacement_components}}"/>
                </div>
            </div>
            <div class="wr_container">
                <div class="wr_name">
                    <label class="wr_lb">Kết quả:</label><span class="wr_require">*</span>
                </div>
                <div class="wr_input">
                    <input type="text" name="results" value="{{$value->results}}" required=""/>
                </div>
            </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Tình trạng hỏng hóc:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <input type="text" name="Status_error" value="{{$value->warranty_status_error}}"/>
                    </div>
                </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Công việc đã thực hiện:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <input name="job_details" required="" value="{!! $value->job_details  !!}"/>
                    </div>
                </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Kết quả khảo sát:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <input name="survey_results" value="{!! $value->survey_results  !!}" required=""/>
                    </div>
                </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Nguyên nhân</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <input type="text" name="warranty_cause"  value="{{$value->warranty_cause}}"/>
                    </div>
                </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label class="wr_lb">Cách khắc phục</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <input type="text" name="warranty_solution"  value="{{$value->warranty_solution}}"/>
                    </div>
                </div>

            <div class="wr_input">
                <select name="warranty_status" class="form-control input-sm m-bot15">
                        <option value="{{$value->warranty_status}}">{{$value->status_services_name}}</option>
                    @foreach($warranty_status as $key => $value2)
                        <option value="{{$value2->status_services_id}}">{{$value2->status_services_name}}</option>
                    @endforeach
                </select>
            </div>
             <div class="wr_container">
                <div class="wr_name">
                    <label class="wr_lb">Ghi chú</label><span class="wr_require">*</span>
                </div>
                <div class="wr_input">
                    <input type="text" name="warranty_notes"  value="{{$value->warranty_notes}}"/>
                </div>
            </div>
                <div class="wr_container">
                    <div class="wr_name">
                        <label for="document">Thêm Tài liệu đính kèm</label></label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <div class="needsclick dropzone" id="document-dropzone">

                        </div>
                    </div>
                </div>
            <div class="wr_container wr_action">
                <input class="wr_add" id="btn_upload" type="submit" value="Cập nhật"><input class="wr_cancel" type="button" value="Hủy" onclick="window.history.back()" >
            </div>

        </div>

        </form>

        <script src="{{asset('CongtyTamViet/JS/dropzone.js')}}"></script>
        <script src="{{asset('CongtyTamViet/js/jquery.min.js')}}"></script>
        <script type="text/javascript">
            Dropzone.options.documentDropzone =
                {
                    url: '{{route('image.upload.store',['services_id'=>$value->services_id])}}',
                    paramName: "file",
                    maxFilesize: 5, // MB
                    maxFiles: 5,
                    parallelUploads:5,
                    autoProcessQueue:false,
                    addRemoveLinks: true,
                    renameFile: function(file) {
                        var dt = new Date();
                        var time = dt.getTime();
                        return time+file.name;
                    },
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    timeout: 50000,
                    removedfile: function(file)
                    {
                        var name = file.upload.filename;
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                            type: 'POST',
                            url: '{{ url("image/delete") }}',
                            data: {filename: name},
                            success: function (data){
                                console.log("File has been successfully removed!!");
                            },
                            error: function(e) {
                                console.log(e);
                            }});
                        var fileRef;
                        return (fileRef = file.previewElement) != null ?
                            fileRef.parentNode.removeChild(file.previewElement) : void 0;
                    },
                    init: function (e) {

                        var myDropzone = this;
                        this.on("maxfilesexceeded", function(file){
                            alert("Không thế đăng nhiều hơn 5 file!");
                            this.removeFile(file);
                        });

                        $('#btn_upload').on("click", function () {
                            myDropzone.processQueue(); // Tell Dropzone to process all queued files.
                        });
                        // Event to send your custom data to your server
                        myDropzone.on("sending", function (file, xhr, data) {
                            // First param is the variable name used server side
                            // Second param is the value, you can add what you what
                            // Here I added an input value
                            data.append("your_variable", $('#your_input').val());
                        });
                    },
                    success: function(file, response)
                    {
                        console.log(response);
                    },
                    error: function(file, response)
                    {
                        return false;
                    }
                };
        </script>
            @endforeach
@endsection
