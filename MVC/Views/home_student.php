<?php include_once './MVC/Views/navbar.php'?>
<?php include_once './MVC/Views/inc/script.php' ?>
<style>
    .page{
        padding: 10px;
        border-left-style: solid;
        border-left-width: thin;
    }
    .page-info{
        height: 50rem;
        overflow: scroll;
    }
    .dashboard{
        padding: 20px;
    }
    .info-page{
        padding: 20px 0;
    }
    .form-search{
        padding-top: 20px;
    }
    .label-bold{
        font-weight: 800;
    }
    .form-search-room{
        height: 40px;
        padding: 5px;
    }
    .page-detail{
        background-color: #f1f8ff;
    }
</style>
<!--old html and scripts-->
<!--<body>-->
<!--    <div class="container">-->
<!--        <div class="modal fade" id="modalRoom" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">-->
<!--            <div class="modal-dialog">-->
<!--                <div class="modal-content">-->
<!--                    <div class="modal-header"></div>-->
<!--                    <div class="modal-body">-->
<!--                        <form name="login_room">-->
<!--                            <div class="form-group">-->
<!--                                <label>Mật khẩu</label>-->
<!--                                <input id="password-room" type="password" placeholder="**********" name="password_room" class="form-control">-->
<!--                            </div>-->
<!--                            <div id="message_room"></div>-->
<!--                        </form>-->
<!--                    </div>-->
<!--                    <div class="modal-footer">-->
<!--                        <button id="btn-login-room" class="btn btn-outline-success btn-block m-auto" type="button">Đăng nhập</button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <h1>This is Student Home</h1>-->
<!--        <h2 id="username" ></h2>-->
<!--        <form method="post" class="form-group mt-5">-->
<!--            <div class="form-group">-->
<!--                <input class="form-control" placeholder="Search...." oninput="searchRoom(this.value)">-->
<!--            </div>-->
<!--        </form>-->
<!--        <div class="list-group" id="listRoom">-->
<!--            <div></div>-->
<!--        </div>-->
<!--    </div>-->
<!--</body>-->
<!--<script>-->
<!--    $('#btn_logout').click(function () {-->
<!--        var question_logout = confirm("Bạn có muốn đăng xuất không?");-->
<!--        if (question_logout === true){-->
<!--            $.ajax({-->
<!--                type: 'GET',-->
<!--                url: '/../QuizSys/APILogout/logout',-->
<!--                success: function (data) {-->
<!--                    window.location.href = data['url'];-->
<!--                },-->
<!--                error: function (xhr, error){-->
<!--                    console.log(xhr);-->
<!--                    console.log(error);-->
<!--                }-->
<!--            })-->
<!--        }-->
<!--    });-->
<!--  $(document).ready(function () {-->
<!--      $.ajax({-->
<!--          type: 'GET',-->
<!--          url: '/../QuizSys/APIRoom/viewRoom',-->
<!--          headers: {-->
<!--              'Content-type': 'application/json',-->
<!--              'Authorization': getCookie('Authorization')-->
<!--          },-->
<!--          success: function (data){-->
<!--              $.each(data['data'], function(index, room){-->
<!--                  if (room['password'] === null){-->
<!--                      $('#listRoom:last-child').append(`-->
<!--                    <button type="button"  class="text-uppercase list-group-item list-group-item-action"-->
<!--                        id="${room['id']}" onclick="goToRoom(this)">${room['room_name']}</but>-->
<!--                    `);-->
<!--                  }else{-->
<!--                      $('#listRoom:last-child').append(`-->
<!--                    <button type="button"  class="text-uppercase list-group-item list-group-item-action"-->
<!--                    data-toggle="modal" id="${room['room_name']}"  onclick="enterPassword(this)" >${room['room_name']}</but>-->
<!--                `);-->
<!--                  }-->
<!--              })-->
<!--              console.log(data);-->
<!--          },-->
<!--          error: function (xhr, error) {-->
<!--              console.log(xhr, error);-->
<!--          }-->
<!--      })-->
<!--  })-->
<!---->
<!--    function goToRoom(e) {-->
<!--        window.location.href = "/../QuizSys/RoomAction/RoomContent/"+e.id;-->
<!--    }-->
<!---->
<!--    function searchRoom(room_name) {-->
<!--        console.log(room_name);-->
<!--        $.ajax({-->
<!--            type: 'GET',-->
<!--            url: '/../QuizSys/APIRoom/searchRoom/'+room_name,-->
<!--            headers:{-->
<!--                'Content-type': 'application/json',-->
<!--                'Authorization': getCookie('Authorization')-->
<!--            },-->
<!--            success: function (data) {-->
<!--                if (data['success'] === true){-->
<!--                    $('#listRoom').empty().html('');-->
<!--                    $.each(data['data'], function(index, room){-->
<!--                        if (room['password'] === null){-->
<!--                            $('#listRoom:last-child').append(`-->
<!--                    <button type="button"  class="text-uppercase list-group-item list-group-item-action"-->
<!--                        id="${room['id']}" onclick="goToRoom(this)">${room['room_name']}</but>-->
<!--                    `);-->
<!--                        }else{-->
<!--                            $('#listRoom:last-child').append(`-->
<!--                    <button type="button"  class="text-uppercase list-group-item list-group-item-action"-->
<!--                    data-toggle="modal" id="${room['room_name']}"  onclick="enterPassword(this)" >${room['room_name']}</but>-->
<!--                `);-->
<!--                        }-->
<!--                    })-->
<!--                }-->
<!--            },-->
<!--            error: function (xhr, error) {-->
<!--                console.log(xhr, error);-->
<!--            }-->
<!--        })-->
<!--    }-->
<!--    function enterPassword(e) {-->
<!--        var room_name = e.id;-->
<!--        console.log(room_name);-->
<!--        $("#modalRoom").modal()-->
<!--        $("#modalRoom .modal-header").html(`<h4>${room_name}</h4>`)-->
<!--    }-->
<!---->
<!--    $(document).ready(function (e) {-->
<!--        $('#btn-login-room').on('click', function () {-->
<!--            const password = $('#password-room').val();-->
<!--            const room_name = $('#modalRoom .modal-header').text();-->
<!--            console.log(room_name);-->
<!--            const data = {-->
<!--                room_name: room_name,-->
<!--                password: password-->
<!--            }-->
<!--            $.ajax({-->
<!--                type: 'POST',-->
<!--                url: '/../QuizSys/APIRoom/loginIntoRoom',-->
<!--                headers:{-->
<!--                    'Content-type': 'application/json',-->
<!--                    'Authorization': getCookie('Authorization'),-->
<!--                },-->
<!--                data: JSON.stringify(data),-->
<!--                success: function (data) {-->
<!--                    console.log(data);-->
<!--                    if(data['success'] === false){-->
<!--                        document.getElementById('message_room').innerHTML = '<small class="text-danger">*Không đúng mật khẩu</small>'-->
<!--                    }else{-->
<!--                        window.location.href = data['data'];-->
<!--                    }-->
<!--                },-->
<!--                error: function (xhr, error) {-->
<!--                    console.log(xhr, error);-->
<!--                }-->
<!--            })-->
<!--        })-->
<!--    })-->
<!--</script>-->



