<?php require_once './MVC/Views/navbar.php'?>
<style>
    #title_quiz{
        height: 40px;
        width: 400px;
        font-size: 20pt;
        text-transform: uppercase;
        padding: 20px 5px;
    }
    .image-preview{
        width: 150px;
        min-height: 150px;
        border: 2px solid #dddddd;
        margin-top: 15px;
        display: flex;
        align-content: center;
        justify-content: center;
        font-weight: bold;
        color: #cccccc;
    }
    .image-preview__image{
        display: none;
        width: 100%;

    }

    .qs_correct{
        width: 25px;
        height: 30px;
    }
    label {
        cursor: pointer;
    }
    .form-setting-quiz{
        border: solid;
        border-width: 0 2px;
    }
</style>
<div class="container" id="main-content">
    <form id="form_quiz"  enctype="multipart/form-data">
        <div class="row mt-auto pt-5">
            <div class="col col-6">
                <div class="form-row">
                    <input class="form-control" id="title_quiz" value="Tiêu đề mặc định" required>
                </div>
            </div>
            <div class="col col-5"></div>
            <div class="col-1 form-group">
                <button class="btn btn-outline-success" type="submit" id="save_and_exit">Lưu và thoát</button>
            </div>
        </div>
        <hr>
<!--           <div class="form-row">-->
<!--             <div class="col col-xs-3 col-md-6">-->
<!--                 <label class="switch">-->
<!--                     <input id="quiz_setting_switch" name="setting_quiz" type="checkbox">-->
<!--                     <span class="slider round"></span>-->
<!--                 </label>-->
<!--                 <div class="ml-2 text-dark font-weight-bold">Tùy chỉnh cài đặt bộ đề</div>-->
<!--             </div>-->
<!--               <div class="col col-xs-3 col-md-6 text-right">-->
<!--                   <label class="switch">-->
<!--                       <input id="sharing_room" name="sharing_room" type="checkbox">-->
<!--                       <span class="slider round"></span>-->
<!--                   </label>-->
<!--                   <div class="ml-2 text-dark font-weight-bold">Phòng muốn share</div>-->
<!--               </div>-->
<!--           </div>-->
            <form id="content_thread" class="form-setting-quiz">
                   <div class="form-group">
                       <div class="form-row">
                           <div class="col-md-4">
                               <label class="font-weight-bold">Tên môn học</label>
                               <input placeholder="Tên môn học" class="form-control" id="subject" required>
                           </div>
                           <div class="col-md-4">
                               <label class="font-weight-bold">Cấp bậc/Trình độ</label>
                               <select type="text" class="form-control" id="grade">
                                   <option selected value="1">Trung học</option>
                                   <option value="2">Đại học</option>
                                   <option value="3">Doanh nghiệp</option>
                                   <option value="4">Khác</option>
                               </select>
                           </div>
                           <div class="col-md-4">

                           </div>
                       </div>
                   </div>
                <div class="form-group">
                    <div class="form-row">
                       <div class="col">
                           <label for="exampleFormControlTextarea1" class="font-weight-bold">Mô tả <small class="text-secondary">(có thể bỏ qua)</small></label>
                           <textarea class="form-control" id="description_quiz" rows="3"></textarea>
                       </div>
                    </div>
                </div>
<!--                    <div class="form-group">-->
<!--                        <label>Cấp bậc/Trình độ</label>-->
<!--                        <select type="text" class="form-control" id="grade">-->
<!--                            <option selected value="1">Trung học</option>-->
<!--                            <option value="2">Đại học</option>-->
<!--                            <option value="3">Doanh nghiệp</option>-->
<!--                            <option value="4">Khác</option>-->
<!--                        </select>-->
<!--                    </div>-->
            </form>
