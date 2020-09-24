<?php include_once './MVC/Views/navbar_student.php'?>
<body>
    <div class="container">
        <div class="modal fade" id="modalRoom" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"></div>
                    <div class="modal-body">
                        <form name="login_room">
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input id="password-room" type="password" placeholder="**********" name="password_room" class="form-control">
                            </div>
                            <div id="message_room"></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="btn-login-room" class="btn btn-outline-success btn-block m-auto" type="button">Đăng nhập</button>
                    </div>
                </div>
            </div>
        </div>
        <h1>This is Student Home</h1>
        <h2 id="username" ></h2>
        <form method="post" class="form-group mt-5">
            <div class="form-group">
                <input class="form-control" placeholder="Search...." oninput="searchRoom(this.value)">
            </div>
        </form>
        <div class="list-group" id="listRoom">
            <div></div>
        </div>
    </div>
</body>
<script>
    $('#btn_logout').click(function () {
        var question_logout = confirm("Bạn có muốn đăng xuất không?");
        if (question_logout === true){
            $.ajax({
                type: 'GET',
                url: '/../QuizSys/APILogout/logout',
                success: function (data) {
                    window.location.href = data['url'];
                },
                error: function (xhr, error){
                    console.log(xhr);
                    console.log(error);
                }
            })
        }
    });
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
                  if (room['password'] === null){
                      $('#listRoom:last-child').append(`
                    <button type="button"  class="text-uppercase list-group-item list-group-item-action"
                        id="${room['id']}" onclick="goToRoom(this)">${room['room_name']}</but>
                    `);
                  }else{
                      $('#listRoom:last-child').append(`
                    <button type="button"  class="text-uppercase list-group-item list-group-item-action"
                    data-toggle="modal" id="${room['room_name']}"  onclick="enterPassword(this)" >${room['room_name']}</but>
                `);
                  }
              })
              console.log(data);
          },
          error: function (xhr, error) {
              console.log(xhr, error);
          }
      })
  })

    function goToRoom(e) {
        window.location.href = "/../QuizSys/RoomAction/RoomContent/"+e.id;
    }

    function searchRoom(room_name) {
        console.log(room_name);
        $.ajax({
            type: 'GET',
            url: '/../QuizSys/APIRoom/searchRoom/'+room_name,
            headers:{
                'Content-type': 'application/json',
                'Authorization': getCookie('Authorization')
            },
            success: function (data) {
                if (data['success'] === true){
                    $('#listRoom').empty().html('');
                    $.each(data['data'], function(index, room){
                        if (room['password'] === null){
                            $('#listRoom:last-child').append(`
                    <button type="button"  class="text-uppercase list-group-item list-group-item-action"
                        id="${room['id']}" onclick="goToRoom(this)">${room['room_name']}</but>
                    `);
                        }else{
                            $('#listRoom:last-child').append(`
                    <button type="button"  class="text-uppercase list-group-item list-group-item-action"
                    data-toggle="modal" id="${room['room_name']}"  onclick="enterPassword(this)" >${room['room_name']}</but>
                `);
                        }
                    })
                }
            },
            error: function (xhr, error) {
                console.log(xhr, error);
            }
        })
    }
    function enterPassword(e) {
        var room_name = e.id;
        console.log(room_name);
        $("#modalRoom").modal()
        $("#modalRoom .modal-header").html(`<h4>${room_name}</h4>`)
    }

    $(document).ready(function (e) {
        $('#btn-login-room').on('click', function () {
            const password = $('#password-room').val();
            const room_name = $('#modalRoom .modal-header').text();
            console.log(room_name);
            const data = {
                room_name: room_name,
                password: password
            }
            $.ajax({
                type: 'POST',
                url: '/../QuizSys/APIRoom/loginIntoRoom',
                headers:{
                    'Content-type': 'application/json',
                    'Authorization': getCookie('Authorization'),
                },
                data: JSON.stringify(data),
                success: function (data) {
                    console.log(data);
                    if(data['success'] === false){
                        document.getElementById('message_room').innerHTML = '<small class="text-danger">*Không đúng mật khẩu</small>'
                    }else{
                        window.location.href = data['data'];
                    }
                },
                error: function (xhr, error) {
                    console.log(xhr, error);
                }
            })
        })
    })
</script>
