<?php require_once './MVC/Views/inc/master.php' ?>
<style>
    .search-input{
        font-size: 14px;
        padding-top: 5px;
        width: 100%;
    }
    .quiz-tab{
        padding-top: 20px;
    }
    .card-list-quiz{
        margin-top: 20px;
    }
    .dashboard-quiz{
        padding: 10px 5px 10px 15px;
        display: table;
    }
    .dashboard-quiz > a {
        padding: 0 10px;
        vertical-align: middle;
    }
    .more-quiz{
        border: none;
        background-color: white;
        padding: 10px;
        outline: none;
        font-weight: bold;
    }
    .more-quiz:focus{
        border: none;
        font-weight: bold;
        outline: none;
    }
    .li-quiz{
        padding-top: 10px;
    }
    .content-quiz-share{
        width: 100%;
        height: 100px;
        padding: 10px;
        border-radius: 10px;
        border-style: solid;
        border-width: thin;
        border-color: #f4f4f4;
        margin-bottom: 20px;
    }
    .second-setting{
        display: none;
    }
    #titleSetting1{
        display: none;
    }
    #submit-btn{
        display: none;
    }

    .list-room-search{
        width: 100%;
        padding: 10px;
        border-radius: 10px;
        border-style: solid;
        border-width: thin;
        border-color: #f4f4f4;
        margin: 20px 0;
        max-height: calc(70vh - 210px);
        overflow-y: auto;
    }
    .search-room-input{
        width: 50%;
        font-size: 14px;
    }
</style>

<div class="quiz-tab">
    <div class="row">
        <div class="col col-md-7 search-quiz">
            <div class="input-group">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button">Phân loại</button>
                </div>
                <input type="text"  oninput="searchQuiz(this.value)" placeholder="......" class="form-control search-input">
            </div>
        </div>
        <div class="col col-md-3">
            <input class="form-control" type="date">
        </div>
        <div class="col col-md-2">
            <button class="btn btn-success float-right" name="newQuiz" onclick="location.href = '/../QuizSys/QuizPage'"><i class="fa fa-star-o" aria-hidden="true"></i>
                Thêm đề</button>
        </div>
    </div>
    <div class="quiz-content">
        <div class="card card-list-quiz">
            <div class="card-header dashboard-quiz">
                <a href="#" class="text-dark font-weight-bold" id="count-quiz-training">Ôn tập</a>
                <a href="#" class="text-dark font-weight-bold" id="count-quiz-exam">Kiểm tra</a>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush" id="list"></ul>
            </div>
        </div>
    </div>

<!--    Modal share-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Chia sẻ bộ đề</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="content-quiz">
                        <div id="quiz-share" class="content-quiz-share">
                        </div>
                    </div>
                    <input class="form-control" placeholder="Tìm kiếm giáo viên khác....">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Chia sẻ</button>
                </div>
            </div>
        </div>
    </div>

