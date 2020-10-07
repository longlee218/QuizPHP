<?php require_once './MVC/Views/navbar.php' ?>
<style>
    .create-main{
        padding: 20px;
        margin-top: 10px;
        width: 70%;
    }

</style>

<div class="container create-main">
    <h3>Tạo phòng mới</h3>
    <p>Phòng là nơi chứa các bộ đề của bạn, là nơi có thể tiến hành kiểm tra.</p>
    <a href="#"><small>Đi tới phòng của bạn</small></a>
    <hr>
    <br>
    <form class="form form-room">
        <div class="form-group">
            <div class="form-row">
                <div class="col-2">
                    <label class="font-weight-bold">Người dùng</label>
                    <input type="text" class="form-control" id="user_input" disabled>
                </div>
                <div class="col-4 field">
                    <label class="font-weight-bold">Tên phòng</label>
                    <input type="text" class="form-control" placeholder="Nhập tên phòng" id="room_name" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <label for="description_room" class="font-weight-bold">Mô tả <small class="text-secondary">(có thể bỏ qua)</small></label>
                    <textarea class="form-control" id="description_room" rows="3"></textarea>
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status-radio" id="publicRoom" value="0" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            <span><i class="fa fa-book fa-3x" aria-hidden="true"></i></span>
                            <span class="font-weight-bold">Công khai</span>
                            <br>
                            <small class="text-secondary">Mọi người đều có thể nhìn thấy phòng của bạn.</small>
                        </label>
                    </div>
                    <div class="form-check mt-4">
                        <input class="form-check-input" type="radio" name="status-radio" id="privateRoom" value="1">
                        <label class="form-check-label" for="exampleRadios2">
                            <span><i class="fa fa-lock fa-3x text-warning" aria-hidden="true"></i></span>
                            <span class="font-weight-bold">Riêng tư</span>
                            <br>
                            <small class="text-secondary">Chỉ mình bạn có thể nhìn thấy phòng.</small>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <div class="form-row">
                <div class="col-3">
                    <label class="font-weight-bold">Mật khẩu <small class="text-secondary">(có thể bỏ qua)</small></label>
                    <input type="password" name="password_room" id="password_room" class="form-control">
                </div>
                <div class="col-3">
                    <label class="font-weight-bold">Nhập lại mật khẩu</label>
                    <input type="password" name="password_confirm" id="password_confirm" class="form-control">
                </div>
            </div>
        </div>
        <hr>
        <button class="btn btn-success" id="create_room">Tạo mới</button>
    </form>
</div>

<script>
    $(document).ready(() => {
        $.ajax({
            type: 'GET',
            url: "/../QuizSys/Home/infoUserJWT",
            headers: {
                'Content-type': 'application/json',
                'Authorization': getCookie('Authorization'),
            },
            success: (data) => {
                const data_parse = JSON.parse(data)
                document.getElementById('user_input').value = data_parse['user']['username']
            },
            error: (xhr, error) => {
                console.log(xhr, error)
            }
        })
    })


    $('#create_room').click(function() {
        const room_name = document.getElementById('room_name').value
        const password = document.getElementById('password_room').value
        const password_confirm = document.getElementById('password_confirm').value
        const description = document.getElementById('description_room').value
        const status =  $('input[type="radio"][name="status-radio"]:checked').val()
        if (password !== password_confirm){
            alert('Mật khẩu không khớp')
        }else{
            const data = {
                room_name: room_name,
                password: password,
                status: status,
                description: description
            }
            $.ajax({
                method: 'POST',
                url: '/../QuizSys/APIRoom/createNewRoom',
                headers: {
                    'Content-type': 'application/json',
                    'Authorization': getCookie('Authorization')
                },
                data: JSON.stringify(data),
                success: (data) => {
                    if (data['success'] === true){
                        alert('Phòng đã được tạo. Click ok để quay lại')
                        window.location.replace('/../QuizSys/Home/InstructorHome?tab=nav-room')
                    }else{
                        alert(data['mess'])
                    }
                }
            })
        }
        return false
    })

</script>