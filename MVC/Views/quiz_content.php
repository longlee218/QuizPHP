<?php require_once './MVC/Views/inc/master.php' ?>
<style>

    .project-tab #tabs{
        background: #007b5e;
        color: #eee;
    }
    .project-tab #tabs h6.section-title{
        color: #eee;
    }
    .project-tab #tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: black;
        background-color: transparent;
        border-color: transparent transparent #f3f3f3;
        border-bottom: 3px solid !important;
        font-size: 15px;
        font-weight: bold;
    }
    .project-tab .nav-tabs .nav-item:hover{
        border: none;
    }
    .project-tab .nav-link {
        border: 1px solid transparent;
        border-top-left-radius: .25rem;
        border-top-right-radius: .25rem;
        font-size: 15px;
        color: #817c7c;
        font-weight: 600;
    }
</style>
<form id="form_quiz" enctype="multipart/form-data">
    <div class="row mt-auto pt-5">
        <div class="col col-6">
            <input class="form-control" id="title_quiz" value="Tiêu đề mặc định" required>
        </div>
        <div class="col col-4"></div>
        <div class="col col-2">
            <button class="btn btn-outline-success float-right" type="submit" id="save_and_exit">Lưu và thoát</button>
        </div>
    </div>
    <hr>
    <form id="content_thread" class="form-setting-quiz">
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-4">
                    <label>Tên môn học</label>
                    <input placeholder="Tên môn học" class="form-control" id="subject">
                </div>
                <div class="col-md-4">
                    <label>Cấp bậc/Trình độ</label>
                    <select type="text" class="form-control" id="grade">
                        <option value="1">Trung học</option>
                        <option value="2">Đại học</option>
                        <option value="3">Doanh nghiệp</option>
                        <option value="4">Khác</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <label for="exampleFormControlTextarea1" class="font-weight-bold">Mô tả <small class="text-secondary">(có thể bỏ qua)</small></label>
                    <textarea class="form-control" id="description_quiz" rows="3"></textarea>
                </div>
            </div>
        </div>
    </form>
    <br>
    <div>
        <div class="form_question" id="form_question"></div>
        <br>
    </div>
</form>
<hr>
<div class="text-center " style="margin-bottom: 50px; margin-top: 70px;">
    <h4 class="align-content-center">Thêm câu hỏi</h4>
    <button class="btn btn-lg btn-outline-danger" id="add_question">Thêm câu hỏi</button>
