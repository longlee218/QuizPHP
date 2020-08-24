<?php include_once './MVC/Views/inc/master.php'?>

<style>
    #navbarSupportedContent,#navbarMain, #username, #brand {
        background-color: rgb(119, 170, 209);
    }
    #username{
        font-size: xx-large;
    }
    .navbar-brand{
        font-weight: bold;
    }
    .text_size{
        font-size: large;
        text-transform: uppercase;
    }
</style>
<div>
    <div id="brand">
<!--        <a class="navbar-brand text-light justify-content-between" href="#"><h3>QUIZ</h3></a>-->
        <div class="d-flex justify-content-center text-light text-uppercase pt-3" id="username">
    </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light" id="navbarMain">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active ml-3 mr-3">
                    <a class="nav-link text-light text_size" href="#">Trang chủ <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link text-light text_size" href="#">Bộ đề</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link text-light text_size" href="#">Phòng thi</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link text-light text_size" href="#">Báo cáo</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link text-light text_size" href="#">Kết quả</a>
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
            console.log(data_parse)
            if (data_parse['success'] === 1){
                $('#username').html(data_parse['user']['username']);
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
            }
        },
        error: function (xhr, error) {
            console.log(xhr);
            console.log(error);
        }
    });
    $('#link_logout').click(function () {
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