<!--        <div id="list_room">-->
<!--            <br>-->
<!--            <div class="form-group">-->
<!--                <label>Danh sách các phòng</label>-->
<!--                <select type="text" class="form-control" id="room_list"></select>-->
<!--            </div>-->
<!--        </div>-->
<!--        <hr>-->
        <br>

        <div>
            <div class="form_question" id="form_question"></div>
            <br>
        </div>
    </form>
    <hr>
    <div class="text-center " style="margin-bottom: 50px; margin-top: 70px;">
        <h4 class="align-content-center">Thêm câu hỏi</h4>
        <button class="btn btn-outline-danger" id="add_question">Thêm câu hỏi</button>
    </div>
</div>
<script>
    // $(document).ready(function () {
    //    $("#content_thread").hide();
    //    $("#quiz_setting_switch").change(function () {
    //        if (this.checked){
    //           $("#content_thread").fadeIn();
    //        }else{
    //            $("#content_thread").fadeOut();
    //        }
    //    })
    // });
    // $(document).ready(function () {
    //     $("#list_room").hide();
    //     $("#sharing_room").change(function () {
    //         if (this.checked){
    //             $("#list_room").fadeIn();
    //         }else{
    //             $("#list_room").fadeOut();
    //         }
    //     })
    // });
    $.ajax({
        type: 'GET',
        url: "/../QuizSys/APIRoom/queryRoom/"+return_first,
        headers:{
            'Content-type': 'application/json',
            'Authorization': getCookie('Authorization')
        },
        success: function (data) {
            console.log(data);
            $.each(data['data'], function (i, room) {
                console.log(i);
                console.log(room['room_name']);
                $('#room_list').append($('<option>', {
                    value: room['id'],
                    text: room['room_name']
                }));
            })
        }
    })
    const qtnList = document.getElementById("form_question");
    const addQtnBtn = document.getElementById("add_question");
    const delQtnBtn = document.querySelector(".remove_question");

    addQtnBtn.addEventListener("click", () => {

        let qtnId = 0;

        if (qtnList.lastChild !== null) {
            qtnId = parseInt(qtnList.lastChild.id) + 1;
        }
        console.log(qtnId);
        const qtnForm = document.createElement("div");
        qtnForm.setAttribute("class", "qtn-form");
        qtnForm.setAttribute("id", String(qtnId));
        const qtnFormContent = `
                        <div class="row">
                            <div class="col-xl-1 qs_label">
                                    <label for="question_title" class="font-weight-bold" name="label-question">Câu ${qtnId + 1}</label>
                            </div>
                            <div class="col-8 qs">
                               <div class="form-row">
                                    <input type="text" id="question_title" name="question_title" placeholder="Nhập tiêu đề cho câu hỏi ?" class="form-control font-weight-bold">
                                </div>
                               <div class="form-group">
                                     <div class="question_wrapper" id="all_answer"></div>
                                </div>
                               <div class="form-group">
                                    <button class="add_selector btn btn-outline-primary" type="button">&#43</button>
                                </div>
                                <div class="explain form-group">
                                    <input type="text" class="question_explain form-control font-weight-bold" id="exp"
                                           placeholder="Thêm câu giải thích">
                                </div>
                            </div>
                        <div class="col col-2 picture">
                            <div class="image-preview" name="inpFile">
<!--                                    <div class="square"></div>-->
                                <img src="" alt="Image preview" class="image-preview__image" >
                            </div>
                            <input class="mt-2" type="file" name="photo" accept="image/gif, imgage/png, image/jpg, image/jpeg"/>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <a href="javascript:void(0)" class="remove_question"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
                            </div>
                            <div class="row mt-3">
                                <a href="javascript:void(0);" class="#"><i class="fa fa-save fa-2x" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="end-question"></div>
                    </div>
<hr>
        `;
        qtnForm.innerHTML = qtnFormContent;
        qtnList.appendChild(qtnForm);

    })
    qtnList.addEventListener("click", (event) => {
        const target = event.target;
        const targetClass = target.className;
        if (targetClass === null) return;

        if (targetClass === "fa fa-trash fa-2x") {
            deleteQuestion(target);
        }
        if (targetClass === "add_selector btn btn-outline-primary") {
            addAnswer(target);
        }
        if (targetClass === "fa fa-times fa-2x") {
            deleteAnswer(target);

        }
    })

    const deleteQuestion = (target) => {
        const currentQtn = target.parentNode.parentNode.parentNode.parentNode.parentNode;
        let lastQtn = qtnList.lastChild;
        while (lastQtn !== currentQtn) {
            const prevQtn = lastQtn.previousSibling;
            lastQtn.setAttribute("id", String(prevQtn.id));
            lastQtn.querySelector(".font-weight-bold").textContent = "Câu "+String(parseInt(prevQtn.id)+1);
            lastQtn = prevQtn;
        }
        qtnList.removeChild(currentQtn);
    }

    const addAnswer = (target) => {
        const currentQtn = target.parentNode.parentNode;
        const ansList = currentQtn.querySelector(".question_wrapper");
        if (ansList.childElementCount < 26) {
            let ansId = "A";
            if (ansList.lastChild !== null) {
                ansId = nextChar(ansList.lastChild.id); //Khi vượt quá "z", hàm này sẽ trả về "{", "}"...
            }
            const ansForm = document.createElement("div");
            ansForm.setAttribute("class", "test");
            ansForm.setAttribute("id", `${ansId}`)
            const ansFormContent = `
                <br>
               <div class="row ml-2">
               <label for="slt" style="font-size: 20px" class="incr2 font-weight-bold">${ansId}</label>
               <input type="checkbox" class="qs_correct inline ml-2" name="correct">
                <div class="col-9">
                    <input type="text" id="slt" name="question" placeholder="Câu trả lời..." class="question_selector inline sel_data form-control">
                </div>
                <div class="col col-1">
                    <a href="javascript:void(0);" class="remove_button">
                        <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

        `;
            ansForm.innerHTML = ansFormContent;
            ansList.appendChild(ansForm);
        }

    }

    const deleteAnswer = (target) => {
        const currentAns = target.parentNode.parentNode.parentNode.parentNode;
        const ansList = currentAns.parentNode;
        let lastAns = ansList.lastChild;
        while (lastAns !== currentAns) {
            const prevAns = lastAns.previousSibling;
            lastAns.setAttribute("id", `${prevAns.id}`);
            lastAns.querySelector(".incr2").textContent = `${prevAns.id}`;
            lastAns = prevAns;
        }
        ansList.removeChild(currentAns);
    }

    /** ------------------------------------------------------- */
    const nextChar = (c) => {
        return String.fromCharCode(c.charCodeAt(0) + 1).toUpperCase();
    }

    $(document).ready(function () {
        $('#save_and_exit').on("click", function (e) {
            e.preventDefault()
            const quiz = new FormData();
            const subject = $('#subject').val();
            const grade = $('#grade').val();
            const title = $('#title_quiz').val();
            const description_thread = $('#description_quiz').val();
            const form_question = $('#form_question');
            const question_data = [];
            form_question.each(function () {
                $(this).find('.qtn-form').each(function (index) {
                    var single_question = {};
                    single_question['explain'] = $(this).find('.row .qs #exp').val();
                    quiz.append(index, $(this).find('.row .picture input[name="photo"]')[0].files[0])
                    single_question['description'] = $(this).find('.row .qs #question_title').val();
                    var choice_group = $(this).find('.row .qs .form-group .question_wrapper');
                    var choice_data = [];
                    choice_group.find('.test').each(function () {
                        var single_choice = {};
                        single_choice['choice_name'] = $(this).attr('id');
                        single_choice['choice_content'] = $(this).find('.row .col-9 input[name="question"]').val();
                        single_choice['correct'] = '0';
                        if ($(this).find('.row input[name="correct"]').is(':checked')){
                            single_choice['correct'] = '1';
                        }
                        choice_data.push(single_choice);
                    })
                    single_question['choices'] = choice_data;
                    question_data.push(single_question);
                })
            })
            quiz.append('subject', subject);
            quiz.append('grade', grade);
            quiz.append('title', title);
            quiz.append('description_thread', description_thread);
            quiz.append('questions', JSON.stringify(question_data));

            //new AJAX request
            $.ajax({
                type : 'POST',
                url: '/../QuizSys/APIThread/createQuiz',
                headers: {
                    'Authorization': getCookie('Authorization')
                },
                data: quiz,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data['success'] === true){
                        alert('Bộ đề đã được lưu');
                        window.location.replace('/../QuizSys/Home/InstructorHome?tab=nav-store-quiz');

                    }else{
                        switch (data['mess']) {
                            case "Can't not submit because don't have any question":
                                alert("Đề chưa có câu hỏi. Bạn không thể lưu được");
                                break;
                            case "Require title or Room ID":
                                alert("Hãy chọn tiêu đề cho bộ đề và lựa chọn phòng bạn muốn lưu");
                                break;
                            case "Need more than 1 selection":
                                alert("Cần nhiều hơn 1 đáp án");
                                break;
                            case "Question can't wrong all or correct all":
                                alert("Cần ít nhất 1 câu sai trong từng câu hỏi");
                                break;
                            case "Please fill the content of question":
                                alert("Vui lòng điền nội dung câu hỏi");
                                break;
                            case "Please fill the content of answer":
                                alert("Vui lòng nhập nội dung câu trả lời");
                                break;
                        }
                    }
                },
                error: function (xhr, error) {
                    console.log(xhr, error);
                }
            })

            // old AJAX request
            //       $.ajax({
            //           type: 'POST',
            //           url: '/../QuizSys/APIThread/checkValidateQuiz',
            //           data: quiz,
            //           processData: false,
            //           contentType: false,
            //           success: function (data) {
            //               if (data['success'] === true){
            //                   $.ajax({
            //                       type : 'POST',
            //                       url: '/../QuizSys/APIThread/createQuiz',
            //                       data: quiz,
            //                       processData: false,
            //                       contentType: false,
            //                       success: function (data) {
            //                           if (data['success'] === true){
            //                               alert('Bộ đề đã được lưu');
            //                               window.location.href = '/../QuizSys/QuizPage/listQuiz';
            //                           }else{
            //                               console.log(data);
            //                           }
            //                       },
            //                       error: function (xhr, error) {
            //                           console.log(xhr, error);
            //                       }
            //                   })
            //               }else{
            //                   switch (data['mess']) {
            //                     case "Can't not submit because don't have any question":
            //                         alert("Đề chưa có câu hỏi. Bạn không thể lưu được");
            //                         break;
            //                     case "Require title or Room ID":
            //                         alert("Hãy chọn tiêu đề cho bộ đề và lựa chọn phòng bạn muốn lưu");
            //                         break;
            //                      case "Need more than 1 selection":
            //                          alert("Cần nhiều hơn 1 đáp án");
            //                          break;
            //                       case "Question can't wrong all or correct all":
            //                           alert("Cần ít nhất 1 câu sai trong từng câu hỏi");
            //                           break;
            //                       case "Please fill the content of question":
            //                           alert("Vui lòng điền nội dung câu hỏi");
            //                           break;
            //                       case "Please fill the content of answer":
            //                           alert("Vui lòng nhập nội dung câu trả lời");
            //                           break;
            //                   }
            //               }
            //           },
            //           error: function (xhr, error) {
            //               console.log(xhr, error);
            //           }
            //       })
        })
    })
    function previewImg(e) {
        e.addEventListener("change", function () {
            const file = e.files[0];
            var previewImg = $(e.parentNode).find('.image-preview .image-preview__image');
            console.log(previewImg);
            if (file){
                const reader = new FileReader();
                previewImg.style = 'block';
                reader.addEventListener('load', function () {
                    previewImg.attr('src', this.result);
                });
                reader.readAsDataURL(file);
            }
        })

    }

</script>