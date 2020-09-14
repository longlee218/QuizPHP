<?php require_once './MVC/Views/navbar.php'?>

<style>
    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
<br>
<div class="container">
    <div id="message-update"></div>
    <div class="row">
       <div class="col col-1">
           <div class="text-dark text-uppercase"><h3>rooms</h3></div>
       </div>
        <div class="col col-10"></div>
        <div class="col col-1">
            <div class="btn btn-lg btn-outline-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"
                 style="border-radius: 12px;">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
        </div>
    </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tạo phòng mới</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Tên phòng:</label>
                                <input type="text" class="form-control" id="room_name">
                                <small class="text-danger" id="message_room"></small>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Mật khẩu:</label>
                                <input  class="form-control" id="password" type="password" placeholder="*********">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary" id="create_room">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="table_room" class="table table-striped table-hover table-bordered text-center">
                        <thead>
                        <tr>
                            <th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
                            </th>
                            <th>ID</th>
                            <th>Trạng thái</th>
                            <th>Tên phòng</th>
                            <th>Chỉnh sửa</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="clearfix"></div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên phòng mới</label>
                        <input class="form-control " type="text" id="room_name_update" name="room_name">
                        <div class="text-danger" id="messages_update"></div>
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input class="form-control " type="password" id="room_password">
                    </div>
                    <div class="form-group">
                        <label>Nhập lại mật khẩu</label>
                        <input class="form-control " type="password" id="room_password_confirm">
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" id="update_btn_room" class="btn btn-outline-info" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Cập nhật phòng</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Xóa phòng</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span>Bạn có chắc muốn xóa phòng này không?</div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Có</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Không</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-sm" id="setTime" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
     <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title custom_align" id="Heading">Thiết lập thời gian Online</h4>
            </div>
            <div class="modal-body">
                <form name="form-set-time">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Bắt đầu</label>
                        <br>
                        <input type="datetime-local" id="time_start">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Kết thúc</label>
                        <br>
                        <input type="datetime-local" id="time_end">
                    </div>
                    <div class="form-group">
                        <div id="messages-time" class="text-danger"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer ">
                <button type="button" id="btn_settime" class="btn btn-outline-info btn-block">Thiết lập</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</div>
