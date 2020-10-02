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
        <button class="btn btn-success"><small><i class="fa fa-plus" aria-hidden="true"></i></small></button>
    </div>
    <div id="room" class="room-list mt-3">
        <div class="list-room" id="list-room-detail"></div>
    </div>
</div>
<script>
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
                        $('#list-room-detail:last-child').append(`
                            <div class="room-detail" name="${value['id']}">
                                <div class="row">
                                    <div class="col col-md-10">
                                        <a href="#"><h5>${value['room_name']}</h5></a>
                                    </div>
                                    <div class="col col-md-2">
                                        <button class="btn btn-outline-success float-right"><small>Chỉnh sửa</smal></button>
                                    </div>
                                </div>
                                <p class="text-secondary"> Số đề hiện tại: ${number_quiz}</p>
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


</script>