<?php include_once './MVC/Views/inc/master.php'?>

<style>
    #navbarSupportedContent {
        background-color: rgb(119, 170, 209);
    }
    #username{
        background-color: rgb(119, 170, 209);

    }
    #username{
        font-size: xx-large;
    }

</style>

<div>
    <div class="d-flex justify-content-center text-light pt-3 text-uppercase" id="username">
<!--        <h3 id="username" ></h3>-->
    </div>
    <nav class="navbar navbar-expand-lg navbar-light pt-3" id="navbarSupportedContent">
        <a class="navbar-brand text-light" href="#">Quiz</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ml-3" >
            <ul class="navbar-nav mr-5">
                <li class="nav-item active mr-3">
                    <a class="nav-link text-light" href="#">Trang chủ <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link text-light" href="#">Các bộ đề</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link text-light" href="#">Phòng thi</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link text-light" href="#">Báo cáo</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link text-light" href="#">Kết quả</a>
                </li>
            </ul>
        </div>
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Thông tin</a>
                <a class="dropdown-item" href="#">Đăng xuất</a>
            </div>
        </div>

    </nav>
</div>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