<div class="container-fluid">
    <div class="row">
        <div class="col col-md-3 page page-info" id="info">
            <div class="dashboard">
                <div class="border-bottom info-page">
                    <div class="dropdown">
                        <i class="fa fa-user" aria-hidden="true"></i><small id="username_icon" class="font-weight-bold ml-3"></small>
                        <span class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item list-group-item-action" href="#">Thông tin</a>
                            <a class="dropdown-item list-group-item-action" href="#">Kho đề</a>
                            <a class="dropdown-item list-group-item-action" href="#">Kết quả</a>
                        </div>
                    </div>
                </div>
                <div class="border-bottom form-search">
                    <form>
                        <div class="form-group">
                                <label class="small  text-secondary">Danh sách phòng</label>
                                <input class="form-control form-search-room" placeholder="Tìm kiếm phòng">
                            </div>
                        <div class="form-group">
                                <ul class="list-group" id="list-room"><li class="list-group-item"></li></ul>
                        </div>
                    </form>
                </div>
                <div class="border-bottom current-quiz mt-3">
                    <div class="form-group">
                        <small class="text-secondary">Các đề gần đây</small>
                            <div class="list-group mt-3">
                                <a class="list-group-item list-group-item-action" href="#">Cras justo odisssssssssssssssssso</a>
                                <a class="list-group-item list-group-item-action" href="#">Dapibus ac facilisis in</a>
                                <a class="list-group-item list-group-item-action" href="#">Morbi leo risus</a>
                                <a class="list-group-item list-group-item-action" href="#">Porta ac consectetur ac</a>
                                <a class="list-group-item list-group-item-action" href="#">Vestibulum at eros</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-md-9 page page-detail" id="content" style="padding: 30px 20px">
            <div class="row">
                <div class="col col-md-9">
                    <div class="wall-content">
                        <div class="card" style="width:400px">
                            <div class="card-body">
                                <h4 class="card-title">John Doe</h4>
                                <p class="card-text">Some example text some example text. John Doe is an architect and engineer</p>
                                <a href="#" class="btn btn-primary">See Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-md-3 page">
                    this is score
                </div>
            </div>
        </div>
    </div>
</div>
<script>


    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: '/../QuizSys/APIRoom/viewRoom',
            headers: {
                'Content-type': 'application/json',
                 'Authorization': getCookie('Authorization')
             },
            success: function (data){
                 $.each(data['data'], function(index, room){
                     const time_ago = timeAgo(room['update_at'])
                     $('#list-room').append(`
                       <a class="list-group-item list-group-item-action flex-column align-items-start" href="#" id="${room['room_name']}">
                        <div class="d-flex w-100 justify-content-between">
                              <h6 class="mb-1"> ${room['room_name']}</h6>
                              <small>${time_ago}</small>
                            </div>
                            <small>Donec id elit non mi porta.</small>

                        </a>
                   `);
                 })
             },
            error: function (xhr, error) {
                     console.log(xhr, error);
                 }
            })
     })

</script>