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
</style>

<div class="quiz-tab">
    <div class="row">
        <div class="col col-md-5 search-quiz">
            <input type="text" placeholder="Tìm kiếm đề..." class="form-control search-input">
        </div>
        <div class="col col-md-7">
            <button class="btn btn-outline-success float-right" name="newQuiz" onclick="location.href = '/../QuizSys/QuizPage'"><small>Thêm mới đề</small></button>
        </div>
    </div>
    <div class="quiz-content">
        <div class="card card-list-quiz">
            <div class="card-header dashboard-quiz">
                <a href="#" class="text-dark font-weight-bold" id="count-quiz-training">Ôn tập</a>
                <a href="#" class="text-dark font-weight-bold" id="count-quiz-exam">Kiểm tra</a>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush" id="list-quiz"></ul>
            </div>
        </div>
    </div>
</div>

<script>
    function queryQuiz() {
        $(document).ready(() => {
            $.ajax({
                method: 'GET',
                url: '/../QuizSys/APIThread/queryQuiz',
                headers: {
                    'Content-type': 'application/json',
                    'Authorization': getCookie('Authorization')
                },
                success: (data) => {
                    console.log(data)
                    if (data['success'] === true){
                        $.each(data['data'],  (index, value) => {
                           $('#list-quiz:last-child').append(`
                                  <li class="list-group-item li-quiz" name="${value['id']}">
                                    <div class="row">
                                        <div class="col col-md-4">
                                            <a href="#" class="text-secondary font-weight-bold ">${value['title']}</a>
                                        </div>
                                        <div class="col col-md-3"></div>
                                        <div class="col col-md-4"><small class="text-secondary">Môn học: ${value['subject']}</small></div>
                                        <div class="col col-md-1"> <button class="more-quiz" name="${value['id']}"><p class="font-weight-bold">...</p></button></div>
                                    </div>
                                    <i class="fa fa-clock-o mr-2" aria-hidden="true"></i><small class="text-secondary">Lần sửa gần nhất ${value['update_at']}</small>
                                </li>
                            `)
                        })
                    }
                },
                error: (xhr, error) => {
                    console.log(xhr, error)
                }
            })
        })
    }
    queryQuiz()
</script>