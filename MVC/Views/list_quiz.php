<?php include_once './MVC/Views/navbar.php'?>
<style>
    .table-pane{
        background: red;
        margin: 0;
    }
    .dashboard-quiz{
        padding-bottom: 20px;
    }
    .info-quiz{
        position: relative;
        height: 450px;
        border-style: solid;
        border-width: thin;
        border-color: gray;
        background-color: #f2f2f2;
        border-radius: 15px;
    }
    .btn-setting{
        border: none;
        border-radius: 50%;
        background-color: white;
        color: black;
        font-weight: bold;
        font-size: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        outline:none
    }
    .btn-setting:focus{
        border: none;
        outline: none;
    }
    .list-quiz-import{
        width: 100%;
        padding: 10px;
        border-radius: 10px;
        border-style: solid;
        border-width: thin;
        border-color: #f4f4f4;
        margin: 20px 0;
        max-height: calc(80vh - 210px);
        overflow-y: auto;
    }
    .status-dot{
        height: 10px;
        width: 10px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 2px;
    }
    .exam{
        background-color: red;
    }
    .practice{
        background-color: green;
    }
</style>
<div class="container-fluid">
<div class="row">
    <div class="col col-md-9 dashboard-quiz">
        <div class="mt-4">
            <form class="form-quiz">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col col-md-6">
                            <div class="input-group mb-3">
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropDownCategorize" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Phân loại</button>
                                    <div class="dropdown-menu" aria-labelledby="dropDownCategorize">
                                        <a class="dropdown-item" href="#">Ôn tập</a>
                                        <a class="dropdown-item" href="#">Kiểm tra</a>
                                    </div>
                                </div>
                                <input type="text" class="form-control" placeholder="Nhập tên đề" onkeyup="search(this.value)">
                            </div>
                        </div>
                        <div class="col col-md-1">
                            <input type="date" class="form-control" id="dateForm">
                        </div>
                        <div class="col-1 d-flex justify-content-center align-items-center">
                            <span class="fa fa-arrow-right mb-4" aria-hidden="true"></span>
                        </div>
                        <div class="col col-md-1">
                            <input type="date" class="form-control" id="dateTo">
                        </div>
                        <div class="col col-md-2">
                            <div class="btn-group ml-4" role="group" aria-label="Basic example">
                                <a class="btn btn-success text-white" onclick="location.href = '/../QuizSys/QuizPage'">
                                    <i class="fa fa-star-o" aria-hidden="true"></i> Đề mới
                                </a>
                                <a class="btn btn-info text-white" onclick="importQuiz()">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    Nhập đề
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header">
                <a href="#" onclick="displayType('exam')" class="text-dark mr-3">
                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                    <span id="countExam" class="ml-2" name="exam"></span> Kiểm tra</a>
                <a href="#" onclick="displayType('practice')" class="text-dark">
                    <i class="fa fa-check" aria-hidden="true"></i>
                    <span id="countPractice" class="ml-2" name="practice"></span> Ôn tập</a>
            </div>
            <div class="card-body mt-0" id="list-quiz">
                <table class="table" id="table-list-quiz">
                    <thead></thead>
                    <tbody>
                        <tr></tr>
                    </tbody>
                </table>
            </div>
        </div>


<!--        Modal import-->
        <div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Nhập đề </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input class="form-control" placeholder="Tìm kiếm kiếm đề...." onkeyup="searchImportQuiz(this.value)">
                        <div class="list-quiz-import" id="quiz-import">
                            <table class="table table-hover" id="table-quiz-import">
                                <tbody><tr></tr></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submitImport">Nhập</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--    <div class="search-quizz">-->
    <!--        <div class="search-div">-->
    <!--            <i id="search-icon" class="fa fa-search" aria-hidden="true"></i>-->
    <!--            <input type="text" onkeyup="myFunction()" id="search_input" placeholder="Tìm kiếm...">-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <br>-->
    <!--        <div class="row">-->
    <!--        <div class="col col-md-2">-->
    <!--            <div class="nav flex-column nav-pills" id="list_room_tab" role="tablist" aria-orientation="vertical"></div>-->
    <!--        </div>-->
    <!--        <div class="col col-md-10">-->
    <!--            <div class="col-10">-->
    <!--               <div class="nab-content tab-content" ></div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->

    <div class="col col-md-3 mt-3 info-quiz">
        <h1>this is list content</h1>
    </div>
</div>


</div>

