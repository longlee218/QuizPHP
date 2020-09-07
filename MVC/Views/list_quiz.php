<?php include_once './MVC/Views/navbar.php'?>
<div class="container">
    <div class="row m-3">
        <div class="col-sm d-inline-flex">
            <div class="position-relative text-uppercase"><h3>danh sách đề</h3></div>
        </div>
        <div class="col-sm">
            <div class="float-right"><a href="/../QuizSys/QuizPage/" class="btn btn-outline-primary" style="border-radius: 30px;font-size:20px">Tạo mới đề</a></div>
        </div>
    </div>
    <br>
    <div class="search-quizz">
        <div class="search-div">
            <i id="search-icon" class="fa fa-search" aria-hidden="true"></i>
            <input type="text" onkeyup="myFunction()" id="search_input" placeholder="Tìm kiếm...">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col col-md-2">
            <div class="nav flex-column nav-pills" id="list_room_tab" role="tablist" aria-orientation="vertical"></div>
        </div>
        <div class="col col-md-10">
            <div class="col-10">
               <div class="nab-content tab-content" ></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: "/../QuizSys/APIRoom/queryRoom/"+return_first,
            success: function (data) {
                var list_room_tab = $("#list_room_tab");
                $.each(data, function (i, room) {
                    var element = ``;
                    if (i === 0){
                        element = $(`
                    <a class="nav-link active room_nav" id="${room['id']}" onclick="getQuizListActive(${room['id']})" data-toggle="pill" href="#room-${room['id']}" role="tab" aria-controls="v-pills-home" aria-selected="true">${room['room_name']}</a>
           `);
                        list_room_tab.append(element);
                        element.trigger('click');
                        //element.one('click', getQuizListActive(room['id']));
                    }

                    else{
                        element = $(`
                    <a class="nav-link  room_nav" id="${room['id']}" onclick="getQuizList(${room['id']})"  data-toggle="pill" href="#room-${room['id']}" role="tab" aria-controls="v-pills-home" aria-selected="true">${room['room_name']}</a>
           `);
                        $(".table-list-quiz > tbody:last-child").empty().html('');
                        list_room_tab.append(element);

                        // element.on('click', getQuizList(room['id']));
                    }
                })
            }
        })
    })

    function getQuizListActive(click_id) {
        $(".table-list-quiz > tbody:last-child").empty().html('');
        $.ajax({
            method: 'GET',
            url: '/../QuizSys/APIThread/queryQuiz/'+click_id,
            headers:{
                'Content-type': 'application/json'
            },
            success: function (data) {
                console.log(data);
                if (data['success'] === 1){
                    var table = $(`
                            <div class="tab-pane fade show active " id="room-${click_id}" role="tabpanel" aria-labelledby="nav-home-tab">
                               <table class="table sortable table-list-quiz">
                                   <thead>
                                   <tr>
                                        <th data-column="title" style="font-weight: normal">
                                            <input type="checkbox">
                                        </th>
                                       <th data-column="title" style="font-weight: normal"><strong>Tiêu đề</strong></th>
                                       <th data-column="date" style="font-weight: normal"><strong>Ngày tạo</strong></th>
                                       <th data-column="#" style="font-weight: normal"><strong>Lần sửa gần nhất</strong></th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   </tbody>
                               </table>
                       </div>

`);
                    $(".col-10 div.nab-content").html(table);
                    var list = $(``);
                    $.each(data['data'], function (index, values) {
                        list =  $(`
                                <tr id="quiz-${values['id']}">
                                    <td class="align-middle"><input type="checkbox"></td>
                                   <td class="align-middle"><a href="/../QuizSys/QuizPage/detail/${values['id']}">${values['title']}</a></td>
                                    <td class="align-middle">${values['create_at']}</td>
                                    <td class="align-middle">${values['update_at']}</td>
                                </tr>
                           `);
                        ($(".table-list-quiz > tbody:last-child")).append(list);
                    })
                    list = $('');

                }
            },
            error: function (xhr, error) {
                console.log(xhr, error);
            }
        })
    }
    function getQuizList(click_id) {
        // $('.nab-content').empty().html('');
        // alert(click_id);
        $(".table-list-quiz > tbody:last-child").empty().html('');
        var table = $('');
            $.ajax({
                method: 'GET',
                url: '/../QuizSys/APIThread/queryQuiz/'+click_id,
                headers:{
                    'Content-type': 'application/json'
                },
                success: function (data) {
                    if (data['success'] === 1){
                         table = $(`
                            <div class="tab-pane fade" id="room-${click_id}" role="tabpanel" aria-labelledby="nav-home-tab">
                               <table class="table sortable table-list-quiz">
                                   <thead>
                                   <tr>
                                        <th data-column="title" style="font-weight: normal">
                                            <input type="checkbox">
                                        </th>
                                       <th data-column="title" style="font-weight: normal"><strong>Tiêu đề</strong></th>
                                       <th data-column="date" style="font-weight: normal"><strong>Ngày tạo</strong></th>
                                       <th data-column="#" style="font-weight: normal"><strong>Lần sửa gần nhất</strong></th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   </tbody>
                               </table>
                       </div>

`);
                        $(".col-10 div.nab-content").append(table);

                        var list = $(``);
                        $.each(data['data'], function (index, values) {
                               list= $(`
                                <tr id="quiz-${values['id']}">
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><a href="/../QuizSys/QuizPage/detail/${values['id']}">${values['title']}</a></td>
                                    <td class="align-middle">${values['create_at']}</td>
                                </tr>
                           `);
                            ($(".table-list-quiz > tbody:last-child")).append(list);
                        });
                    }
                },
                error: function (xhr, error) {
                    console.log(xhr, error);
                }
            })
    }
</script>

<?php include_once './MVC/Views/footer.php'?>