<?php require_once './MVC/Views/footer.php' ?>
<script>
    $('.modal-content #time_start').focusout(function (e) {
        // e.preventDefault();
        var time_start =  ($("#time_start").val()).split('T');
        var time_end = ($("#time_end").val()).split('T');
        time_start = time_start[0]+' '+time_start[1];
        time_end = time_end[0]+' '+time_end[1];
        $.ajax({
            type: 'GET',
            url: '/../QuizSys/APIRoom/checkTime/'+time_start+'/'+time_end,
            success: function (data) {
                if (data['success'] === '0'){
                    if (data['messages'] === 'Please fill all these fill'){
                        $('#time_start').focus();
                        $('.modal-content #messages-time').html('<small>*Vui phòng nhập đủ các trường</small>')
                    }else if (data['messages'] === 'Not valid time start. Please try again'){
                        $("#time_start").val('');
                        $('#time_start').focus();
                        $('.modal-content #messages-time').html('<small>*Ngày bắt đầu không thỏa mãn. Vui lòng nhập lại</small>')
                    }else if (data['messages'] === 'Not valid time end. Please try again'){
                        $("#time_end").focusout().val('');
                        $('.modal-content #messages-time').html('<small>*Ngày kết thúc không thỏa mãn. Vui lòng nhập lại</small>')
                }
            }
                },
                error: function (xhr, error){console.log(xhr, error);}
        })
    })
    function post_time_online(id_room){
        $("#btn_settime").click(function () {
            var time_start =  ($("#time_start").val()).split('T');
            var time_end = ($("#time_end").val()).split('T');
            time_start = time_start[0]+' '+time_start[1];
            time_end = time_end[0]+' '+time_end[1];
            $.ajax({
                type: 'POST',
                data: {
                    'time-start': time_start,
                    'time-end': time_end
                },
                url: '/../QuizSys/APIRoom/setTimeOnline/' + id_room,
                success: function (data) {
                    if (data['success'] === true){
                        alert('Phòng '+id_room+' đang thiết lập online');
                        location.reload();
                    }
                    console.log(data);
                },
                error: function (xhr, error) {
                    console.log(xhr, error);
                }
            })
        });
    }
    function post_time_offline(room_id, check_radio){
       var confirm_offline = confirm("Bạn muốn phòng này offline ngay lập tức ?");
       if (confirm_offline === true){
           console.log({
               room_id: room_id
           });
           $(document).ready(function () {
               $.ajax({
                   method: 'POST',
                   url: '/../QuizSys/APIRoom/setRoomOffline',
                   data: {
                       room_id: room_id
                   },
                   success: function (req) {
                       if (req['success'] === true){
                           alert('Phòng '+room_id+' đã offline');
                       }
                       console.log(req);
                       // loadListRoom(return_first);
                   },
                   error: function (xhr, error) {
                       console.log(xhr, error);
                   }
               })
           })
       }else{
           check_radio.checked = true;
       }
    }
    $(document).on("click", ".button_edit", function () {
        var room_id = $(this).data('id');
        $("#edit .modal-content #Heading").html('Phòng số '+room_id);
        var room_name = $("#table_room tbody tr#"+room_id+" td.room_name").text();
        $("input[name='room_name']").val(room_name);
     });
    $("#update_btn_room").click(function () {
        var room_name = $('.modal-body .form-group #room_name_update').val();
        var password = $('.modal-body .form-group #room_password').val();
        var password_confirm = $('.modal-body .form-group #room_password_confirm').val();
        var data_post_json = {room_name: room_name, room_id: room_id, password: password, password_confirm: password_confirm};
        console.log(data_post_json);
        $.ajax({
            type: 'POST',
            url: "/../QuizSys/APIRoom/createRoom",
            data: data_post_json,
            success: function (data) {
                if (data['success'] === 1){
                    alert("Phòng đã được cập nhật.");
                    loadListRoom(return_first);
                }else{
                    $('.modal-body .form-group #room_name_update').val('');
                    $('.modal-body .form-group #room_password').val('');
                    $('.modal-body .form-group #room_password_confirm').val('');
                    $('.modal-dialog #messages_update').html("<small>*Vui lòng thử tên khác</small>")
                }
            },
            error: function (xhr, error) {
                console.log(xhr, error);
            }
        });
    });
    function loadListRoom(return_first) {
            $.ajax({
                type: "GET",
                url: "/../QuizSys/APIRoom/queryRoom/"+return_first,
                headers:{
                    'Content-type': 'application/json',
                    'Authorization': getCookie('Authorization')
                },
                success: function (data){
                    if (data['success'] === true){
                        console.log(data['data']);
                        for (let i=0; i<data['data'].length; i++){
                            var room = data['data'][i];
                            var status = '<label class="switch">\n' +
                                '  <input name="setStatus" type="checkbox">\n' +
                                '  <span class="slider round"></span>\n' +
                                '</label>';
                            if (room['status'] === '1'){
                                status = '<label class="switch">\n' +
                                    '  <input name="setStatus" type="checkbox" checked>\n' +
                                    '  <span class="slider round"></span>\n' +
                                    '</label>';
                            }
                            $("#table_room > tbody:last-child").append("" +
                            "<tr id='"+room['id']+"'>" +
                            "    <td class='align-middle'><input type=\"checkbox\" class=\"checkthis\" /></td>" +
                            "    <td class='id_room align-middle'>"+room['id']+"</td>" +
                            "    <td class='status align-middle'> "+status+"</td>" +
                            "    <td class='room_name align-middle'>"+room['room_name']+"</td>" +
                            "    <td><p data-placement=\"top\" data-toggle=\"tooltip\" title=\"Edit\">" +
                            "        <div class='btn-group ' role='group'>" +
                            "            <button class=\"btn btn-xs button_edit\" name='button_edit' data-title=\"Edit\" data-toggle=\"modal\" data-target=\"#edit\" data-id='"+room['id']+"'><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></button>" +
                            "            <button class=\"btn btn-xs\" name='button_delete' data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#delete\" data-id='"+room['id']+"'><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button>" +
                            "        </div>" +
                            "    </p></td>" +
                            "</tr>");
                        }
                        var data = data['data'];
                        for (let i=0; i < data.length; i++){
                            var check_time = $('input[name="setStatus"]')[i];
                            check_time.addEventListener('change', function () {
                                if ($(this).is(':checked')){
                                    $( "#setTime" ).modal();
                                    console.log(data[i]['id']);
                                    post_time_online(data[i]['id']);
                                }else{
                                    post_time_offline(data[i]['id'],$('input[name="setStatus"]')[i]);
                                }
                                hiddenChecked($('input[name="setStatus"]')[i]);

                            });
                        }
                    }
                },
                error: function (xhr, error) {
                    console.log(xhr, error);
                }
            });
    }
    function loadListRoomInterval(return_first) {
        setInterval(function () {
            $('#table_room >tbody').empty().html('');
            $.ajax({
                type: "GET",
                url: "/../QuizSys/APIRoom/queryRoom/"+return_first,
                headers:{
                    'Content-type': 'application/json',
                    'Authorization': getCookie('Authorization')
                },
                success: function (data){
                    if (data['success'] === true){
                        console.log(data['data']);
                        for (let i=0; i<data['data'].length; i++){
                            var room = data['data'][i];
                            var status = '<label class="switch">\n' +
                                '  <input name="setStatus" type="checkbox">\n' +
                                '  <span class="slider round"></span>\n' +
                                '</label>';
                            if (room['status'] === '1'){
                                status = '<label class="switch">\n' +
                                    '  <input name="setStatus" type="checkbox" checked>\n' +
                                    '  <span class="slider round"></span>\n' +
                                    '</label>';
                            }
                            $("#table_room > tbody:last-child").append("" +
                            "<tr id='"+room['id']+"'>" +
                            "    <td class='align-middle'><input type=\"checkbox\" class=\"checkthis\" /></td>" +
                            "    <td class='id_room align-middle'>"+room['id']+"</td>" +
                            "    <td class='status align-middle'> "+status+"</td>" +
                            "    <td class='room_name align-middle'>"+room['room_name']+"</td>" +
                            "    <td><p data-placement=\"top\" data-toggle=\"tooltip\" title=\"Edit\">" +
                            "        <div class='btn-group ' role='group'>" +
                            "            <button class=\"btn btn-xs button_edit\" name='button_edit' data-title=\"Edit\" data-toggle=\"modal\" data-target=\"#edit\" data-id='"+room['id']+"'><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></button>" +
                            "            <button class=\"btn btn-xs\" name='button_delete' data-title=\"Delete\" data-toggle=\"modal\" data-target=\"#delete\" data-id='"+room['id']+"'><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button>" +
                            "        </div>" +
                            "    </p></td>" +
                            "</tr>");
                        }
                        var data = data['data'];
                        for (let i=0; i < data.length; i++){
                            var check_time = $('input[name="setStatus"]')[i];
                            check_time.addEventListener('change', function () {
                                if ($(this).is(':checked')){
                                    $( "#setTime" ).modal();
                                    console.log(data[i]['id']);
                                    post_time_online(data[i]['id']);
                                }else{
                                    post_time_offline(data[i]['id'],$('input[name="setStatus"]')[i]);
                                }
                                hiddenChecked($('input[name="setStatus"]')[i]);

                            });
                        }
                    }
                },
                error: function (xhr, error) {
                    console.log(xhr, error);
                }
            });
        }, 60000);
    }
    function hiddenChecked(check_radio){
        $('#setTime').on('hidden.bs.modal', function () {
            $(this).find("input, small").val('').end();
            check_radio.checked = false;
        })
    }
    loadListRoom(return_first);
    loadListRoomInterval(return_first);
    $(document).ready(function () {
        $("#create_room").click(function () {
            var room_name = $("#room_name").val();
            var password = $("#password").val();
            var data_post_json = { room_name: room_name, password: password, id: return_first};
            $.ajax({
                type: 'POST',
                url: "/../QuizSys/APIRoom/createRoom",
                data: data_post_json,
                success: function (data) {
                    console.log(data);
                    var success = data['success'];
                    if (success === 0){
                        $('#room_name').val('');
                        $('room_name').focus();
                        $("#message_room").html("*Tên này đã được chọn, vui lòng thử tên khác");
                    }else if (success === 1){
                       var confirm_submit = confirm("Phòng đã được tạo, vui lòng click OK để tải lại trang");
                       if (confirm_submit === true){
                           window.location.reload();
                       }
                    }
                },
                error: function (xhr, error) {
                    console.log(xhr, error);
                }
            });
        });
    });
</script>
