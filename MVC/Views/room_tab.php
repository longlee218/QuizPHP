<?php require_once './MVC/Views/inc/master.php'?>

<style>
    .room-list{
        padding: 10px;
    }
    .room-detail{
        padding-top: 5px;
        margin-bottom: 15px;
        border-bottom-style: groove;
    }
</style>

<div class="room-list pt-4">
    <div class="row" id="search_room">
        <input class="form-control col-md-10" oninput="searchRoom(this.value)" placeholder="Tìm phòng..">
        <button class="btn btn-secondary ml-1 mr-1"><small><i class="fa fa-sort" aria-hidden="true"></i></small></button>
        <div class="btn btn-lg btn-outline-success" data-toggle="modal" data-target="#modalCreateRoom" data-whatever="@mdo">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </div>
    </div>
    <div id="room" class="room-list mt-3">
        <div class="list-room" id="list-room-detail"></div>
    </div>

<!--    Modal create new Room form-->
    <div class="modal fade" id="modalCreateRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content" id="modalCreateRoom">
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
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Nhập lại mật khẩu:</label>
                            <input  class="form-control" id="password-confirm" type="password" placeholder="*********">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-success" id="create_room" data-dismiss="modal">Lưu</button>
                </div>
            </div>
        </div>
    </div>
<!--    Modal edit room form-->
    <div class="modal fade" id="changeStatus" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Phòng</h4>
                </div>
                <div class="modal-body">
                    <label class="radio-inline float-left">
                        <input type="radio" name="status-radio" value="0">Công khai
                    </label>
                    <label class="radio-inline float-right">
                        <input type="radio" name="status-radio" value="1">Riêng tư
                    </label>
                </div>
                <div class="modal-footer ">
                    <button type="button" id="update_btn_room" class="btn btn-outline-info" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Đổi trạng thái</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<script>

    const statusRoom = {
        0: 'Công khai',
        1: 'Riêng tư'
    }

    function searchRoom(value){
        $.ajax({
            method: 'GET',
            url: '/../QuizSys/APIRoom/searchRoom/'+value,
            headers: {
                'Content-type': 'application/json',
                'Authorization': getCookie('Authorization')
            },
            success: (data) => {
                if (data['success'] === true){
                    document.getElementById('list-room-detail').innerHTML = ''
                    if (data['data'].length === 0){
                        document.getElementById('list-room-detail').innerHTML = '<h5>Không tìm thấy kết quả</h5>'
                    }else{
                        $.each(data['data'], (index, value) => {
                            const number_quiz =  count_quiz(value['id'])
                            let btnStatus = `<button class="btn btn-outline-success float-right" id="editRoom"  name="${value['status']}" value="${value['id']}"  onclick="modalStatus(this)" data-target='#changeStatus' data-toggle="modal"><small>${statusRoom[value['status']]}</small></button>`
                            if (value['status'] === "1"){
                                btnStatus = `<button class="btn btn-outline-warning float-right" id="editRoom"  name="${value['status']}" value="${value['id']}"  onclick="modalStatus(this)" data-target='#changeStatus' data-toggle="modal"><small>${statusRoom[value['status']]}</small></button>`
                            }
                            $('#list-room-detail:last-child').append(`
                                 <div class="room-detail" name="${value['id']}">
                                    <div class="row">
                                        <div class="col col-md-10">
                                            <a href="#"><h5>Phòng: ${value['room_name']}</h5></a>
                                        </div>
                                        <div class="col col-md-2">
                                            ${btnStatus}
                                        </div>
                                    </div>
                                   <div class="row mt-2">
                                        <p class="text-secondary col col-md-10"> Số đề hiện tại: ${number_quiz}</p>
                                        <div class="col col-md-2">
                                            <button class="btn btn-outline-danger float-right" id="deleteRoom" value="${value['id']}" onclick="deleteRoom(this.value)"><small><i class="fa fa-trash" aria-hidden="true"></i></smal></button>
                                        </div>
                                    </div>
                                    <p class="text-secondary"> Cập nhật: ${value['update_at']}</p>
                                </div>
                            `)
                        })
                    }
                }
                console.log(data)
            },
            error: (xhr, error) => {
                console.log(xhr, error)
            }
        })
    }

    function count_quiz(id_room){
        let number = 0
        $.ajax({
            method: 'GET',
            url: '/../QuizSys/APIRoom/countQuizInRoom/'+id_room,
            async: false,
            headers: {
                'Content-type': 'application/json',
                'Authorization': getCookie('Authorization')
            },
            success: (data) => {
                console.log(data)
                if (data['success'] === true){
                    number = data['data']
                }
            },
            error: (xhr, error) =>{
                console.log(xhr, error)
            }
        })
        return number
    }

    $('#create_room').click(function() {
        const room_name = document.getElementById('room_name').value
        const password = document.getElementById('password').value
        const password_confirm = document.getElementById('password-confirm').value
        if (password !== password_confirm){
            alert('Mật khẩu không khớp')
        }else{
            const data = {
                room_name: room_name,
                password: password
            }
            $.ajax({
                method: 'POST',
                url: '/../QuizSys/APIRoom/createNewRoom',
                headers: {
                    'Content-type': 'application/json',
                    'Authorization': getCookie('Authorization')
                },
                data: JSON.stringify(data),
                success: (data) => {
                    if (data['success'] === true){
                        alert('Phòng đã được tạo')
                        $('#modalCreateRoom').find('form').trigger('reset')
                        $('#modalCreateRoom').modal('hide')
                        document.getElementById('list-room-detail').innerHTML = ''
                        queryRoom()
                    }else{
                        alert(data['mess'])
                    }
                }
            })
        }
    })
    function queryRoom(){
        $(document).ready(function () {
            $.ajax({
                method: 'GET',
                url: '/../QuizSys/APIRoom/queryRoom',
                headers:{
                    'Content-type': 'application/json',
                    'Authorization': getCookie('Authorization')
                },
                success: (data) =>{
                    if (data['success'] === true){
                        $.each(data['data'], (index, value) =>{
                            const number_quiz =  count_quiz(value['id'])
                            let btnStatus = `<button class="btn btn-outline-success float-right" id="editRoom"  name="${value['status']}" value="${value['id']}"  onclick="modalStatus(this)" data-target='#changeStatus' data-toggle="modal"><small>${statusRoom[value['status']]}</small></button>`
                            if (value['status'] === "1"){
                                btnStatus = `<button class="btn btn-outline-warning float-right" id="editRoom"  name="${value['status']}" value="${value['id']}"  onclick="modalStatus(this)" data-target='#changeStatus' data-toggle="modal"><small>${statusRoom[value['status']]}</small></button>`
                            }
                            $('#list-room-detail:last-child').append(`
                            <div class="room-detail" name="${value['id']}">
                                <div class="row">
                                    <div class="col col-md-10">
                                        <a href="#"><h5>Phòng: ${value['room_name']}</h5></a>
                                    </div>
                                    <div class="col col-md-2">
                                        ${btnStatus}
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col col-md-10">
                                       <p class="text-secondary"> Số đề hiện tại: ${number_quiz}</p>
                                    </div>
                                    <div class="col col-md-2">
                                        <button class="btn btn-outline-danger float-right" id="deleteRoom" value="${value['id']}" onclick="deleteRoom(this.value)"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </div>
                                    </div>

                                <p class="text-secondary"> Cập nhật: ${value['update_at']}</p>
                            </div>
                        `)
                        })
                    }
                },
                error: (xhr, error) =>{
                    alert(xhr+error)
                }
            })
        })
    }
    queryRoom()

    function modalStatus(e) {
        console.log(e)
        const name = $(e).attr('name')
        $('#changeStatus').find('#Heading').html('Phòng '+$(e).attr('value'))
        $('#changeStatus').find('input[type="radio"][name="status-radio"][value="'+name+'"]').prop('checked', true)
        $('#update_btn_room').prop('value', $(e).attr('value'))
    }

    $('#update_btn_room').click(function (e) {
        e.preventDefault()
        const value_status = $('input[type="radio"][name="status-radio"]:checked').val()
        const data = {
            status: value_status
        }
        $.ajax({
            method: 'PUT',
            url: '/../QuizSys/APIRoom/changeStatus/'+$('#update_btn_room').val(),
            headers:{
                'Content-type': 'application/json',
                'Authorization': getCookie('Authorization')
            },
            data: JSON.stringify(data),
            success: (data) => {
                console.log(data)
                if (data['success'] === true){
                    alert('Phòng số '+$('#update_btn_room').val()+' đã chuyển sang trạng thái '+statusRoom[value_status])
                    $('#changeStatus').modal('hide')
                    document.getElementById('list-room-detail').innerHTML = ''
                    queryRoom()
                }
            },
            error: (xhr, error) => {
                console.log(xhr, error)
            }
        })
    })

    function deleteRoom(value) {
        console.log(value)
        // return false
    }

</script>