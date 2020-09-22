<?php include_once './MVC/Views/inc/master.php'?>
<style>
    .text-size {
        font-style: unset;
        color: white;
        margin-right: 30px;
        text-decoration: none;
        font-size: 25px;
        padding-top: 20px;
    }
    .text-size:hover{
        text-decoration: none;
    }
    .main{
        background-color: rgb(119, 170, 209);
        border: none;
    }
</style>

<body style="position: relative; width: 100%">
<div class="main">
    <div class="text-center text-size text-uppeercase" id="username"></i></div>
    <nav class="navbar navbar-expand-lg navbar-light ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav mr-lg-5 navbar-left">
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle"  id="navbarDropdown" role="button" data-toggle="dropdown" ><i class="fa fa-user" aria-hidden="true"></i></a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/../QuizSys/ProfileStudent"><i class="fa fa-info" aria-hidden="true"></i> Thông tin</a>
                        <a class="dropdown-item" id="btn_logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất </a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
</body>

<script>
    let user_info = {}
    $.ajax({
        type: 'GET',
        url: "/../QuizSys/Home/infoUserJWT",
        headers: {
            'Content-type': 'application/json',
            'Authorization': getCookie('Authorization')
        },
        async: false,
        success:function (data){
            const data_parse = JSON.parse(data)
            if (data_parse['success'] === 1){
                $('#username').html(data_parse['user']['username']);
                user_info = data_parse['user'];
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
</script>