<?php include_once './MVC/Views/inc/master.php'?>

<style>
    .main, navbar-expand-lg-footer{
        background-color: rgb(26, 24, 24);
        padding: 10px;
        border: none;
    }
    .text-size {
        font-style: unset;
        color: white;
        margin-right: 30px;
        text-decoration: none;
    }
    .text-size:hover{
        text-decoration: none;
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


         /* The switch - the box around the slider */
     .switch {
         position: relative;
         display: inline-block;
         width: 60px;
         height: 34px;
     }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    .dropdown-item:active{
        background-color: white;
        color: rgb(26, 24, 24);
    }

    .search-user{
        width: 30%;
        height: 35px;
        font-size: 14px;
        padding: 5px;
    }
    .logo{
        margin-right: 10px;
        border-radius: 50%;

    }
</style>
<body style="position: relative; width: 100%">
    <div class="main">
    <nav class="navbar navbar-expand-lg navbar-light ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <input type="text" name="searchUser" class="form-control search-user" placeholder="Tìm người dùng...">
            <div class="btn-group ml-auto">
                <div class="btn-group dropleft" role="group">
                    <button type="button"  class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: white">
                        <span class="sr-only "></span>
                    </button>

                    <div class="dropdown-menu">
                        <small><a class="dropdown-item" href="/../QuizSys/Home/InstructorHome"><i class="fa fa-info" aria-hidden="true"></i> Thông tin</a></small>
                        <small><a class="dropdown-item" href="/../QuizSys/Home/InstructorHome"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a></small>
                        <small><a class="dropdown-item" href="/../QuizSys/Home/InstructorHome"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Phòng </a></small>
                        <small><a class="dropdown-item" href="/../QuizSys/Home/InstructorHome"><i class="fa fa-book" aria-hidden="true"></i> Kho đề</a></small>
                        <hr>
                        <small><a class="dropdown-item" id="btn_logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất </a>
                        </small>
                        <div class="dropdown-divider"></div>
                    </div>
                </div>
                <button type="button" class="btn btn-outline-light">
                    <i class="fa fa-user fa-1x" aria-hidden="true"></i>
                    <span id="username" class="mr-3"></span>
                </button>
            </div>
        </div>
    </nav>
</div>
</body>

<script>
    function selectRadioButton(name, value){
        $("input[name='"+name+"'][value='"+value+"']").attr("checked", "checked")
    }

    function getInfoUser(){
       return  fetch( "/../QuizSys/Home/infoUserJWT",{
            method: 'GET',
            headers: {
                'Authorization': getCookie('Authorization'),
                'Content-type': 'application/json'
            }
        }).then(response => response.json()
        ).then(data => {
            if (data['success'] === true){
                return data['user']
            }
        }).catch(error => {
            console.log(error)
        })
    }
    const userInfo =  getInfoUser()
    userInfo.then(data => {
        document.getElementById('username').innerHTML = data['username']
        document.getElementById('username_icon').innerHTML = data['username']
    })
    // function loadInfoUser(){
    //     $('#username').html(data_parse['user']['username']);
    //                 id = data_parse['user']['id'];
    //                 $("#email").val(data_parse['user']['email']);
    //                 $('#first_name').val(data_parse['user']['first_name']);
    //                 $('#last_name').val(data_parse['user']['last_name']);
    //                 $('#city').val(data_parse['user']['city']);
    //                 $('#country').val(data_parse['user']['country']);
    //                 $('#organization_name').val(data_parse['user']['organization_name']);
    //                 $('#position').val(data_parse['user']['position']);
    //                 var value_gender = data_parse['user']['gender'];
    //                 selectRadioButton("gender", value_gender);
    //             }else {
    //                 window.location.href = "/../QuizSys/MVC/Views/inc/404_page.php";
    //             }
    // }
        // $.ajax({
        //     type: 'GET',
        //     url: "/../QuizSys/Home/infoUserJWT",
        //     headers: {
        //         'Authorization': getCookie('Authorization'),
        //     },
        //     async: false,
        //     success:function (data){
        //         var data_parse = JSON.parse(data);
        //         user = data['user']
        //         if (data_parse['success'] === true){
        //             $('#username').html(data_parse['user']['username']);
        //             id = data_parse['user']['id'];
        //             $("#email").val(data_parse['user']['email']);
        //             $('#first_name').val(data_parse['user']['first_name']);
        //             $('#last_name').val(data_parse['user']['last_name']);
        //             $('#city').val(data_parse['user']['city']);
        //             $('#country').val(data_parse['user']['country']);
        //             $('#organization_name').val(data_parse['user']['organization_name']);
        //             $('#position').val(data_parse['user']['position']);
        //             var value_gender = data_parse['user']['gender'];
        //             selectRadioButton("gender", value_gender);
        //         }else {
        //             window.location.href = "/../QuizSys/MVC/Views/inc/404_page.php";
        //         }
        //     },
        //     error: function (xhr, error) {
        //         console.log(xhr);
        //         console.log(error);
        //     }
        // });


    $('#btn_logout').click(function () {
        const question_logout = confirm("Bạn có muốn đăng xuất không?");
        if (question_logout === true){
            const url = '/../QuizSys/APILogout/logout'
            const option = {
                type: 'GET',
                headers: {
                    'Content-type': 'application/json',
                    'Authorization': getCookie('Authorization')
                }
            }
            fetch(url, option).then(response => response.json()).
                then(data => {
                if (data['success'] === true){
                    window.location.replace(data['url'])
                }
            }).catch(error => console.log(error))
        }
    });


    // var return_first = function () {
    //     var tmp = null;
    //     $.ajax({
    //         async: false,
    //         global: false,
    //         dataType: 'html',
    //         type: "GET",
    //         url: "/../QuizSys/Home/infoUserJWT",
    //         headers: {
    //             'Content-type': 'application/json',
    //             'Authorization': getCookie('Authorization'),
    //         },
    //         success: function (data) {
    //             tmp = JSON.parse(data)['user']['id']
    //         }
    //     });
    //     return tmp;
    // }();
    const return_first = userInfo.then(data => {
        return data['id']
    })
</script>
