<?php include_once './MVC/Views/navbar.php'?>
<div class="container">
    <h1>This is Instructor Home</h1>
    <button id="btn_logout" class="btn btn-outline-primary" value="logout">Logout</button>
</div>
<script>
    $('#btn_logout').click(function () {
        var question_logout = confirm("Bạn có muốn đăng xuất không?");
        if (question_logout === true){
            $.ajax({
                type: 'GET',
                url: '../APILogout/logout',
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
