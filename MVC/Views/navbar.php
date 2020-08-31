<?php include_once './MVC/Views/inc/master.php'?>

<style>
    .main, navbar-expand-lg,.page-footer {
        background-color: rgb(119, 170, 209);
        border: none;
    }
    .page-footer {
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
    .wifi-symbol {display: none;}
    .wifi-symbol {display: inline-block;width: 10px;height: 10px;margin-top: -187.5px;-ms-transform: rotate(-45deg) translate(-100px);-moz-transform: rotate(-45deg) translate(-100px);-o-transform: rotate(-45deg) translate(-100px);-webkit-transform: rotate(-45deg) translate(-100px);transform: rotate(-45deg) translate(-100px);}
    .wifi-symbol .wifi-circle {box-sizing: border-box;-moz-box-sizing: border-box;display: block;width: 20%;height: 20%;font-size: 21.42857px;position: absolute;bottom: 0;left: 0;border-color: aqua;border-style: solid;border-width: 1em 1em 0 0;-webkit-border-radius: 0 100% 0 0;border-radius: 0 100% 0 0;opacity: 0;-o-animation: wifianimation 3s infinite;-moz-animation: wifianimation 3s infinite;-webkit-animation: wifianimation 3s infinite;animation: wifianimation 3s infinite;}.wifi-symbol .wifi-circle.first {-o-animation-delay: 800ms;-moz-animation-delay: 800ms;-webkit-animation-delay: 800ms;animation-delay: 800ms;}.wifi-symbol .wifi-circle.second {width: 5em;height: 5em;-o-animation-delay: 400ms;-moz-animation-delay: 400ms;-webkit-animation-delay: 400ms;animation-delay: 400ms;}.wifi-symbol .wifi-circle.third {width: 3em;height: 3em;}.wifi-symbol .wifi-circle.fourth {width: 1em;height: 1em;opacity: 1;background-color: white;-o-animation: none;-moz-animation: none;-webkit-animation: none;animation: none;}@-o-keyframes wifianimation {0% {opacity: 0.4;}5% {opactiy: 1;}6% {opactiy: 0.1;}100% {opactiy: 0.1;}}@-moz-keyframes wifianimation {0% {opacity: 0.4;}5% {opactiy: 1;}6% {opactiy: 0.1;}100% {opactiy: 0.1;}}@-webkit-keyframes wifianimation {0% {opacity: 0.4;}5% {opactiy: 1;}6% {opactiy: 0.1;}100% {opactiy: 0.1;}}
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
            <ul class="nav navbar-nav mr-lg-5 navbar-left">
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle"  id="navbarDropdown" role="button" data-toggle="dropdown" ><i class="fa fa-user" aria-hidden="true"></i></a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/../QuizSys/ProfileInstructor"><i class="fa fa-info" aria-hidden="true"></i> Thông tin</a>
                        <a class="dropdown-item" id="btn_logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất </a>
                        <div class="dropdown-divider"></div>
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
    // window.setInterval(function () {
        $.ajax({
            type: 'GET',
            url: "/../QuizSys/Home/infoUserJWT",
            success:function (data){
                var data_parse = JSON.parse(data);
                if (data_parse['success'] === 1){
                    $('#username').html(data_parse['user']['username']+'<div class="wifi-symbol">\n' +
                        '<div class="wifi-circle first"></div>\n' +
                        '<div class="wifi-circle second"></div>\n' +
                        '<div class="wifi-circle third"></div>\n' +
                        '<div class="wifi-circle fourth"></div>\n' +
                        '</div>');
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
    // }, 5000);
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
