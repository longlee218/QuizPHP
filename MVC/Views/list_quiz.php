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
</style>
<div class="container-fluid">
<div class="row">
    <div class="col col-md-9 dashboard-quiz">
        <div class="mt-4">
            <form class="form-quiz">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col col-md-5">
                            <div class="input-group mb-3">
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropDownCategorize" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Phân loại</button>
                                    <div class="dropdown-menu" aria-labelledby="dropDownCategorize">
                                        <a class="dropdown-item" href="#">Ôn tập</a>
                                        <a class="dropdown-item" href="#">Kiểm tra</a>
                                    </div>
                                </div>
                                <input type="text" class="form-control" placeholder="Nhập tên đề">
                            </div>
                        </div>
                        <div class="col col-md-2">
                            <input type="date" class="form-control" id="dateForm">
                        </div>
                        <div class="col-1 d-flex justify-content-center align-items-center">
                            <span class="fa fa-arrow-right mb-4" aria-hidden="true"></span>
                        </div>
                        <div class="col col-md-2">
                            <input type="date" class="form-control" id="dateTo">
                        </div>
                        <div class="col col-md-2">
                            <button class="btn btn-success"><i class="fa fa-star-o" aria-hidden="true"></i>
                                Tạo đề mới</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card">
            <div class="card-header">
                <a href="#" class="text-dark"><i class="fa fa-file-text-o" aria-hidden="true"></i><span id="countExam"></span> Kiểm tra</a>
                <a href="#" class="text-dark"><i class="fa fa-check" aria-hidden="true"><span id="countPractice"></span></i> Ôn tập</a>
            </div>
            <div class="card-body mt-0" id="list-quiz">
                <table class="table table-hover" id="table-list-quiz">
                    <thead>
<!--                        <tr>-->
<!--                            <th scope="col">Tên đề</th>-->
<!--                            <th scope="col">Môn học</th>-->
<!--                            <th scope="col">Mô tả</th>-->
<!--                            <th scope="col">Trình độ</th>-->
<!--                            <th scope="col">Lần cập nhật cuối</th>-->
<!--                        </tr>-->
                    </thead>
                    <tbody>
                        <tr></tr>
<!--                    <tr>-->
<!--                        <th scope="row">1</th>-->
<!--                        <td>Mark</td>-->
<!--                        <td>Otto</td>-->
<!--                        <td>@mdo</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <th scope="row">2</th>-->
<!--                        <td>Jacob</td>-->
<!--                        <td>Thornton</td>-->
<!--                        <td>@fat</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <th scope="row">3</th>-->
<!--                        <td colspan="2">Larry the Bird</td>-->
<!--                        <td>@twitter</td>-->
<!--                    </tr>-->
                    </tbody>
                </table>
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

    // $(document).ready(() => {
    //
    // })
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
                    // console.log(data['data'])
                    console.log(id_room)
                    queryQuizInRoom(id_room)
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
                console.log($('#table-list-quiz'))
                if (data['success'] === true){
                    $(data['data']).each((index, value) =>{
                        $('#table-list-quiz tr:last').after(`
                             <tr>
                                <th scope="row"><a href='#' class="text-dark">${value['title']}</a></th>
                                <td>${value['subject']}</td>
                                <td>${value['description']}</td>
                                <td>${gradeName[value['grade']]}</td>
                                <td>${value['update_at']}</td>
                            </tr>
                        `)
                    })
                }
            }
        })
    }
</script>