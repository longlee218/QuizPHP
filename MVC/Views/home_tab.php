<?php include_once './MVC/Views/inc/master.php'?>
<style>
    #list-room{
        margin-top: 20px;
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
                console.log(data)
                if (data['success'] === true){
                    if (data['data'].length === 0){
                        document.getElementById('list-room').innerHTML = '<h4>Không có đề </h4>'
                    }else{
                        $.each(data['data'], function (index, value) {
                            console.log(value)
                            $('#list-room').append(`
                                <div class="col-md-6 mb-5">
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="#"><h4 class="card-title">${value['room_name']}</h4></a>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <small class="col col-md-6">Số đề 0</small>
                                                <small class="col col-md-6">Lượng truy cập 120</small>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">Lần cập nhật cuối ${value['update_at']} </small>
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


