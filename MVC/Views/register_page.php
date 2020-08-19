<?php
require_once 'inc/master.php';
?>
<div class="container">
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <header class="card-header">
                    <a href="Login" class="float-right btn btn-outline-primary mt-1">Đăng nhập</a>
                    <h3 class="card-title mt-2">Đăng ký</h3>
                </header>
                <article class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="col form-group">
                                <label>Họ </label>
                                <input type="text" class="form-control" placeholder="">
                            </div> <!-- form-group end.// -->
                            <div class="col form-group">
                                <label>Tên</label>
                                <input type="text" class="form-control" placeholder=" ">
                            </div> <!-- form-group end.// -->
                        </div> <!-- form-row end.// -->
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="example@examp.com">
<!--                            <small class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                        </div> <!-- form-group end.// -->
                        <div class="form-group">
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="option1">
                                <span class="form-check-label"> Nam </span>
                            </label>
                            <label class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="option2">
                                <span class="form-check-label"> Nữ</span>
                            </label>
                        </div> <!-- form-group end.// -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Thành phố</label>
                                <input type="text" class="form-control">
                            </div> <!-- form-group end.// -->
                            <div class="form-group col-md-6">
                                <label>Quốc gia</label>
                                <select id="inputState" class="form-control">
                                    <option> Choose...</option>
                                    <option>Uzbekistan</option>
                                    <option>Russia</option>
                                    <option selected="">United States</option>
                                    <option>India</option>
                                    <option>Afganistan</option>
                                </select>
                            </div> <!-- form-group end.// -->
                        </div> <!-- form-row.// -->
                        <div class="form-group">
                            <label>Nhập mật khẩu</label>
                            <input class="form-control" type="password">
                        </div> <!-- form-group end.// -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary btn-block"> Đăng ký  </button>
                        </div> <!-- form-group// -->
<!--                        <small class="text-muted">By clicking the 'Sign Up' button, you confirm that you accept our <br> Terms of use and Privacy Policy.</small>-->
                    </form>
                </article> <!-- card-body end .// -->
                <div class="border-top card-body text-center">Bạn đã có tài khoản? <a href="Login">Đăng nhập</a></div>
            </div> <!-- card.// -->
        </div> <!-- col.//-->

    </div> <!-- row.//-->


</div>
