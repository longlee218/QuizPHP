<?php
    require_once 'inc/master.php';
?>
<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h6><i class="fa fa-lock fa-4x"></i></h6>
                        <h2 class="text-center">Quên mật khẩu?</h2>
                        <p>Bạn có thể thay đổi mật khẩu của mình tại đây.</p>
                        <div class="panel-body">
                            <form id="register-form" role="form" autocomplete="off" class="form" method="post">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                        <input id="email" name="email" placeholder="Nhập email" class="form-control"  type="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div type="hidden" id="messages"></div>
                                </div>
                                <div class="form-group">
                                    <input name="recover-submit" id="send_email" class="btn  btn-outline-primary btn-block" value="Thay đổi mật khẩu" type="submit">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function (){
        $('#send_email').click(function (){
            var email = $('#email').val();
            var data_post_json = {
                email:email
            };
            $.ajax({
                type: 'POST',
                url: '/../QuizSys/APISendEmail/sendEmailResetPassword',
                headers: {
                    'Content-Type': 'application/json',
                },
                data: JSON.stringify(data_post_json),
            }).done(function (data){
                console.log(data);
                if (data['success'] === false){
                    if (data['messages'] === "Don't have this email"){
                        $('#messages').html('<small class="text-danger" >*Không tồn tại email này</small>');
                    }else if (data['messages'] === "You must fill your email"){
                        $('#messages').html('<small class="text-danger" >*Không được để trống</small>')
                    }
                }else{
                    $('#messages').html('<small class="text-success">*Chúng tôi đã gửi email cho bạn, vui lòng kiểm tra</small>')
                }
            }).fail(function (xhr, error){
                console.log(xhr);
                console.log(error);
            });
            return false;
        });
    });
</script>