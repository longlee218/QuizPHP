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
