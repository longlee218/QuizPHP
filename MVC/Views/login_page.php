<?php include_once './MVC/Views/inc/master.php'?>
<div class="container">
    <hr>
    <div class="row justify-content-center pt-5">
        <div class="col-md-4">
            <div class="card">
                    <header class="card-header">
                        <h3 class="card-title mb-4 mt-1">Đăng nhập</h3>
                    </header>
                    <article class="card-body">
                        <form method="post" id="login_form">
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" id="email" class="form-control" placeholder="Enter email" type="text">
                                <div id="messages_email"></div>
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <a class="float-right" href="ForgotPassword/defaultFunction">Quên mật khẩu?</a>
                                <label>Mật khẩu</label>
                                <input name="password" id="password" class="form-control" placeholder="******" type="password">
                                <div id="messages_password"></div>
                                <div id="messages"></div>
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <div class="checkbox">
                                    <a class="float-right" href="RegisterAccount">Đăng ký tài khoản?</a>
                                    <label><input type="checkbox"> Lưu mật khẩu </label>
                                </div> <!-- checkbox .// -->
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <button type="submit" name="login_button" id='login_btn' class="btn btn-outline-primary btn-block"> Đăng nhập </button>
                            </div> <!-- form-group// -->
                        </form>
                    </article>
            </div> <!-- card.// -->

        </div> <!-- col.// -->
    </div> <!-- row.// -->
    <script>
        $(document).ready(function (){
            $("#login_btn").click(function () {
                var email = $("#email").val();
                var password  = $('#password').val();
                var data_post_json = {email:email, password:password};
                console.log(data_post_json);
                $.ajax({
                    url: '/../QuizSys/APILogin/checkLoginAPI',
                    type: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: data_post_json,
                }).done(function (data) {
                    if (data['success'] === 1){
                        setTimeout(function () {
                            window.location.href = data['url'];
                        },1000)
                    }
                    if (data['success'] === 0){
                        if (data['mess'] === "Your email is not validate"){
                            $('#messages_email').html("<small class='text-danger'>*Vui lòng kiểm tra lại email!</small>")
                        }else if(data['mess'] === "Please fill in this fields"){
                            $('#messages').html("<small class='text-danger'>*Không được bỏ trống các trường sau</small>")
                        }else if (data['mess'] === "Wrong password"){
                            $('#messages_password').html("<small class='text-danger'>*Sai mật khẩu vui lòng thử lại!</small>")
                        }else if(data['mess'] === "Wrong email or username"){
                            $('#messages').html("<small class='text-danger'>*Sai email hoặc mật khẩu</small>")
                        }
                    }
                }).fail(function (xhr, error) {
                    console.log(xhr);
                    console.log(error);
                });
                return false;
            });
        });
    </script>
</div>