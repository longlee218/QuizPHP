<?php include_once './MVC/Views/inc/master.php'?>
<style>
    #list-room{
        margin-top: 20px;
    }
    .status-dot{
        height: 10px;
        width: 10px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 2px;
    }
    .private{
        background-color: #dbde04;
    }
    .public{
        background-color: #046580;
    }
    .card-home{
        border-radius: 10px;
    }
</style>
<div class="search-room mt-5 mb-1">
    <small class="text-secondary">Các phòng chỉnh sửa gần đây</small>
</div>
<div class="row" name="list-room" id="list-room"></div>
<small class="text-secondary">Bộ đề chỉnh sửa gần đây</small>
<div class="row" name="list-quiz" id="list-quiz"></div>

<script>


    $(document).ready(function (){
        $.ajax({
            method: 'GET',
            url: '/../QuizSys/APIRoom/queryClosestRoom/',
            headers:{
                'Content-type': 'application/json',
                'Authorization': getCookie('Authorization')
            },
            success: (data) =>{
                if (data['success'] === true){
                    if (data['data'].length === '0'){
                        document.getElementById('list-room').innerHTML = '<h4>Không có đề </h4>'
                    }else{
                        $.each(data['data'], function (index, value) {
                            let statusClass = `<span class="status-dot public mt-3"></span><span class="small status-name">${statusName[0]}</span>`
                            let description = `<small class="text-secondary">${value['description']}</small>`
                            if (value['status'] === '1'){
                                statusClass = ` <span class="status-dot private mt-3"></span><span class="small status-name">${statusName[1]}</span>`
                            }
                            if (value['description'] === null){
                                description = ``
                            }
                            $('#list-room').append(`
                                <div class="col-md-6 mb-3">
                                    <div class="card card-home">
                                        <div class="card-body">
                                            <a href="/../QuizSys/RoomAction/roomDetail/${value['room_name']}">
                                                <h5 class="card-title">${value['room_name']}</h5></a>
                                                ${description}
                                                <br>
                                                ${statusClass}
                                        </div>
                                    </div>
                                </div>
                            `)
                        })
                    }
                }
            },
            error: (xhr, error) => {
                console.log(xhr, error)
            }
        })
    })

</script>


