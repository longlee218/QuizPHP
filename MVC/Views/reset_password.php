<?php
require_once __DIR__.'/inc/master.php';
?>

<div class="container">
    <div class="row justify-content-center pt-5">
        <aside class="col-sm-4">
            <div class="card">
                <article class="card-body mt-3">
                    <h4 class="card-title mb-4 mt-1">Thay đổi mật khẩu</h4>
                    <div id="messages"></div>
                    <form method="post" id="login_form">
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input name="password" id="password" class="form-control" placeholder="*******" type="password">
                            <div id="password"></div>
                        </div>
                        <div class="form-group">
                            <label>Nhập lại mật khẩu</label>
                            <input name="password_confirm" id="password_confirm" class="form-control" placeholder="*******" type="password">
                            <div id="password_confirm"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="update_password" id='update_btn' class="btn btn-primary btn-block">Thay đổi </button>
                        </div> <!-- form-group// -->
                    </form>
                </article>
            </div> <!-- card.// -->
        </aside> <!-- col.// -->
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#update_btn').click(function () {
            var password = $('#password').val();
            var password_confirm = $('#password_confirm').val();
            var data_post_json = {
                password:password,
                password_confirm:password_confirm
            };
            var searchParam = new URLSearchParams(window.location.search);
            const user = searchParam.get('usr')
            $.ajax({
                url: '/../QuizSys/APIResetPassword/resetPassword/'+user,
                type: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                data: JSON.stringify(data_post_json),
            }).done(function (data) {
                console.log(data);
                if (data['success'] === true){
                    location.href = '/../QuizSys/Login/';
                }
                else{
                    if (data['messages'] === "Please fill all these fields"){
                        $('#password').html("<small class='text-danger'>*Không được để trống</small>");
                        $('#password_confirm').html('<small class="text-danger">*Không được để trống</small>');
                    }else if (data['messages'] === 'Your password is not same'){
                        $('#password_confirm').html('<small>*Mật khẩu không giống nhau</small>')
                    }
                }
            }).fail(function (xhr, error){
                console.log(xhr);
                console.log(error);
            });
            return false;
        });
    });
</script>