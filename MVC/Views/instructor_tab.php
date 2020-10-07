<?php include_once './MVC/Views/inc/master.php'?>
<style>
    .tab-main{
        width: 68%;
        height: 700px;
        padding: 10px;
        margin-top: 20px;
        margin-bottom: 30px;
        margin-left: 10px;
    }
    .project-tab #tabs{
        background: #007b5e;
        color: #eee;
    }
    .project-tab #tabs h6.section-title{
        color: #eee;
    }
    .project-tab #tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: black;
        background-color: transparent;
        border-color: transparent transparent #f3f3f3;
        border-bottom: 3px solid !important;
        font-size: 15px;
        font-weight: bold;
    }
    .project-tab .nav-tabs .nav-item:hover{
        border: none;
    }
    .project-tab .nav-link {
        border: 1px solid transparent;
        border-top-left-radius: .25rem;
        border-top-right-radius: .25rem;
        font-size: 15px;
        color: #817c7c;
        font-weight: 600;
    }
    .counter{
        border-radius: 50%;
        padding: 3px 5px 3px 5px;
        background-color: gray;
        color: white;
    }
</style>
<div class="tab-main" id="tab-instructor">
    <div class="nav-tab">
        <div class="col col-md-12">
            <nav class="project-tab">
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a>
                    <a class="nav-item nav-link" id="nav-room-tab" data-toggle="tab" href="#nav-room" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        Phòng <span class="counter" id="count-room"></span></a>
                    <a class="nav-item nav-link" id="nav-store-quiz-tab" data-toggle="tab" href="#nav-store-quiz" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fa fa-book" aria-hidden="true"></i>
                        Kho đề <span class="counter" id="count-quiz"></a>
                    <a class="nav-item nav-link" id="nav-result-tab" data-toggle="tab" href="#nav-result" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fa fa-check" aria-hidden="true"></i> Kết quả</a>
                </div>
            </nav>
            <div class="tab-content" id="navTabContent">
                <div class="tab-pane pade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <?php require_once './MVC/Views/home_tab.php'?>
                </div>
                <div class="tab-pane pade" id="nav-room" role="tabpanel" aria-labelledby="nav-room-tab">
                    <?php require_once './MVC/Views/room_tab.php'?>
                </div>
                <div class="tab-pane pade" id="nav-store-quiz" role="tabpanel" aria-labelledby="nav-store-quiz-tab">
                    <?php require_once './MVC/Views/quiz_tab.php'?>
                </div>
                <div class="tab-pane pade" id="nav-result" role="tabpanel" aria-labelledby="nav-result-tab">This is result</div>
            </div>
        </div>
    </div>
</div>

<script>
    function findGetParameter(parameterName) {
        var result = null,
            tmp = [];
        location.search
            .substr(1)
            .split("&")
            .forEach(function (item) {
                tmp = item.split("=");
                if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
            });
        return result;
    }
    const tab =  findGetParameter('tab')
    const tab_id = ['nav-home', 'nav-room', 'nav-store-quiz', 'nav-result']
    if (tab_id.includes(tab)){
        const tab_active = tab+'-tab'
        $('#nav-home-tab').removeClass('active')
        $('#'+tab_active).addClass('active')
        $('#nav-home').removeClass('show active')
        $('#'+tab).addClass('show active')
    }


    $(document).ready(function () {
        $.ajax({
            method: 'GET',
            url: '/../QuizSys/APIRoom/queryRoom',
            headers:{
                'Content-type': 'application/json',
                'Authorization': getCookie('Authorization')
            },
            success: (data) => {
                console.log(data)
                if (data['success'] === true){
                    const count = data['data'].length
                    if (count === 0){
                        document.getElementById('count-room').style.display = 'none'
                    }else{
                        document.getElementById('count-room').innerHTML = count
                    }
                }
            }
        })
        $.ajax({
            method: 'GET',
            url: '/../QUizSys/APIThread/queryQuiz/',
            headers: {
                'Content-type': 'application/json',
                'Authorization': getCookie('Authorization')
            },
            success: (data) =>{
                if (data['success'] === true){
                    const count = data['data'].length
                    if (count === 0){
                        document.getElementById('count-quiz').style.display = 'none'
                    }else{
                        document.getElementById('count-quiz').innerHTML = count
                    }
                }
            }
        })
    })


</script>