<!--    Modal exam-->
    <div class="modal fade" id="modalExam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="examHeaderModal">Kiểm tra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="content-exam">
                        <p class="text-secondary font-weight-bold" id="titleSetting1">
                            <span class="fa-stack">
                                <span class="fa fa-circle-o fa-stack-2x"></span>
                                <strong class="fa-stack-1x">1</strong>
                            </span>
                            Lựa chọn phòng</p>
                        <div class="first-setting setting" id="first-setting">
                            <p class="font-weight-bold text-primary">
                                <span class="fa-stack text-primary">
                                    <span class="fa fa-circle-o fa-stack-2x"></span>
                                    <strong class="fa-stack-1x">1</strong>
                                </span>
                                Lựa chọn phòng</p>
                            <input  class="form-control search-room-input" placeholder="Nhập tên phòng" onkeyup="searchRoomExam(this.value)">
                            <div id="list-room" class="list-room-search">
                                <table class="table table-hover" id="table-room-exam">
                                    <tbody><tr></tr></tbody>
                                </table>
                            </div>
                        </div>
                        <p class="text-secondary font-weight-bold" id="titleSetting2">
                                <span class="fa-stack">
                                    <span class="fa fa-circle-o fa-stack-2x"></span>
                                    <strong class="fa-stack-1x">2</strong>
                                </span>
                            Cài đặt</p>
                        <div class="second-setting setting" id="second-setting">
                            <p class="font-weight-bold text-primary">
                                <span class="fa-stack text-primary">
                                    <span class="fa fa-circle-o fa-stack-2x"></span>
                                    <strong class="fa-stack-1x">2</strong>
                                </span>Cài đặt</p>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col col-6">
                                        <label class="text-secondary">Thời gian bắt đầu</label>
                                        <input class="form-control" type="datetime-local" id="timeStart">
                                    </div>
                                    <div class="col col-6">
                                        <label class="text-secondary">Thời gian làm bài</label>
                                        <input class="form-control" type="time" id="timeDo" min="00:01" max="12:00">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col col-6">
                                        <label>Mật khẩu <small>(có thể bỏ qua)</small></label>
                                        <input class="form-control">
                                    </div>
                                    <div class="col col-6">
                                        <label>Nhập lại mật khẩu</label>
                                        <input class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-warning" id="pervious-btn">Về trước</button>
                    <button type="button" class="btn btn-warning" id="next-btn">Tiếp</button>
                    <button type="button" class="btn btn-success" id="submit-btn">Kiểm tra</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
        $(document).ready(() => {
            $.ajax({
                method: 'GET',
                url: '/../QuizSys/APIThread/queryQuiz',
                headers: {
                    'Content-type': 'application/json',
                    'Authorization': getCookie('Authorization')
                },
                success: (data) => {
                    if (data['success'] === true){
                        if (data['data'].length === 0){
                            document.getElementById('list-quiz').innerHTML = '<h5>Kho đề của bạn trống</h5>'
                        }else{
                            $.each(data['data'],  (index, value) => {
                                $('#list:last-child').append(`
                                  <li class="list-group-item li-quiz" name="${value['id']}">
                                    <div class="row mt-3">
                                        <div class="col col-md-4">
                                          <h5> <a href="/../QuizSys/QuizPage/detail/${value['id']}" class="text-secondary font-weight-bold ">${value['title']}</a></h5>
                                        </div>
                                        <div class="col col-md-3"></div>
                                        <div class="col col-md-4"><small class="text-secondary">Môn học: ${value['subject']}</small></div>
                                        <div class="col col-md-1 mt-2">
                                            <div class="dropdown">
                                                <button class="btn more-quiz" type="button" id="dropDownSetting" data-toggle="dropdown" aria-expanded="false">...</button>
                                                <div class="dropdown-menu" aria-labelledby="dropDownSetting">
                                                    <p class="dropdown-item" onclick="modalExam(this)" id="exam" name="${value['id']}" title="${value['title']}">Kiểm tra</p>
                                                    <p class="dropdown-item" onclick="modalShare(this)" id="share" name="${value['id']}" title="${value['title']}"  >Chia sẻ</p>
                                                    <a class="dropdown-item" href="#">Cài đặt</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <i class="fa fa-clock-o mr-2" aria-hidden="true"></i><small class="text-secondary">Lần sửa gần nhất ${value['update_at']}</small>
                                    <br>
                                    </li>
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



    function searchQuiz(value) {
        $.ajax({
            method: 'GET',
            url: '/../QuizSys/APIThread/searchQuizTitleUser/'+value,
            headers: {
                'Content-type': 'application/json',
                'Authorization': getCookie('Authorization')
            },
            success: (data) => {
                if (data['success'] === true){
                    document.getElementById('list').innerHTML = ''
                    if (data['data'].length === 0){
                        document.getElementById('list').innerHTML = '<h5>Không tìm thấy kết quả</h5>'
                    }else{
                        $.each(data['data'], (index, value) => {
                            $('#list:last-child').append(`
                                  <li class="list-group-item li-quiz" name="${value['id']}">
                                    <div class="row mt-3">
                                        <div class="col col-md-4">
                                          <h5> <a href="#" class="text-secondary font-weight-bold ">${value['title']}</a></h5>
                                        </div>
                                        <div class="col col-md-3"></div>
                                        <div class="col col-md-4"><small class="text-secondary">Môn học: ${value['subject']}</small></div>
                                       <div class="col col-md-1 mt-2">
                                            <div class="dropdown">
                                                <button class="btn more-quiz" type="button" id="dropDownSetting" data-toggle="dropdown" aria-expanded="false">...</button>
                                                <div class="dropdown-menu" aria-labelledby="dropDownSetting">
                                                    <p class="dropdown-item" onclick="modalExam(this)" id="exam" name="${value['id']}" title="${value['title']}">Kiểm tra</p>
                                                    <p class="dropdown-item" onclick="modalShare(this)" id="share" name="${value['id']}" title="${value['title']}"  >Chia sẻ</p>
                                                    <a class="dropdown-item" href="#">Cài đặt</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <i class="fa fa-clock-o mr-2" aria-hidden="true"></i><small class="text-secondary">Lần sửa gần nhất ${value['update_at']}</small>
                                    <br>
                                    </li>
                            `)
                        })
                    }
                }
            }
        })
    }

    function modalShare(e) {
        $('#myModal').modal('show')
        $('#quiz-share').html(`
            <i class="fa fa-folder-open-o fa-3x" aria-hidden="true"></i>
            <p>${e.title}</p>

        `)
    }

        queryListRoomExam()

        function modalExam(e) {
            $('#modalExam').modal('show')
            $('#modalExam').attr('name', e.title)
            $('#examHeaderModal').html('Kiểm tra: '+e.title)
            $('#next-btn').click( function () {
                document.getElementById('titleSetting1').style.display = 'block'
                document.getElementById('titleSetting2').style.display = 'none'
                document.getElementById('first-setting').style.display = 'none'
                document.getElementById('second-setting').style.display = 'block'
                document.getElementById('next-btn').style.display = 'none'
                document.getElementById('submit-btn').style.display = 'block'
            })
            $('#pervious-btn').click(() =>{
                document.getElementById('titleSetting1').style.display = 'none'
                document.getElementById('titleSetting2').style.display = 'block'
                document.getElementById('first-setting').style.display = 'block'
                document.getElementById('second-setting').style.display = 'none'
                document.getElementById('next-btn').style.display = 'block'
                document.getElementById('submit-btn').style.display = 'none'
            })
    }

    function queryListRoomExam(){
        $(document).ready(() => {
            $.ajax({
                method: 'GET',
                headers:{
                    'Authorization': getCookie('Authorization'),
                    'Content-type': 'application/json'
                },
                url: '/../QuizSys/APIRoom/queryRoom/queryRoom',
                success: (data) =>{
                    if(data['success'] === true){
                        $(data['data']).each((index, value) => {
                            let description =  ``
                            if (value['description'] !== null){
                                description = `<small class="font-weight-normal text-secondary">${value['description']}</small>`
                            }
                            $('#table-room-exam tr:last').after(`
                            <tr>
                                <th name="${value['id']}">
                                    <div class="form-check">
                                        <input class="form-check-input" onclick="checkInRoom(this)"  type="checkbox"  name="room_name" id="checkboxRoom-${value['id']}" value="${value['id']}">
                                        <label class="form-check-label" for="checkboxRoom-${value['id']}">${value['room_name']}</label>
                                    </div>
                                </th>
                                <th>
                                    ${description}
                                </th>
                            </tr>
                            `)
                        })
                    }
                }
            })
        })
    }
    function checkInRoom(e) {
        if ($(e).is(':checked')){
            //luu ID cua phong dang click
            const parent = $(e).parents()[1]
            //Luu ten cua bo de dang xet
            const current_modal = $(e).parents()[11]
            const label =  $("#modalExam label[for='" + $(e).attr('id') + "']")
            $.ajax({
                method: 'GET',
                headers:{
                    'Content-type': 'application/json',
                    'Authorization': getCookie('Authorization')
                },
                url: '/../QuizSys/APIRoom/checkQuizInRoom/'+$(parent).attr("name")+'/'+$(current_modal).attr("name"),
                success: (data) =>{
                    // console.log(typeof (data['status']))
                    if (data['success'] === false && data['status'] === 400){
                        alert('Bộ đề '+$(current_modal).attr('name')+' đã nằm trong phòng '+$(label).text())
                        $(e).prop('checked', false)
                    }else{
                        console.log('success')
                    }
                }
            })
        }
    }

    function quizToExam() {
        return 0
    }
</script>