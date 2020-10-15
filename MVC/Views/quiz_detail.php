<?php require_once './MVC/Views/navbar.php'?>
<style>
    #title_quiz{
        height: 40px;
        width: 400px;
        font-size: 20pt;
        text-transform: uppercase;
        padding: 20px 5px;
    }
    .qs_correct{
        width: 25px;
        height: 30px;
    }
    label {
        cursor: pointer;
    }
    .image-preview{
        width: 150px;
        min-height: 150px;
        border: 2px solid #dddddd;
        margin-top: 15px;
        display: flex;
        align-content: center;
        justify-content: center;
        font-weight: bold;
        color: #cccccc;
    }

    #main-content{
        padding-left: 40px;
        padding-right: 40px;
    }

</style>


<div class="container-fluid" id="main-content">
    <nav class="project-tab">
        <div class="nav nav-tabs nav-room" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-room-quiz-tab" data-toggle="tab" href="#nav-content-quiz" role="tab" aria-controls="nav-content" aria-selected="true">
                <i class="fa fa-list" aria-hidden="true"></i>
                    Nội dung
            </a>
            <a class="nav-item nav-link" id="nav-room-setting-tab" data-toggle="tab" href="#nav-quiz-setting" role="tab" aria-controls="nav-setting" aria-selected="false">
                <i class="fa fa-cogs" aria-hidden="true"></i>
                Cài đặt
            </a>
        </div>
    </nav>
    <div class="tab-content" id="navTabContent">
        <div class="tab-pane pade show active" id="nav-content-quiz" role="tabpanel" aria-labelledby="nav-content-quiz-tab">
            <?php require_once './MVC/Views/quiz_content.php'?>
        </div>
        <div class="tab-pane pade" id="nav-quiz-setting" role="tabpanel" aria-labelledby="nav-quiz-setting-tab">
            <?php require_once './MVC/Views/quiz_setting.php'?>
        </div>
    </div>
</div>
