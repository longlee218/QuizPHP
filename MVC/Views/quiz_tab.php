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
<!--            <div class="input-group">-->
<!--                <div class="input-group-append">-->
<!--                    <button class="btn btn-outline-secondary" type="button">Phân loại</button>-->
<!--                </div>-->
<!--                <input type="text"  oninput="searchQuiz(this.value)" placeholder="......" class="form-control search-input">-->
<!--            </div>-->
                            <input type="text"  oninput="searchQuiz(this.value)" placeholder="......" class="form-control search-input">

        </div>
        <div class="col col-md-3">
            <input class="form-control"  placeholder="ngày/tháng/năm" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date">
        </div>
        <div class="col col-md-2">
            <button class="btn btn-success float-right" name="newQuiz" onclick="location.href = '/../QuizSys/QuizPage'"><i class="fa fa-star-o" aria-hidden="true"></i>
                Thêm đề</button>
        </div>
    </div>
    <div class="quiz-content">
        <div class="card card-list-quiz">
            <div class="card-header dashboard-quiz">
               <p class="text-secondary">Kho đề của bạn</p>
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
                                        <input class="form-control" type="datetime-local" id="timeStart" required>
                                    </div>
                                    <div class="col col-6">
                                        <label class="text-secondary">Thời gian làm bài</label>
                                        <input class="form-control" type="text" id="timeDo" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col col-6">
                                        <label>Mật khẩu <small>(có thể bỏ qua)</small></label>
                                        <input class="form-control" type="password" id="password">
                                    </div>
                                    <div class="col col-6">
                                        <label>Nhập lại mật khẩu</label>
                                        <input class="form-control" type="password" id="password-confirm" onkeyup="checkPasswordMatch()">
                                        <div id="messPass" class="mt-2"></div>
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
                                                    <p class="dropdown-item"  id="download" onclick="downloadQuiz(this)" name="${value['id']}" title="${value['title']}"  >Tải xuống</p>

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

        // $(document).ready(function () {
        //     $('#password, #password-confirm').keyup(checkPasswordMatch)
        // })


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
                                                    <p class="dropdown-item"  id="download" onclick="downloadQuiz(this)" name="${value['id']}" title="${value['title']}"  >Tải xuống</p>
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
            $('#submit-btn').attr('name', $(e).attr('name'))
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

    function checkPasswordMatch(){
        if ($('#password').val() !== $('#password-confirm').val()){
            $('#messPass').html('<small class="text-danger">*Mật khẩu không đồng nhất</small>')
        }else{
            $('#messPass').html('<small class="text-success"> *Hợp lệ </small>')
        }
    }


    $('#submit-btn').click(() => {
        let list_room_select = []
        const table_room = $('#table-room-exam')
        const list_tr = $(table_room).find('tr')
        for (let i = 1; i < list_tr.length; i++){
            const first_th = $(list_tr[i]).find('th')[0]
            const checkbox = $(first_th).find('input[name="room_name"]')
            if ($(checkbox).is(':checked')){
                list_room_select.push($(checkbox).attr('value'))
            }
        }
        let time_start = $('#timeStart').val()
        const time_do = $('#timeDo').val()
        const password = $('#password').val()
        if (!time_do || !time_start){
            alert('Vui lòng điền đủ các trường')
        }else{
            time_start = time_start.split('T')
            time_start = time_start[0] + ' ' + time_start[1]
            const data = {
                id_thread: $('#submit-btn').attr('name'),
                time_start: time_start,
                time_do: time_do,
                password: password,
                list_room_select: list_room_select
            }
            $.ajax({
                method: 'POST',
                url: '/../QuizSys/APIThread/makeExamQuiz/',
                headers:{
                    'Content-type': 'application/json',
                    'Authorization': getCookie('Authorization')
                },
                data: JSON.stringify(data),
                success: (data) =>{
                    if(data['success'] === true){
                        alert('Đề đang được tiến hành kiểm tra')
                        window.location.reload()
                    }
                },
                error: (xhr, error) =>{
                    console.log(xhr, error)
                }
            })
        }
        return false
    })

        function downloadQuiz(e) {
            const id = $(e).attr('name')
            $.ajax({
                method: 'POST',
                url: '/../QuizSys/APIThread/exportToExcel/'+id,
                headers:{
                    'Content-type': 'application/json',
                    'Authorization': getCookie('Authorization')
                },
                success: (data) =>{
                    const json = JSON.parse(data)
                    if (json['success'] === true){
                        const a = document.createElement('a');
                        a.href = json['url'] ;
                        a.download = json['data'];
                        a.click();
                        a.remove();
                    }
                }
            })
        }

     function searchRoomExam(value) {
         let label, th, textValue, value_upper = value.toUpperCase()
         const table = $('#table-room-exam')
         const tr = $(table).find('tr')
         for (let i = 1; i < tr.length; i++ ){
             th = $(tr[i]).find('th')[0]
             label = $(th).find('label')
             textValue = $(label).text() || $(label).textContent
             if (textValue.toUpperCase().indexOf(value_upper) > -1){
                 tr[i].style.display = ''
             }else{
                 tr[i].style.display = 'none'
             }
         }
     }
</script>