<?php require_once './MVC/Views/navbar.php' ?>
<style>
    .setting-main{
        margin-top: 20px;
        padding: 0 20px;
    }
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

</style>
<script>
    const this_url = window.location.href
    const array_value = this_url.split('/')
    const room_name = array_value.slice(-1)[0]
    // document.getElementById('room-name').innerHTML = decodeURIComponent(room_name)

</script>

<div class="setting-main">
    <div class="nav-tab">
        <div class="col col-md-12">
            <h3 class=""><a href="#" id="room-name" class="text-primary"></a></h3>
            <nav class="project-tab">
                <div class="nav nav-tabs nav-room" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-room-quiz-tab" data-toggle="tab" href="#nav-room-quiz" role="tab" aria-controls="nav-home" aria-selected="true">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        Danh sách đề
                    </a>
                    <a class="nav-item nav-link" id="nav-room-report-tab" data-toggle="tab" href="#nav-room-report" role="tab" aria-controls="nav-profile" aria-selected="false">
                        <i class="fa fa-line-chart" aria-hidden="true"></i>
                        Thống kê <span class="counter" id="count-room"></span>
                    </a>
                    <a class="nav-item nav-link" id="nav-room-setting-tab" data-toggle="tab" href="#nav-room-access" role="tab" aria-controls="nav-contact" aria-selected="false">
                        <i class="fa fa-spinner" aria-hidden="true"></i>
                        Truy cập <span class="counter" id="count-quiz"></a>
                    <a class="nav-item nav-link" id="nav-room-setting-tab" data-toggle="tab" href="#nav-room-setting" role="tab" aria-controls="nav-contact" aria-selected="false">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                        Cài đặt <span class="counter" id="count-quiz"></a>
                </div>
            </nav>
            <div class="tab-content" id="navTabContent">
                <div class="tab-pane pade show active" id="nav-room-quiz" role="tabpanel" aria-labelledby="nav-home-tab">
                    <?php require_once './MVC/Views/list_quiz.php'?>
                </div>
                <div class="tab-pane pade" id="nav-room-report" role="tabpanel" aria-labelledby="nav-room-report-tab">
                    <?php require_once './MVC/Views/report.php'?>
                </div>
                <div class="tab-pane pade" id="nav-room-access" role="tabpanel" aria-labelledby="nav-store-quiz-tab">
                    Access
                </div>
                <div class="tab-pane pade" id="nav-room-setting" role="tabpanel" aria-labelledby="nav-room-setting-tab">
                    <?php require_once './MVC/Views/room_setting.php'?>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.getElementById('room-name').innerHTML = decodeURIComponent(room_name)
</script>