<!--OLD SCRIPT-->
<!--<script>-->
<!--    $(document).ready(function () {-->
<!--        $.ajax({-->
<!--            type: 'GET',-->
<!--            url: "/../QuizSys/APIRoom/queryRoom/"+return_first,-->
<!--            headers: {-->
<!--                'Content-type': 'application/json',-->
<!--                'Authorization': getCookie('Authorization'),-->
<!--            },-->
<!--            success: function (data) {-->
<!--                var list_room_tab = $("#list_room_tab");-->
<!--                $.each(data['data'], function (i, room) {-->
<!--                    var element = ``;-->
<!--                    if (i === 0){-->
<!--                        element = $(`-->
<!--                    <a class="nav-link active room_nav" id="${room['id']}" onclick="getQuizListActive(${room['id']})" data-toggle="pill" href="#room-${room['id']}" role="tab" aria-controls="v-pills-home" aria-selected="true">${room['room_name']}</a>-->
<!--           `);-->
<!--                        list_room_tab.append(element);-->
<!--                        element.trigger('click');-->
<!--                    }-->
<!---->
<!--                    else{-->
<!--                        element = $(`-->
<!--                    <a class="nav-link  room_nav" id="${room['id']}" onclick="getQuizList(${room['id']})"  data-toggle="pill" href="#room-${room['id']}" role="tab" aria-controls="v-pills-home" aria-selected="true">${room['room_name']}</a>-->
<!--           `);-->
<!--                        $(".table-list-quiz > tbody:last-child").empty().html('');-->
<!--                        list_room_tab.append(element);-->
<!--                    }-->
<!--                })-->
<!--            }-->
<!--        })-->
<!--    })-->
<!---->
<!--    function getQuizListActive(click_id) {-->
<!--        $(".table-list-quiz > tbody:last-child").empty().html('');-->
<!--        $.ajax({-->
<!--            method: 'GET',-->
<!--            url: '/../QuizSys/APIThread/queryQuiz/'+click_id,-->
<!--            headers:{-->
<!--                'Content-type': 'application/json',-->
<!--                'Authorization': getCookie('Authorization'),-->
<!--            },-->
<!--            success: function (data) {-->
<!--                console.log(data);-->
<!--                if (data['success'] === true){-->
<!--                    var table = $(`-->
<!--                            <div class="tab-pane fade show active " id="room-${click_id}" role="tabpanel" aria-labelledby="nav-home-tab">-->
<!--                               <table class="table sortable table-striped table-bordered table-hover text-center table-list-quiz">-->
<!--                                   <thead>-->
<!--                                   <tr>-->
<!--                                        <th data-column="title" style="font-weight: normal">-->
<!--                                            <input type="checkbox" name="select-all" onclick="selectAll(this)">-->
<!--                                        </th>-->
<!--                                       <th data-column="title" style="font-weight: normal"><strong>Tiêu đề</strong></th>-->
<!--                                       <th data-column="date" style="font-weight: normal"><strong>Ngày tạo</strong></th>-->
<!--                                       <th data-column="#" style="font-weight: normal"><strong>Lần sửa gần nhất</strong></th>-->
<!--                                        <th data-column="#" style="font-weight: normal"><strong>Môn học</strong></th>-->
<!--                                        <th data-column="#" style="font-weight: normal"><strong>Tác vụ</strong></th>-->
<!--                                   </tr>-->
<!--                                   </thead>-->
<!--                                   <tbody>-->
<!--                                   </tbody>-->
<!--                               </table>-->
<!--                       </div>-->
<!---->
<!--`);-->
<!--                    $(".col-10 div.nab-content").html(table);-->
<!--                    var list = $(``);-->
<!--                    $.each(data['data'], function (index, values) {-->
<!--                        list =  $(`-->
<!--                                <tr id="${values['id']}">-->
<!--                                    <td class="align-middle"><input type="checkbox"></td>-->
<!--                                    <td class="align-middle"><a href="/../QuizSys/QuizPage/detail/${values['id']}">${values['title']}</a></td>-->
<!--                                    <td class="align-middle">${values['create_at']}</td>-->
<!--                                    <td class="align-middle">${values['update_at']}</td>-->
<!--                                    <td class="align-middle">${values['subject']}</td>-->
<!--                                    <td>-->
<!--                                    <div class="btn-group" role="group">-->
<!--                                        <button class="btn btn-xs button_download" name="button_download" data-toggle="modal" data-target="download" data-id="${values['id']}"><i class="fa fa-download" aria-hidden="true"></i></button>-->
<!--                                        <button class="btn btn-xs button_delete" name="button_delete" data-toggle="modal" data-target="delete" data-id="${values['id']}"><i class="fa fa-trash" aria-hidden="true"></i></button>-->
<!--                                    </div>-->
<!--                                   </td>-->
<!--                                </tr>-->
<!--                           `);-->
<!--                        ($(".table-list-quiz > tbody:last-child")).append(list);-->
<!--                    })-->
<!--                    list = $('');-->
<!---->
<!--                }-->
<!--            },-->
<!--            error: function (xhr, error) {-->
<!--                console.log(xhr, error);-->
<!--            }-->
<!--        })-->
<!--    }-->
<!--    function getQuizList(click_id) {-->
<!--        $(".table-list-quiz > tbody:last-child").empty().html('');-->
<!--        var table = $('');-->
<!--            $.ajax({-->
<!--                method: 'GET',-->
<!--                url: '/../QuizSys/APIThread/queryQuiz/'+click_id,-->
<!--                headers:{-->
<!--                    'Content-type': 'application/json',-->
<!--                    'Authorization': getCookie('Authorization'),-->
<!--                },-->
<!--                success: function (data) {-->
<!--                    if (data['success'] === true){-->
<!--                         table = $(`-->
<!--                            <div class="tab-pane fade" id="room-${click_id}" role="tabpanel" aria-labelledby="nav-home-tab">-->
<!--                               <table class="table sortable table-bordered table-striped  table-hover text-center table-list-quiz">-->
<!--                                   <thead>-->
<!--                                   <tr>-->
<!--                                        <th data-column="title" style="font-weight: normal">-->
<!--                                            <input type="checkbox" name="select-all" onclick="selectAll(this)">-->
<!--                                        </th>-->
<!--                                       <th data-column="title" style="font-weight: normal"><strong>Tiêu đề</strong></th>-->
<!--                                       <th data-column="date" style="font-weight: normal"><strong>Ngày tạo</strong></th>-->
<!--                                       <th data-column="#" style="font-weight: normal"><strong>Lần sửa gần nhất</strong></th>-->
<!--                                        <th data-column="#" style="font-weight: normal"><strong>Môn học</strong></th>-->
<!--                                        <th data-column="#" style="font-weight: normal"><strong>Tác vụ</strong></th>-->
<!--                                   </tr>-->
<!--                                   </thead>-->
<!--                                   <tbody>-->
<!--                                   </tbody>-->
<!--                               </table>-->
<!--                       </div>-->
<!---->
<!--`);-->
<!--                        $(".col-10 div.nab-content").append(table);-->
<!---->
<!--                        var list = $(``);-->
<!--                        $.each(data['data'], function (index, values) {-->
<!--                               list= $(`-->
<!--                                <tr id="${values['id']}">-->
<!--                                    <td class="align-middle"><input type="checkbox"></td>-->
<!--                                    <td class="align-middle"><a href="/../QuizSys/QuizPage/detail/${values['id']}">${values['title']}</a></td>-->
<!--                                    <td class="align-middle">${values['create_at']}</td>-->
<!--                                    <td class="align-middle">${values['update_at']}</td>-->
<!--                                     <td class="align-middle">${values['subject']}</td>-->
<!--                                    <td>-->
<!--                                        <div class="btn-group" role="group">-->
<!--                                            <button class="btn btn-xs button_download" name="button_download" data-toggle="modal" data-target="download" data-id="${values['id']}"><i class="fa fa-download" aria-hidden="true"></i></button>-->
<!--                                            <button class="btn btn-xs button_delete" name="button_delete" data-toggle="modal" data-target="delete" data-id="${values['id']}"><i class="fa fa-trash" aria-hidden="true"></i></button>-->
<!--                                        </div>-->
<!--                                   </td>-->
<!--                                </tr>-->
<!--                           `);-->
<!--                            ($(".table-list-quiz > tbody:last-child")).append(list);-->
<!--                        });-->
<!--                    }-->
<!--                },-->
<!--                error: function (xhr, error) {-->
<!--                    console.log(xhr, error);-->
<!--                }-->
<!--            })-->
<!--    }-->
<!--    function selectAll(current) {-->
<!--      if (current.checked === true){-->
<!--            $("input[type='checkbox']").each(function () {-->
<!--                this.checked = true;-->
<!--            })-->
<!--      }else{-->
<!--          $("input[type='checkbox']").each(function () {-->
<!--              this.checked = false;-->
<!--          })-->
<!--      }-->
<!--    }-->
<!--    function deleteQuiz() {-->
<!--        const array = [];-->
<!--        $("input[type='checkbox']").each(function (index, values) {-->
<!--            if (values.name === 'select-all'){-->
<!--                return ;-->
<!--            }-->
<!--            if (values.checked){-->
<!--                const id = $(values).parent().parent().attr('id');-->
<!--                array.push(id);-->
<!--            }-->
<!--        });-->
<!--        if (array.length === 0){-->
<!--            console.log('can not delete');-->
<!--        }-->
<!--        else {-->
<!--            $.ajax({-->
<!--                type: 'POST',-->
<!--                url: '/../QuizSys/APIThread/deleteQuiz/',-->
<!--                headers: {-->
<!--                    'Content-type': 'application/json',-->
<!--                    'Authorization': getCookie('Authorization')-->
<!--                },-->
<!--                data: JSON.stringify({list_delete: array}),-->
<!--                success: function (data) {-->
<!--                    if (data['success'] === true){-->
<!--                        alert('Xóa thành công');-->
<!--                        location.reload();-->
<!--                    }-->
<!--                },-->
<!--                error: function (xhr, error) {-->
<!--                    console.log(xhr, error)-->
<!--                }-->
<!--            })-->
<!--        }-->
<!--    }-->
<!--    $(document).on("click", '.button_delete', function (e) {-->
<!--        e.preventDefault();-->
<!--        var id = $(this).data('id');-->
<!--        var confirm_delete = confirm("Bạn muốn xóa đề "+id+ " này chứ ?");-->
<!--        if (confirm_delete){-->
<!--            var array = [id];-->
<!--            $.ajax({-->
<!--                type: 'PUT',-->
<!--                url: '/../QuizSys/APIThread/deleteQuiz/',-->
<!--                headers: {-->
<!--                    'Content-type': 'application/json',-->
<!--                    'Authorization': getCookie('Authorization')-->
<!--                },-->
<!--                data: JSON.stringify({list_delete: array}),-->
<!--                success: function (data) {-->
<!--                    if (data['success'] === true){-->
<!--                        alert('Xóa thành công');-->
<!--                        location.reload();-->
<!--                    }-->
<!--                },-->
<!--                error: function (xhr, error) {-->
<!--                    console.log(xhr, error)-->
<!--                }-->
<!--            })-->
<!--        }-->
<!--    })-->
<!---->
<!--    $(document).on("click", '.button_download', function (e) {-->
<!--        e.preventDefault();-->
<!--        var quiz_id = $(this).data('id');-->
<!--        $.ajax({-->
<!--            type: 'POST',-->
<!--            url: '/../QuizSys/APIThread/exportToExcel/'+quiz_id,-->
<!--            headers:{-->
<!--                'Content-type': 'application/json',-->
<!--                'Authorization': getCookie('Authorization')-->
<!--            },-->
<!--            success: function (data) {-->
<!--                const json = JSON.parse(data);-->
<!--                console.log(json);-->
<!--                if (json['success'] === true){-->
<!--                    const a = document.createElement('a');-->
<!--                    a.href = json['url'] ;-->
<!--                    a.download = json['data'];-->
<!--                    a.click();-->
<!--                    a.remove();-->
<!--                }-->
<!--            },-->
<!--            error: function (xhr, error) {-->
<!--                console.log(xhr, error);-->
<!--            }-->
<!--        })-->
<!--    })-->
<!--</script>-->


