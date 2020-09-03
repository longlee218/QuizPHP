<?php require_once './MVC/Views/navbar.php'?>
<style>
    #title_quiz{
        height: 50px;
        width: 500px;
        font-size: 24pt;
        text-transform: uppercase;
    }
</style>
<div class="container" id="main-content">
    <form id="form_quiz">
        <div class="row mt-auto mt-5 pt-5">
            <div class="col-6">
                <div class="form-row">
                    <input class="form-control" id="title_quiz" value="Tiêu đề mặc định">
                </div>
            </div>
            <div class="col col-4"></div>
            <div class="col-2 form-group">
                <button class="btn btn-outline-primary btn-lg" type="submit">Lưu và thoát</button>
            </div>
        </div>
        <hr>
           <div class="form-row">
               <label class="switch">
                   <input id="quiz_setting_switch" name="setting_quiz" type="checkbox">
                   <span class="slider round"></span>
               </label>
               <div class="ml-2 text-dark font-weight-bold">Tùy chỉnh cài đặt bộ đề</div>
           </div>
            <div id="content_thread">
                <br>
                   <div class="form-group">
                       <label>Tên môn học</label>
                       <input placeholder="Tên môn học" class="form-control">
                   </div>
                    <div class="form-group">
                        <label>Cấp bậc/Trình độ</label>
                        <select type="text" class="form-control" id="organization_type">
                            <option selected value="1">Trung học</option>
                            <option value="2">Đại học</option>
                            <option value="3">Doanh nghiệp</option>
                            <option value="4">Khác</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-outline-primary">Lưu</button>
                        <button class="btn btn-light" onclick="$('#content_thread').hide()">Hủy</button>
                    </div>
            </div>
        <hr>
        <div id="content">

        </div>
    </form>
    <hr>
    <div class="text-center " style="margin-bottom: 50px; margin-top: 70px;">
        <h4 class="align-content-center">Thêm câu hỏi</h4>
        <button class="btn btn-lg btn-outline-danger" onclick="">Thêm câu hỏi True/False</button>
        <button class="btn btn-lg btn-outline-warning">Thêm câu hỏi lựa chọn</button>
    </div>
</div>
<?php require_once './MVC/Views/footer.php' ?>
<script>
    $(document).ready(function () {
       $("#content_thread").hide();
       $("#quiz_setting_switch").change(function () {
           if (this.checked){
              $("#content_thread").fadeIn();
           }else{
               $("#content_thread").fadeOut();
           }
       })
    })

    function addQuestionTrueFalse() {

    }
</script>