<?php include_once './MVC/Views/inc/master.php'?>

<style>
    #navbarSupportedContent,#navbarMain, #username, #brand {
        background-color: rgb(119, 170, 209);
    }
    #username{
        font-size: xx-large;
    }
    .text_size{
        font-size: 13px;
        text-transform: uppercase;
    }
    #btn_logout:active{
        background: white;
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
                <li class="nav-item active mr-3">
                    <a class="nav-link text-light text_size" href="/../QuizSys/Home/InstructorHome">Trang chủ <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link text-light text_size" href="#">Bộ đề</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link text-light text_size" href="/../QuizSys/RoomAction/defaultFunction">Phòng thi</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link text-light text_size" href="#">Báo cáo</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link text-light text_size" href="#">Kết quả</a>
                </li>
                <li class="nav-item dropdown float-right">
                    <a class="nav-link dropdown-toggle text_size text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/../QuizSys/ProfileInstructor">Tài khoản</a>
                        <a class="dropdown-item" id="btn_logout">Đăng xuất</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button>-->
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Open modal for @fat</button>-->
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Open modal for @getbootstrap</button>-->
<!---->
<!--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
<!--    <div class="modal-dialog" role="document">-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <h5 class="modal-title" id="exampleModalLabel">New message</h5>-->
<!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                    <span aria-hidden="true">&times;</span>-->
<!--                </button>-->
<!--            </div>-->
<!--            <div class="modal-body">-->
<!--                <form>-->
<!--                    <div class="form-group">-->
<!--                        <label for="recipient-name" class="col-form-label">Recipient:</label>-->
<!--                        <input type="text" class="form-control" id="recipient-name">-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label for="message-text" class="col-form-label">Message:</label>-->
<!--                        <textarea class="form-control" id="message-text"></textarea>-->
<!--                    </div>-->
<!--                </form>-->
<!--            </div>-->
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--                <button type="button" class="btn btn-primary">Send message</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
