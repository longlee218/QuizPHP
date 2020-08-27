<?php require_once './MVC/Views/navbar.php'?>
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
                <div class="text-uppercase"><small>Tạo phòng</small></div>
            </div>
        </div>
    </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên phòng mới</label>
                        <input class="form-control " type="text" id="room_name_update">
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
                    <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>

                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<script>
    $(document).one("click", ".button_edit", function () {
        var room_id = $(this).data('id');
        $(".modal-content #Heading").html('Chỉnh sửa phòng số '+room_id);
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
                        $('.modal-dialog').modal('hide');
                        // $('#messages_update').html('<p class="alert alert-success" role="alert">Cập nhật thành công</p>');
                    }else{
                        $('.modal-dialog #messages_update').html("<smal>*Vui lòng thử tên khác</smal>")
                    }
                },
                error: function (xhr, error) {
                    console.log(xhr, error);
                }
            });
        })
    });
    $.ajax({
        type: "GET",
        url: "/../QuizSys/APIRoom/queryRoom/"+return_first,
        success: function (data){
            console.log(data);
            console.log(data[0]['room_name']);
            for (let i=0; i<data.length; i++){
                var room = data[i];
                var status = 'Không hoạt động';
                if (i['status'] === '1'){
                    status = 'Đang hoạt động';
                }
                console.log(room['status']);
               $("#table_room > tbody:last-child").append("" +
                   "<tr>" +
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
                   "</tr>")
            }
        },
        error: function (xhr, error) {
            console.log(xhr, error);
        }
    });
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
            })
        })
    });
       $(document).ready(function () {
           $(".button_edit").click(function () {
               console.log($(this).val());
           })
       })
</script>