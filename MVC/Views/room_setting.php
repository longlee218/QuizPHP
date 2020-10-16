<?php require_once './MVC/Views/inc/master.php' ?>
<style>
    .setting-tab{
        border-style: solid;
        border-width: thin;
        padding: 10px;
        border-radius: 15px;
    }
    .card-advance{
        border-color: red;
    }

</style>
<div class="container-fluid mt-3 mb-5">
    <div class="row">
        <div class="col col-2">
            <div class="setting-bar">

            </div>
        </div>
        <div class="col col-10">
            <div class="tab-content" >
                <div class="tab-pane pade show active" id="nav-option1" role="tabpanel" aria-labelledby="nav-option1-tab">
                    <div class="mt-3">
                        <h5>Cài đặt</h5>
                        <hr>
                        <form method="post" id="form-update" onsubmit="return update()">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col col-4">
                                        <label class="font-weight-bold">Tên phòng</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="room_name" placeholder="Nhập tên mới">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col col-10">
                                        <label for="exampleFormControlTextarea1" class="font-weight-bold" id="d">Mô tả</label>
                                        <textarea class="form-control" id="description" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <div class="form-row">
                                    <div class="col">
                                        <label class="font-weight-bold">Trạng thái</label>
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
                                           <div class="form-group mt-4">
                                               <button class="btn btn-success" type="submit">Cập nhật</button>
                                           </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <h5>Nâng cao</h5>
                        <hr>
                        <div class="card card-advance mt-3">
                            <div class="card-body">
                                <ul>
                                    <li>
                                        <div class="row">
                                            <div class="col col-10">
                                                <p class="font-weight-bold">Xóa phòng</p>
                                                <small>Một khi đã xóa phòng sẽ không thể khôi phục được</small>
                                            </div>
                                            <div class="col col-2">
                                                <button class="btn btn-outline-danger">Xóa phòng</button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    roomDetail.then(data =>{
        loadData(data['data'][0])
    })
    
    function loadData(data) {
        document.getElementById('room_name').value = data['room_name']
        document.getElementById('description').value = data['description']
        $('input[name="status-radio"][value="'+data['status']+'"]').prop('checked', true)
    }


    function update(){
        const data = {
            room_name : document.getElementById('room_name').value,
            description: document.getElementById('description').value,
            status :   $('input[type="radio"][name="status-radio"]:checked').val()
        }
        console.log(data)
        return false
    }
</script>