<script>
    const gradeName = {
        1: 'Trung học',
        2: 'Đại học',
        3: 'Doanh nghiệp',
        4: 'Khác'
    }

    $(document).ready(() => {
        $.ajax({
            method: 'GET',
            url: '/../QuizSys/APIRoom/queryRoomDetail/'+room_name,
            headers:{
                'Content-type': 'application/json',
                'Authorization': getCookie('Authorization')
            },
            async: false,
            success: (data) => {
                console.log(data)
                if (data['success'] === true){
                    const id_room = data['data'][0]['id']
                    queryQuizInRoom(id_room)
                    queryListQuizImport(id_room)
                }
            }
        })
    })

    const queryQuizInRoom = (id_room) =>{
        $.ajax({
            method: 'GET',
            url: '/../QuizSys/APIThread/queryQuizInRoom/'+id_room,
            headers: {
                'Content-type': 'application/json',
                'Authorization': getCookie('Authorization')
            },
            success: (data) =>{
                if (data['success'] === true){
                    let countPractice = 0
                    let countExam = 0
                    $(data['data']).each((index, value) =>{
                        let status_dot = '<span class="status-dot practice ml-3 " name="practice"></span><span class="small text-secondary">Ôn tập</span>'
                        if(value['status'] === '1'){
                            status_dot = '<span class="status-dot exam ml-3 " name="exam"></span><span class="small text-secondary">Kiểm tra</span>'
                            countExam += 1
                        }else{
                            countPractice += 1
                        }
                        $('#table-list-quiz tr:last').after(`
                             <tr>
                                <th scope="row">
                                    <a href='/../QuizSys/QuizPage/detail/${value['id']}' class="text-dark">${value['title']}</a>
                                    ${status_dot}
                                </th>
                                <td><p class='text-secondary'>${value['update_at']}</p></td>
                                <td class='text-secondary'>${value['description']}</td>
                                <td>
                                    <button class="btn-setting"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><p>...</p></button>
                                     <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Chi tiết</a>
                                        <a class="dropdown-item" href="#">Chia sẻ đề</a>

                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Cài đặt</a>
                                    </div>
                                </td>

                            </tr>
                        `)
                    })
                    $('#countExam').html(countExam)
                    $('#countPractice').html(countPractice)
                }
            }
        })
    }

    const queryListQuizImport = (id_room) => {
        $(document).ready(() => {
            $.ajax({
                method: 'GET',
                headers:{
                    'Authorization': getCookie('Authorization'),
                    'Content-type': 'application/json'
                },
                url: '/../QuizSys/APIThread/queryQuizImport/'+id_room,
                success: (data) => {
                    if (data['success'] === true){
                        $(data['data']).each((index, value) => {
                            $('#table-quiz-import tr:last').after(`
                            <tr>
                                <th>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox"  name="title-quiz" id="checkbox-${value['id']}" value="${value['id']}">
                                      <label class="form-check-label" for="checkbox-${value['id']}">${value['title']}</label>
                                    </div>
                                </th>
                                <th><small class="font-weight-normal text-secondary">${value['description']}</small></th>
                            </tr>
                            `)
                        })
                        $('#submitImport').attr('value', id_room)
                    }
                },
                error: (xhr, error) =>{
                    console.log(xhr, error)
                }
            })
        })
    }

    $(document).ready(() => {
        $('#submitImport').click(() => {
            let array_choose = []
            let checkbox, first_th
            const id_room = $('#submitImport').val()
            const table = $('#table-quiz-import')
            const tr = $(table).find('tr')
            for (let i = 1; i < tr.length; i++){
                first_th = $(tr[i]).find('th')[0]
                checkbox = $(first_th).find('input[name="title-quiz"]')
                if ($(checkbox).is(':checked')){
                    array_choose.push($(checkbox).val())
                }
            }
            $.ajax({
                method: 'POST',
                headers:{
                    'Content-type': 'application/json',
                    'Authorization': getCookie('Authorization')
                },
                url: '/../QuizSys/APIThread/shareToRoom',
                data: JSON.stringify(
                        {
                            id_room: id_room,
                            data: array_choose
                        }
                    ),
                success: (data) => {
                    if (data['success'] === true){
                        $('#table-list-quiz').empty().html('')
                        alert('Đã thêm các bộ đề số '+array_choose+ ' vào')
                        location.reload()
                    }
                },
                error: (xhr, error) => {
                    console.log(xhr, error)
                }
            })
        })
    })


    const searchImportQuiz = (value) => {
        let a, textValue, value_upper = value.toUpperCase()
        const table = $('#table-list-quiz')
        const tr = $(table).find('tr')
        for (let i = 1; i < tr.length; i++ ){
            a = $(tr[i]).find('th')[0]
            textValue = $(a).text() || $(a).textContent
            if (textValue.toUpperCase().indexOf(value_upper) > -1){
                tr[i].style.display = ''
            }else{
                tr[i].style.display = 'none'
            }
        }
    }

   function importQuiz() {
       $('#modalImport').modal('show')
   }

   function search(value){
       let a, textValue, value_upper = value.toUpperCase()
       const table = $('#table-list-quiz')
       const tr = $(table).find('tr')
       for (let i = 1; i < tr.length; i++ ){
           a = $(tr[i]).find('th')[0]
           textValue = $(a).text() || $(a).textContent
           if (textValue.toUpperCase().indexOf(value_upper) > -1){
               tr[i].style.display = ''
           }else{
               tr[i].style.display = 'none'
           }
       }
   }

   function displayType(type){
       const table = $('#table-list-quiz')
       let current_col
       const tr = $(table).find('tr')
       for (let i = 1; i < tr.length; i++){
           current_col = $(tr[i]).find('th')[0]
           let span = $(current_col).find('span')
           if ($(span).attr('name') !== type){
               tr[i].style.display = 'none'
           }else{
               tr[i].style.display = ''
           }
       }
   }

</script>