@extends('layout')
@section('content')

    <?php use Illuminate\Support\Facades\Session;
    ?>
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
    @foreach($service as $key => $value)
    <form action="{{route('warranty.save.details',['services_id'=>$value->services_id])}}" method="post" enctype="multipart/form-data">
        @csrf
         <div class="wr_content">
            <h3 class="title1">THÊM MỚI BẢO HÀNH</h3>
            <div class="wr_container">
                <div class="wr_time">
                    <label class="wr_lb">Từ giờ:</label><span class="wr_require">*</span>
                    <input type="time" name="warranty_hour" required="">
                    Đến giờ <input type="time" name="warranty_hour2" required="">
                </div>
            </div>
            <div class="wr_container">
                <div class="wr_name">
                    <label class="wr_lb">Kỹ sư thực hiện:</label><span class="wr_require">*</span>
                </div>
                <div class="wr_input">
                    <select name="maintenance_engineer" class="form-control input-sm m-bot15">
                        @foreach($user as $key => $value2)
                            <option value="{{$value2->id}}">{{$value2->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
             <div class="wr_container">
                 <div class="wr_name">
                     <label class="wr_lb">Tình trạng hỏng hóc:</label><span class="wr_require">*</span>
                 </div>
                 <div class="wr_input">
                     <input type="text" name="Status_error"/>
                 </div>
             </div>
               <div class="wr_container">
                    <div class="wr_name wr_result">
                        <label class="wr_lb">Kết quả khảo sát:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <textarea name="survey_results" class="form-control" required id="" cols="30" rows="10"></textarea>
                    </div>
                 </div>
             <div class="wr_container">
                    <div class="wr_name wr_work" >
                        <label class="wr_lb">Công việc đã thực hiện:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                        <textarea name="job_details" class="form-control" required id="" cols="30" rows="10"></textarea>
                    </div>
            </div>
             <div class="wr_container">
                <div class="wr_name wr_result">
                    <label class="wr_lb">Kết quả khảo sát:</label><span class="wr_require">*</span>
                </div>
                <div class="wr_input">
                    <textarea name="survey_results" class="form-control" required id="" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="wr_container">
                 <div class="wr_name">
                     <label class="wr_lb">Nguyên nhân</label><span class="wr_require">*</span>
                 </div>
                 <div class="wr_input">
                     <input type="text" name="warranty_cause"/>
                 </div>
             </div>
             <div class="wr_container">
                 <div class="wr_name">
                     <label class="wr_lb">Cách khắc phục</label><span class="wr_require">*</span>
                 </div>
                 <div class="wr_input">
                     <input type="text" name="warranty_solution"/>
                 </div>
             </div>
            <div class="wr_container">
                <div class="wr_name">
                    <label class="wr_lb">Linh kiện thay thế:</label><span class="wr_require">*</span>
                </div>
                <div class="wr_input">
                    <input type="text" name="replacement_components"/>
                </div>
            </div>
             <div class="wr_container">
                <div class="wr_name">
                    <label class="wr_lb">Kết quả:</label><span class="wr_require">*</span>
                </div>
                <div class="wr_input">
                    <input type="text" name="results" required=""/>
                </div>
            </div>
             <div class="wr_container">
                    <div class="wr_name wr_status">
                        <label class="wr_lb">Tình trạng:</label><span class="wr_require">*</span>
                    </div>
                    <div class="wr_input">
                     <select name="warranty_status" class="form-control input-sm m-bot15">
                         @foreach($warranty_status as $key => $value2)
                             <option value="{{$value2->status_services_id}}">{{$value2->status_services_name}}</option>
                         @endforeach
                     </select>
                 </div>
             </div>
             <div class="wr_container">
                 <div class="wr_name ">
                     <label class="wr_lb">Ghi chú</label><span class="wr_require">*</span>
                 </div>
                 <div class="wr_input">
                     <textarea name="warranty_notes" class="form-control" required id="" cols="30" rows="10"></textarea>
                 </div>
             </div>
             <div class="wr_container">
                 <div class="wr_name">
                     <label for="document">Tài liệu đính kèm</label></label><span class="wr_require">*</span>
                 </div>
                 <div class="wr_input">
                     <div class="needsclick dropzone" id="document-dropzone">

                     </div>
                 </div>
             </div>
             <div class="wr_container wr_action">
                <input class="wr_add" id="btn_upload" type="submit" value="Thêm mới"><input class="wr_cancel" type="button" value="Hủy" onclick="window.history.back()" >
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
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.xlsx,.doc,.docx,.odt",
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
                    this.on("error", function (file, message) {
                        console.log(file.type);
                        alert(message);
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

