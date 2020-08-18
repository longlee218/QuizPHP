<?php include_once './MVC/Views/inc/master.php'?>
<div class="container">
    <hr>
    <div class="row justify-content-center pt-5">
        <aside class="col-sm-4">
            <div class="card">
                <article class="card-body mt-3">
                    <h4 class="card-title mb-4 mt-1">Đăng nhập</h4>
                    <div id="messages"></div>
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
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox"> Lưu mật khẩu </label>
                            </div> <!-- checkbox .// -->
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <button type="submit" name="login_button" id='login_btn' class="btn btn-primary btn-block"> Đăng nhập </button>
                        </div> <!-- form-group// -->
                    </form>
                </article>
            </div> <!-- card.// -->

        </aside> <!-- col.// -->
    </div> <!-- row.// -->
    <script>
        $(document).ready(function (){
            $("#login_btn").click(function () {
                var data = $(this);
                var email = $("#email").val();
                var password  = $('#password').val();
                var data_post_json = {email:email, password:password};
                $.ajax({
                    url: './MVC/Controller/APILogin.php',
                    type: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: data_post_json,
                }).done(function (data) {
                    if (data['success'] === 1){
                        location.href = "Home/defaultFunction";
                    }
                    if (data['success'] === 0){
                        if (data['mess'] === "Your email is not validate"){
                            $('#messages_email').html("<small class='text-danger'>*Vui lòng kiểm tra lại email!</small>")
                        }else if(data['mess'] === "Please fill in this fields"){
                            $('#messages').html("<small class='text-danger'>*Không được bỏ trống các trường sau</small>")
                        }else if (data['mess'] === "Wrong password"){
                            $('#messages_password').html("<small class='text-danger'>*Sai mật khẩu vui lòng thử lại!</small>")
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