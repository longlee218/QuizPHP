<?php require_once './MVC/Views/navbar.php'?>
<br>
<div class="container">
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
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="table_room" class="table table-bordred table-stripedr text-center">
                        <thead>
                            <th><input type="checkbox" id="checkall" /></th>
                            <th>ID</th>
                            <th>TRẠNG THÁI</th>
                            <th>TÊN PHÒNG</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td><input type="checkbox" class="checkthis" /></td>
                            <td>Mohsin</td>
                            <td>Irshad</td>
                            <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
                            <td>isometric.mohsin@gmail.com</td>
                            <td>+923335586757</td>
                            <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-sm btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit"><small>Chỉnh sửa</small></button></p></td>
                            <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-sm btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><small>Xóa</small></button></p></td>
                        </tr>
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
                    <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input class="form-control " type="text" placeholder="Mohsin">
                    </div>
                    <div class="form-group">

                        <input class="form-control " type="text" placeholder="Irshad">
                    </div>
                    <div class="form-group">
                        <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>

                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
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
    $.ajax({
        type: "GET",
        url: "/../QuizSys/APIRoom/queryRoom/"+return_first,
        success: function (data){
            console.log(data);
            var myTable1 = document.getElementById("table_room").getElementsByTagName("tbody")[0];
            var newRow = myTable1.insertRow();
            var newCell = newRow.insertCell(0);
            var newCell2 = newRow.insertCell(1)
            // newCell.appendChild(document.createTextNode("LongLeHoang"));
            // newCell2.appendChild(document.createTextNode("Kakak"));
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
    })
</script>