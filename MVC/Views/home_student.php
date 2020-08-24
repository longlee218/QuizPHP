<?php include_once './MVC/Views/inc/master.php'?>
<div class="container">
    <h1>This is Student Home</h1>
    <h2 id="username" ></h2>
    <button id="btn_logout" class="btn btn-outline-primary" value="logout">Logout</button>
</div>
<script>

    $.ajax({
        type: 'GET',
        url: "../Home/infoUserJWT",
        success:function (data){
            var data_parse = JSON.parse(data);
            console.log(data_parse);
            if (data_parse['success'] === 1){
                $('#username').html(data_parse['user']['username']);
            }
        },
        error: function (xhr, error) {
            console.log(xhr);
            console.log(error);
        }
    });
</script>
