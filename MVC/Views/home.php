<?php include_once './MVC/Views/inc/master.php'?>
<div class="container">
    <h2 id="username" ></h2>
    <button id="btn_logout" class="btn btn-outline-primary" value="logout">Logout</button>
</div>
<script>

    $.ajax({
        type: 'GET',
        url: "./Home/infoUserJWT",
        success:function (data){
            var data_parse = JSON.parse(data);
            if (data_parse['success'] === 1){
                $('#username').html(data_parse['user']['username']);
            }
        }
    });
    $('#btn_logout').click(function () {
        var question_logout = confirm("Bạn có muốn đăng xuất không?");
        if (question_logout === true){
            document.cookie = 'Authorization' + '=; expires=Thu, 01-Jan-70 00:00:01 GMT;';
            location.href = '../QuizSys';
        }
    });


</script>
