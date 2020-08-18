<?php include_once './MVC/Views/inc/master.php'?>
<div class="container">
    <hr>
    <div class="row justify-content-center pt-5">
        <aside class="col-sm-4">
            <div class="card">
                <article class="card-body mt-3">
                    <h4 class="card-title mb-4 mt-1">Sign in Quiz System</h4>
                    <div id="messages"></div>
                    <form method="post" id="login_form">
                        <div class="form-group">
                            <label>Your email</label>
                            <input name="email" id="email" class="form-control" placeholder="Enter email" type="text">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <a class="float-right" href="#">Forgot?</a>
                            <label>Your password</label>
                            <input name="password" id="password" class="form-control" placeholder="******" type="password">
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <div class="checkbox">
                                <label> <input type="checkbox"> Save password </label>
                            </div> <!-- checkbox .// -->
                        </div> <!-- form-group// -->
                        <div class="form-group">
                            <button type="submit" name="login_button" id='login_btn' class="btn btn-primary btn-block"> Login  </button>
                        </div> <!-- form-group// -->
                    </form>
                </article>
            </div> <!-- card.// -->

        </aside> <!-- col.// -->
    </div> <!-- row.// -->
    <script>
        $(document).on('submit', '#login_form', function (){
            var data = $(this);
            var email = $("#email").val();
            var password  = $('#password').val();
            var data_post_json = {email:email, password:password};
            console.log(data_post_json);
            console.log(typeof (data_post_json));
            $.ajax({
                url: './MVC/Controller/APILogin.php',
                type: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: data_post_json,
            }).done(function (data) {
               console.log(data);
            }).fail(function (xhr, error) {
                console.log(xhr);
                console.log(error);
            });
            return false;
        });
    </script>
</div>