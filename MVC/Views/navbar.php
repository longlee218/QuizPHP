<?php include_once './MVC/Views/inc/master.php'?>

<style>
    .main, navbar-expand-lg,.page-footer {
        background-color: rgb(119, 170, 209);
        border: none;
    }
    .page-footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        color: white;
        text-align: center;
        padding: 15px;
    }
    #username {
        text-align: center;
        font-size: x-large;
        padding: 40px;
    }
    .text-size {
        font-style: unset;
        color: white;
        margin-right: 30px;
    }
    .nav-item{
        margin-right: 20px;
        margin-top: 10px;
    }
    .link_size:focus {
        background-color: rgb(119, 170, 209);
    }
</style>
<div class="main">
    <div class="text-center text-size text-uppeercase" id="username"></i></div>
    <span class="glyphicon glyphicon-user"></span>
    <nav class="navbar navbar-expand-lg navbar-light ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="text-size" href="/../QuizSys/Home/InstructorHome" >Trang chủ <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="text-size" href="#">Bộ đề <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class=" text-size" href="/../QuizSys/RoomAction">Phòng thi <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="text-size" href="#">Báo cáo <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active text-size">
                    <a class="text-size" href="#">Kết quả <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-size" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/../QuizSys/ProfileInstructor">Thông tin</a>
                        <a class="dropdown-item" id="btn_logout">Đăng xuất</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>

<script>
    var id;
    function selectRadioButton(name, value){
        $("input[name='"+name+"'][value='"+value+"']").prop('checked', true);
    }
    $.ajax({
        type: 'GET',
        url: "/../QuizSys/Home/infoUserJWT",
        success:function (data){
            var data_parse = JSON.parse(data);
            if (data_parse['success'] === 1){
                $('#username').html(data_parse['user']['username']+' <i class="fa fa-wifi" aria-hidden="true">');
                $('#navbarDropdown').html(data_parse['user']['username']);
                id = data_parse['user']['id'];
                $("#email").val(data_parse['user']['email']);
                $('#first_name').val(data_parse['user']['first_name']);
                $('#last_name').val(data_parse['user']['last_name']);
                $('#city').val(data_parse['user']['city']);
                $('#country').val(data_parse['user']['country']);
                $('#organization_name').val(data_parse['user']['organization_name']);
                $('#position').val(data_parse['user']['position']);
                var value_gender = data_parse['user']['gender'];
                selectRadioButton("gender", value_gender);
            }else {
                window.location.href = "/../QuizSys/MVC/Views/inc/404_page.php";
            }
        },
        error: function (xhr, error) {
            console.log(xhr);
            console.log(error);
        }
    });
    $('#btn_logout').click(function () {
        var question_logout = confirm("Bạn có muốn đăng xuất không?");
        if (question_logout === true){
            $.ajax({
                type: 'GET',
                url: '/../QuizSys/APILogout/logout',
                success: function (data) {
                    window.location.href = data['url'];
                },
                error: function (xhr, error){
                    console.log(xhr);
                    console.log(error);
                }
            })
        }
    });
    function clickReset(){
        var username = $("#username").text()
        window.location.href = "/../QuizSys/reset_password?usr="+username;
    }
    var return_first = function () {
        var tmp = null;
        $.ajax({
            'async': false,
            'type': "GET",
            'global': false,
            'dataType': 'html',
            'url': "/../QuizSys/Home/infoUserJWT",
            'success': function (data) {
                tmp = JSON.parse(data)['user']['id'];
            }
        });
        return tmp;
    }();
</script>
