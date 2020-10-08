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
        /*padding: 5px;*/
        padding: 10px 5px 10px 15px;
        display: table;
    }
    .dashboard-quiz > a {
        padding: 0 10px;
        /*display: table-cell;*/
        vertical-align: middle;
    }
    .more-quiz{
        border: none;
        background-color: white;
    }
    .li-quiz{
        padding-top: 10px;
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
                                          <h5> <a href="#" class="text-secondary font-weight-bold ">${value['title']}</a></h5>
                                        </div>
                                        <div class="col col-md-3"></div>
                                        <div class="col col-md-4"><small class="text-secondary">Môn học: ${value['subject']}</small></div>
                                        <div class="col col-md-1 mt-2"> <button class="more-quiz" name="${value['id']}"><p class="font-weight-bold">...</p></button></div>
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
                                        <div class="col col-md-1 mt-2"> <button class="more-quiz" name="${value['id']}"><p class="font-weight-bold">...</p></button></div>
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

</script>