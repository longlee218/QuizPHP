<?php require_once './MVC/Views/navbar.php'?>
<style>
    #title_quiz{
        height: 50px;
        width: 500px;
        font-size: 24pt;
        text-transform: uppercase;
    }
    .square {
        height: 150px;
        width: 150px;
        background-color: #555;
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
                <button class="btn btn-outline-primary btn-lg" type="button" id="save_and_exit">Lưu và thoát</button>
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
                       <input placeholder="Tên môn học" class="form-control" id="subject">
                   </div>
                    <div class="form-group">
                        <label>Cấp bậc/Trình độ</label>
                        <select type="text" class="form-control" id="grade">
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
    });

    // this function copy
    const qtnList = document.getElementById("form_question");
    const addQtnBtn = document.getElementById("add_question");
    const delQtnBtn = document.querySelector(".remove_question");

    addQtnBtn.addEventListener("click", () => {

        let qtnId = 0;

        if (qtnList.lastChild !== null) {
            qtnId = parseInt(qtnList.lastChild.id) + 1;
        }

        const qtnForm = document.createElement("div");
        qtnForm.setAttribute("class", "qtn-form");
        qtnForm.setAttribute("id", `${qtnId}`)
        const qtnFormContent = `
                        <div class="row">
                        <div class="col-xl-1 qs_label">
                                <label for="question_title" class="font-weight-bold" name="label-question">Câu ${qtnId + 1}</label>
                        </div>
                        <div class="col-7 qs">
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
                        <div class="col col-2">
                            <div class="square"></div>
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
        console.log(target);
        const targetClass = target.className;
        console.log(targetClass);
        if (targetClass === null) return;

        if (targetClass === "fa fa-trash fa-2x") {
            deleteQuestion(target);
        }
        if (targetClass === "add_selector btn btn-outline-primary") {
            addAnswer(target);
        }
        if (targetClass === "fas fa-minus inline faw") {
            console.log('hi');
            deleteAnswer(target);
        }
    })

    const deleteQuestion = (target) => {
        const currentQtn = target.parentNode.parentNode.parentNode.parentNode.parentNode;
        console.log(currentQtn);
        let lastQtn = qtnList.lastChild;

        while (lastQtn !== currentQtn) {
            const prevQtn = lastQtn.previousSibling;
            lastQtn.setAttribute("id", `${prevQtn.id}`);
            lastQtn.querySelector(".incr").textContent = `${parseInt(prevQtn.id) + 1}`;
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
              <div class="form-row">
                <label for="slt" class="incr2 font-weight-bold">${ansId}</label>
                <div class="col col-8">
                    <input type="checkbox" class="qs_correct inline">
                    <input type="text" id="slt" name="question" placeholder="Câu trả lời..." class="question_selector inline sel_data form-control">
                </div>
                <div class="col col-3">
                    <a href="javascript:void(0);" class="remove_button">
                        <i class="fas fa-minus inline faw"></i>
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
        console.log(currentAns)
        const ansList = currentAns.parentNode;
        console.log(ansList);
        let lastAns = ansList.lastChild;
        console.log(lastAns);
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
          e.preventDefault();
          var subject = $('#content_thread #subject').val();
          var grade = $('#content_thread #grade').val();
          var title = $('#title_quiz').val();
          var form_question = $('#form_question');
          var question_data = [];
          var choice_data = [];
          var quiz = {};
          quiz = {
              subject: subject,
              grade: grade,
              title: title,
              questions: question_data,
          }
          form_question.each(function () {
              // console.log($(this).find('.qtn-form .row .qs-label label[name="label-question"]').text());
              // question_data[$(this).find('.qtn-form .row .qs-label .font-weight-bold').text().split(" ")[1]] = $(this).find('.qtn-form .row .qs .form-row #question_title').val();
              $(this).find('.qtn-form').each(function () {
                    question_data.push($(this).find('.row .qs #question_title').val());

              })
          })
          console.log(question_data);
      })

    })
</script>