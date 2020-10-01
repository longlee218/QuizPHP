<?php include_once './MVC/Views/navbar_student.php'?>

<style>
    .quiz-box{
        background-color: #ffffff;
        margin: 40px auto;
        padding: 20px;
        border-radius: 15px;
        border-style: solid;

    }

    .quiz-box .quiz-number{
        font-size: 30px;
        font-weight: 500;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

    .quiz-box .question-text{
        font-size: 22px;
        color: black;
        line-height: 25px;
        margin: 20px 0 30px 0;
        /*margin-bottom: 100px;*/

    }
    .quiz-box .option-container .option{
        margin: 10px 0;
        border-radius: 16px;
        border-style: solid;
        background-color: #ffffff;
        font-size: 16px;
        display: block;
        padding-top: 5px;


    }
    .quiz-box img{
        border-radius: 20px;
        margin: 15px 0;
        border: 5px black;
        max-width: 200px;
        max-height: 300px;

        /*border-color: black;*/

    }
    .quiz-box .option-container .option .form-row{
        margin-top: 5px;
        margin-left: 10px;
    }
    .quiz-box .option-container .option .choice-name{
        font-size: 18px;
        font-weight: 500;
        margin-right: 20px;
        margin-left: 5px;

    }
    .quiz-box .option-container .selected{
        background-color:  rgb(119, 170, 209);
        color: white;
        border-style: solid;
        border-color: white;
    }
    .button-submit{
        margin-top: 20px;

    }
    .btn{
        width: 150px;
        height: 50px;
        padding: 5px;
        font-size: 20px;
    }
    .paginator{
        margin-bottom: 20px;
    }
    .pagination{
        margin: auto;
        width: 10%;
    }

    .disabled{
        display: none;
    }
    .count-down{
        float: right;
        position: relative;
        font-size: large;
    }
</style>

<body>
    <div class="container">
        <div class="button-submit row">
            <button class="btn btn-outline-primary col-2" onclick="submitQuestion()">Nộp bài</button>
            <div class="col col-md-7 col-sm-5"></div>
            <div id="count-down" class="col col-md-3 col-sm-4">Thời gian còn lại:</div>
        </div>
        <div id="form-exam" ></div>
        <hr>
            <div class="paginator">
                <ul class="pagination" id="pagination-wrapper"></ul>
            </div>
    </div>



</body>
<script>

//=========================================================================
    //countdown time
    var string_time = ''
    $.ajax({
        method: 'GET',
        headers:{
            'Authorization': getCookie('Authorization'),
            'Content-type': 'application/json'
        },
        async: false,
        url: '/../QuizSys/APIRoom/getInfoRoom/'+localStorage.getItem('id_room'),
        success: function (data) {
            console.log(data)
            if (data['success'] === true){
                string_time = data['data']['time_end']
            }
        }
    })
    var countDownDate = new Date(string_time).getTime();

    var x = setInterval(() => {

        var now = new Date().getTime();

        var distance = countDownDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("count-down").innerHTML = 'Thời gian còn lại: '
                                                            + hours + " Giờ "
                                                            + minutes + " phút "
                                                            + seconds + " giây ";
        if (distance <= 0) {
            clearInterval(x);
            submitQuiz();
        }
    }, 1000);




    const state  = {
        page: 1,
        rows: 1,
        window: 10,
    }

    function getDetail() {
        const segment_str = window.location.pathname;
        const segment_array = segment_str.split( '/' );
        segment_array.splice(0,4);
        return segment_array;
    }
    var id_quiz =  getDetail()[0];

    $.ajax({
        type: 'GET',
        url: '/../QuizSys/APIThread/queryQuizDetail/'+id_quiz,
        async: false,
        headers: {
            'Content-type': 'application/json',
            'Authorization': getCookie('Authorization')
        },
        success: (data) =>{
            // console.log(data);
            state.querySet = data['questions'];
        },
        error: (xhr, error) => {
            console.log(xhr, error);
        }
    })

    const pagination = (querySet, page, rows) =>{
        var trimStart = (page - 1)*rows
        var trimEnd = trimStart + rows
        var trimData = querySet.slice(trimStart, trimEnd);
        var pages = Math.round(querySet.length/rows);
        return {
            'querySet': trimData,
            'pages': pages,
        }
    }

    const  pageButtons = (pages) => {
        var wrapper = document.getElementById('pagination-wrapper');
        wrapper.innerHTML = ``;
        console.log({'Pages': pages})

        var maxLeft = (state.page - Math.floor(state.window/2))
        var maxRight = (state.page + Math.floor(state.window/2))

        if (maxLeft < 1){
            maxLeft = 1
            maxRight = state.window
        }
        if (maxRight > pages){
            maxLeft = pages - (state.window - 1)
            if (maxLeft < 1){
                maxLeft = 1
            }
            maxRight = pages
        }
        for (var page = maxLeft; page <= maxRight; page++){
            wrapper.innerHTML += `
                <li class="page-item">
                    <button class="page page-link" value=${page}>${page}</button>
                </li>
            `
        }
        if (state.page !== 1){
            wrapper.innerHTML = `
                 <li class="page-item">
                    <button class="page page-link" value=${1}>
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">First</span>
                    </button>
                </li>
            `+wrapper.innerHTML
        }
        if (state.page !== pages){
            wrapper.innerHTML += `
                <li class="page-item">
                    <button class="page page-link" value=${pages}>
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span></button>
                </li>
            `
        }

        $('.page').click(function (e) {
                var previous_form = document.getElementById('form-exam')
                var question_id =  previous_form.querySelector('div .quiz-box').id
                console.log(question_id)
                console.log(previous_form.querySelector('div .quiz-box').getElementsByClassName('selected'))

                var list_choice = previous_form.querySelector('div .quiz-box').getElementsByClassName('selected')

                var single_question = {
                    question_id: question_id,
                    choices: []
                }

                for (let i=0; i < list_choice.length; i++){
                    single_question['choices'].push({
                        choice_id: list_choice[i].id,
                        choice_name: list_choice[i].getElementsByClassName('choice-name')[0].textContent
                    })
                }

                var data = JSON.parse(localStorage.getItem('data'))
                var data_question = data['questions']
                var list_id_question = []
                data_question.forEach(question =>{
                    list_id_question.push(question.question_id)
                })
                if (!list_id_question.includes(single_question.question_id)){
                    data_question.push(single_question)
                }else{
                    console.log(data_question)
                    data_question.forEach(question =>{
                        if (question.question_id === single_question.question_id){
                            question.choices = single_question.choices
                        }
                    })
                }
                data['questions'] = data_question
                localStorage.setItem('data', JSON.stringify(data))
                console.log('Local storage: '+localStorage.getItem('data'))

                $('#form-exam').empty()
                state.page = Number($(this).val())
                buildForm()
        })

    }
    const buildForm = () =>{
        var data = pagination(state.querySet, state.page, state.rows)
        var page_active = document.getElementById('pagination-wrapper')
        console.log(page_active)
        var myData = data.querySet
        for (var i in myData){
            var form_exam = document.getElementById('form-exam')
            form_exam.innerHTML = `
            <div class="quiz-box custom-box" id=${myData[i]['id']} name="quiz-box">
                <div class="quiz-number">
                    <p>${state.page}/${data.pages}</p>
                </div>
                <hr>
            <div class="question-text">
                <p>${myData[i]['description']}</p>
                <div class="img">
                    <img src="${myData[i]['image']}" alt="Image-preview">
                </div>
            </div>
            <div class="option-container" id="all_option"></div>
            <div class="option-container">
                <div class="row"></div>
            </div>
        </div>
            `

            var img = document.getElementsByClassName('img')[0]
            console.log(img)
            if (myData[i]['image'] === null){
                img.className = 'img disabled'
            }
            var choice = form_exam.querySelector("#all_option")
            choice.innerHTML = ``
            myData[i]['choices'].forEach(value => {
                choice.innerHTML += `
                    <div class="option" id=${value['id']} onclick="selectAnswer(this)" name="option">
                        <div class="form-row">
                            <span class="choice-name">${value['choice_name']}</span>
                            <p>${value['choice_content']}</p>
                        </div>
                    </div>
                `
            })

        }
        var question_id = form_exam.querySelector('.quiz-box').id
        var all_option =  form_exam.querySelector('.quiz-box #all_option').getElementsByClassName('option')
        var local_data = JSON.parse(localStorage.getItem('data'))
        var local_question = local_data.questions
        local_question.forEach(question => {
            if (question.question_id === question_id){
                for (let i = 0; i < all_option.length; i++){
                    question.choices.forEach(choice =>{
                        if (choice.choice_id === all_option[i].id){
                            all_option[i].className += ' selected'
                        }
                    })
                }
            }
        })
        pageButtons(data.pages)
    }
    buildForm()

function selectAnswer(e) {
    if (e.className === 'option'){
        e.className += ' selected'
    }else{
        e.className = 'option'
    }
}

function submitQuestion(){
    const data = JSON.parse(localStorage.getItem('data'));
    const local_question = data['questions'];
    const array_question_empty = [];

    const form_exam = document.getElementById('form-exam');
    const question_id = form_exam.querySelector('div .quiz-box').id;
    const list_choice = form_exam.querySelector('div .quiz-box').getElementsByClassName('selected');
    console.log(list_choice)
    const single_question = {
        question_id: question_id,
        choices: []
    };
    for (let i=0; i < list_choice.length; i++){
        single_question['choices'].push({
            choice_id: list_choice[i].id,
            choice_name: list_choice[i].getElementsByClassName('choice-name')[0].textContent
        })
    }
    var array_id = [];
    local_question.forEach(question =>{
        array_id.push(question.question_id)
    })
    if (!array_id.includes(single_question.question_id)){
        local_question.push(single_question)
    }else{
        local_question.forEach(question => {
            if (question.question_id === single_question.question_id){
                question.choices = single_question.choices
            }
        })
    }
    data['questions'] = local_question
    localStorage.setItem('data', JSON.stringify(data))
    local_question.forEach(value =>{
        if (value.choices.length === 0){
            array_question_empty.push(value.question_id)
        }
    })
    if (array_question_empty.length > 0){
        var confirm_submit = confirm('Bạn còn các câu '+array_question_empty+' chưa trả lời. Vẫn muốn tiếp tục nộp bài chứ ?')
        if (confirm_submit === true){
            submitQuiz()
        }
    }else{
        submitQuiz()
    }
}

function submitQuiz(){
    var data_post = localStorage.getItem('data')
    data_post = JSON.parse(data_post)
    data_post['timeStart'] = localStorage.getItem('timeStart')
    console.log(data_post)
    $.ajax({
        method: 'POST',
        url: '/../QuizSys/APIThread/submitAnswer/',
        headers: {
            'Content-type': 'application/json',
            'Authorization': getCookie('Authorization')
        },
        data: JSON.stringify(data_post),
        success: (data) =>{
            console.log(data)
            if (data['success'] === true){
                var score = data['mess']
                score *= 100
                alert('Kết quả: Số câu trả lời chính xác '+score+'%')
                localStorage.removeItem('data')
                localStorage.removeItem('timeStart')
                localStorage.removeItem('id_room')
                window.location.href = '/../QuizSys/Home/StudentHome/'
            }
        },
        error: (xhr, error) =>{
            console.log(xhr, error)
        }
    })
}

</script>