</div>
<script>
    function getDetail() {
        const segment_str = window.location.pathname;
        const segment_array = segment_str.split( '/' );
        segment_array.splice(0,4);
        return segment_array;
    }
    const id_quiz =  getDetail()[0];
    //
    // $(document).ready(function () {
    //     $("#content_thread").hide();
    //     $("#quiz_setting_switch").change(function () {
    //         if (this.checked){
    //             $("#content_thread").fadeIn();
    //         }else{
    //             $("#content_thread").fadeOut();
    //         }
    //     })
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
            $.each(data['data'], function (i, room) {
                $('#room_list').append($('<option>', {
                    value: room['id'],
                    text: room['room_name']
                }));
            })
        }
    })
    // this function copy
    const qtnList = document.getElementById("form_question");
    const addQtnBtn = document.getElementById("add_question");
    const delQtnBtn = document.querySelector(".remove_question");

    addQtnBtn.addEventListener("click", () => {

        let qtnId = 1;
        if (qtnList.lastChild !== null) {
            qtnId = parseInt(qtnList.lastChild.id) + 1;
        }
        console.log(qtnId);
        const qtnForm = document.createElement("div");
        qtnForm.setAttribute("class", "qtn-form");
        qtnForm.setAttribute("id", `${qtnId}`)
        const qtnFormContent = `
                        <div class="row">
                            <div class="col-xl-1 qs_label">
                                    <label for="question_title" class="font-weight-bold" name="label-question">Câu ${qtnId}</label>
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
                            <input class="mt-3" type="file" name="photo" onclick="previewImg(this)" accept=".gif, .png, .jpg, .jpeg"/>
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <a href="javascript:void(0)" class="remove_question"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
                            </div>
                            <div class="row mt-3">
<!--                                <a href="javascript:void(0);" class="#"><i class="fa fa-save fa-2x" aria-hidden="true"></i></a>-->
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
        // console.log(target);
        const targetClass = target.className;
        // console.log(targetClass);
        if (targetClass === null) return;

        if (targetClass === "fa fa-trash fa-2x") {
            deleteQuestion(target);
        }
        if (targetClass === "add_selector btn btn-outline-primary") {
            addAnswer(target);
        }
        if (targetClass === "fa fa-times fa-2x") {
            // console.log('hi');
            deleteAnswer(target);
        }
    })

    const deleteQuestion = (target) => {
        const currentQtn = target.parentNode.parentNode.parentNode.parentNode.parentNode;
        let lastQtn = qtnList.lastChild;

        while (lastQtn !== currentQtn) {
            const prevQtn = lastQtn.previousSibling;
            lastQtn.setAttribute("id", `${prevQtn.id}`);
            lastQtn.querySelector(".font-weight-bold").textContent = "Câu "+String(parseInt(prevQtn.id));
            lastQtn = prevQtn;
        }
        qtnList.removeChild(currentQtn);
    }

    const addAnswer = (target) => {
        const currentQtn = target.parentNode.parentNode;
        const ansList = currentQtn.querySelector(".question_wrapper");
        console.log(ansList);
        if (ansList.childElementCount < 26) {
            let ansId = "A";
            if (ansList.lastChild !== null) {
                ansId = nextChar(ansList.lastChild.id); //Khi vượt quá "z", hàm này sẽ trả về "{", "}"...
            }
            const ansForm = document.createElement("div");
            ansForm.setAttribute("class", "test");
            // console.log();
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
        $('#save_and_exit').click(function (e) {
            e.preventDefault()
            const quiz = new FormData();
            const subject = $('#subject').val()
            const grade = $('#grade').val()
            const title = $('#title_quiz').val()
            const form_question = $('#form_question')
            const description_thread = $('#description_quiz').val()
            const question_data = [];
            form_question.each(function () {
                $(this).find('.qtn-form').each(function (index) {
                    const single_question = {};
                    single_question['explain'] = $(this).find('.row .qs #exp').val();
                    single_question['src'] = $(this).find('.row .picture img').attr('src');
                    quiz.append(index, $(this).find('.row .picture input[name="photo"]')[0].files[0]);
                    single_question['image_name'] =
                        single_question['description'] = $(this).find('.row .qs #question_title').val();
                    const choice_group = $(this).find('.row .qs .form-group .question_wrapper');
                    const choice_data = [];
                    choice_group.find('.test').each(function () {
                        const single_choice = {};
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
            quiz.append('id', id_quiz);
            quiz.append('subject', subject);
            quiz.append('grade', grade);
            quiz.append('title', title);
            quiz.append('description_thread', description_thread);
            quiz.append('questions', JSON.stringify(question_data));
            $.ajax({
                type: 'POST',
                url: '/../QuizSys/APIThread/updateQuiz',
                headers:{
                    'Authorization': getCookie('Authorization')
                },
                data: quiz,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data['success'] === true){
                        // $.ajax({
                        //     type : 'POST',
                        //     url: '/../QuizSys/APIThread/updateQuiz',
                        //     data: quiz,
                        //     processData: false,
                        //     contentType: false,
                        //     success: function (data) {
                        //         if (data['success'] === true){
                        //             alert('Cập nhật thành công');
                        //             window.location.href = "/../QuizSys/QuizPage/listQuiz";
                        //         }else{
                        //             console.log(data);
                        //             alert(data['mess'])
                        //         }
                        //     },
                        //     error: function (xhr, error) {
                        //         console.log(xhr, error);
                        //     }
                        // })
                        alert('Bộ đề đã được cập nhật thành công')
                        window.location.replace('/../QuizSys/Home/InstructorHome?tab=nav-store-quiz')
                    }else{
                        switch (data['mess']) {
                            case "Can't not submit because don't have any question":
                                alert("Đề chưa có câu hỏi. Bạn không thể lưu được")
                                break
                            case "Require title or Room ID":
                                alert("Hãy chọn tiêu đề cho bộ đề và lựa chọn phòng bạn muốn lưu")
                                break
                            case "Need more than 1 selection":
                                alert("Cần nhiều hơn 1 đáp án")
                                break
                            case "Question can't wrong all or correct all":
                                alert("Cần ít nhất 1 câu sai trong từng câu hỏi")
                                break
                            case "Please fill the content of question":
                                alert("Vui lòng điền nội dung câu hỏi")
                                break
                            case "'Please fill the content of answer":
                                alert("Vui lòng nhập nội dung câu trả lời")
                                break
                        }
                    }
                },
                error: function (xhr, error) {
                    console.log(xhr, error)
                }
            })
        })
    });
    $(document).ready(function () {
        $.ajax({
            method: 'GET',
            url: '/../QuizSys/APIThread/queryQuizDetail/'+id_quiz,
            headers: {
                'Content-type': 'application/json',
                'Authorization': getCookie('Authorization')
            },
            success: function (data_return) {
                const data = data_return['data']
                console.log(data);
                $('#title_quiz').val(data['title']);
                $('#subject').val(data['subject']);
                $('#grade').val(data['grade']);
                $('#description_quiz').val(data['description'])
                $.each(data['questions'], function (index, value) {
                    const qtnForm = document.createElement("div");
                    qtnForm.setAttribute("class", "qtn-form");
                    qtnForm.setAttribute("id", `${index+1}`);
                    qtnForm.setAttribute('name', `${value['id']}`)
                    const qtnFormContent = `
                        <div class="row">
                            <div class="col-xl-1 qs_label">
                                    <label for="question_title" class="font-weight-bold" name="label-question">Câu ${index + 1}</label>
                            </div>
                            <div class="col-8 qs">
                               <div class="form-row">
                                    <input type="text" id="question_title" name="question_title" placeholder="Nhập tiêu đề cho câu hỏi ?" class="form-control font-weight-bold"
                                                   value="${value['description']}">
                                </div>
                               <div class="form-group">
                                     <div class="question_wrapper" id="all_answer"></div>
                                </div>
                               <div class="form-group">
                                    <button class="add_selector btn btn-outline-primary" type="button">&#43</button>
                                </div>
                                <div class="explain form-group">
                                    <input type="text" class="question_explain form-control font-weight-bold" id="exp"
                                           placeholder="Thêm câu giải thích" value="${value['explain']}">
                                </div>
                            </div>
                        <div class="col col-2 picture">
                            <div class="image-preview" name="inpFile">
                                <img src="${value['image']}" alt="Image preview" height="150" width="150" onclick="removeImg(this)" ">
                            </div>
                            <input class="mt-3" type="file" name="photo" id="${index}" accept=".gif, .png, .jpg, .jpeg" >
                        </div>
                        <div class="col-1">
                            <div class="row">
                                <a href="javascript:void(0)" class="remove_question"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a>
                            </div>
                            <div class="row mt-3">
<!--                                <a href="javascript:void(0);" class="#" onclick=""><i class="fa fa-save fa-2x" aria-hidden="true"></i></a>-->
                            </div>
                        </div>
                        <div class="end-question">

                        </div>
                    </div>
<hr>
        `;
                    qtnForm.innerHTML = qtnFormContent;
                    qtnList.appendChild(qtnForm);
                    $.each(value['choices'], function (index2, value_choice){
                        const ansForm = document.createElement("div");
                        ansForm.setAttribute("class", "test");
                        ansForm.setAttribute("id", `${value_choice['choice_name']}`)
                        const ansFormContent = `
                            <br>
                           <div class="row ml-2">
                           <label for="slt" style="font-size: 20px" class="incr2 font-weight-bold">${value_choice['choice_name']}</label>
                           <input type="checkbox" class="qs_correct inline ml-2" name="correct">
                            <div class="col-9">
                                <input type="text" id="slt" name="question" placeholder="Câu trả lời..." class="question_selector inline sel_data form-control"
                                        value="${value_choice['choice_content']}">
                            </div>
                            <div class="col col-1">
                                <a href="javascript:void(0);" class="remove_button">
                                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>

                    `;
                        ansForm.innerHTML = ansFormContent;
                        if (value_choice['correct'] === '1'){
                            ansForm.querySelector(".row input[name='correct']").checked = true;
                        }
                        qtnForm.querySelector(".row .qs .question_wrapper").appendChild(ansForm);
                    })

                })
            }
        })
    })
    function removeImg(e) {
        const img_default = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAACWCAYAAAA8AXHiAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsIAAA7CARUoSoAAAALiSURBVHhe7d3BThtHAIBht4gDB16ikZJbyfs/RUh6Ts69VCqcEZWVRbEiQhzY32Vnvk9CzIKEsOZndsyu7N/+/uff+x2s7PflM6xKWCSERUJYJIRFQlgkhEVCWCSERUJYJIRFQlgkhEVCWCSERUJYJIRFQlgkhEVCWCSERUJYJIRFQlgkhEVCWCSERUJYJIRFQlgkhEVCWCSERUJYJIRFQlgkhEVCWCSERUJYJIRFQlgkhEVCWCSERUJYJIRFQlgkhEVCWCSERUJYJIZ7s/Evnz/vbm5ulqPtePvu3e7i4mI52r5hwrr+8GEZbdvl5eXujzdvlqPtGuJUOEpUe7e3t8to2+yxXqER/lCGOBUeTsTV+/fLaFs+Xl/v7u+/TcVWH8eDza9Yd3d3y2jb/ry6WkZjcCokISwS04S134c99kFjirCeCkhcjeHDOiYcca3PHouEsFZk5ftGWCt5iEpcXwlrBd/HJC5hvdiPIpo9ruHDOuaa23Ovy/0snpnjmmLFeiqcKqoHs8a1+bsb9heh//r0aTk6zV0Bz4nlmN/r8Oee4nGU7LF+0XNXoNlWLmH9gpfGMVNcwjrSWlHMEtf0YR0z0WvHMENcU4f1MMFPTXQVwehxTRvW9xP72ESPPvmlKcP6UTCHXxfVy0wX1s+C2X9fVC83VViCOZ1pwhLVaU0RlqhOb/iwRPX/mG7zzmkIi4SwSAiLhLBIuIP0FTl8BusOUniEsEhsPqyzs7Nl9NXhyy1uyWj/yB3uNUhHYY/F6rYe1d4QYe0n4vz8fDnathGi2hvmnSl4XZwKSQiLhLBICIuEsEgIi4SwSAiLhLBICIuEsEgIi4SwSAiLhLBICIuEsEgIi4SwSAiLhLBICIuEsEgIi4SwSAiLhLBICIuEsEgIi4SwSAiLhLBICIuEsEgIi4SwSAiLhLBICIuEsEgIi4SwSAiLhLBICIuEsEgIi4SwSAiLhLBICIuEsAjsdv8B1ZDQyfvNmO8AAAAASUVORK5CYII=';
        if ($(e).attr('src') !== img_default){
            const confirm_remove = confirm('Bạn muốn xóa ảnh này ?');
            if ( confirm_remove === true){
                $(e).attr('src', img_default);
            }
        }
    }
</script>
