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
        margin: 20px 0 0 0;

    }
    .quiz-box .option-container .option{
        margin: 10px 0;
        border-radius: 16px;
        border-style: solid;
        background-color: #ffffff;
        font-size: 16px;
        display: block;


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
        padding: 5px;
    }
    .quiz-box .option-container .option .choice-name{
        font-size: 18px;
        font-weight: 500;
        margin-right: 20px;
        margin-left: 5px;

    }
</style>

<body>
    <div class="container">
        <div></div>
        <div id="form-exam" ></div>
        <hr>
        <nav aria-label="Page exam">
            <div class="container ">
                <ul class="pagination" id="pagination-wrapper"></ul>
            </div>
        </nav>
    </div>



</body>
<script>

//=========================================================================
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
        console.log(trimStart)
        console.log(trimEnd)
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

        $('.page').click(function () {
                $('#form-exam').empty()
                state.page = Number($(this).val())
                buildForm()
        })

    }
    const buildForm = () =>{
        var examForm = $('#form-exam')
        var data = pagination(state.querySet, state.page, state.rows)
        console.log(data)
        var myData = data.querySet
        for (var i in myData){
            console.log(myData[i])
            var form_exam = document.getElementById('form-exam')
            form_exam.innerHTML = `
            <div class="quiz-box custom-box" id=${myData[i]['id']}">
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
            var choice = form_exam.querySelector("#all_option")
            choice.innerHTML = ``
            myData[i]['choices'].forEach(value => {
                choice.innerHTML += `
                    <div class="option" id=${value['id']}">
                        <div class="form-row">
                            <span class="choice-name">${value['choice_name']}.</span>
                            <p>${value['choice_content']}</p>
                        </div>
                    </div>
                `
            })

        }
        pageButtons(data.pages)
    }
    buildForm()

    const form_exam = $('#form-exam')
    console.log($(form_exam).find('.quiz-box #all_option .option'));
    $(form_exam).find('.quiz-box #all_option .option').on('click', (e) =>{
        console.log(e)
        if (e.target.className === 'form-row'){
            e.target.className += " selected"
            e.target.style.background = "green";
            e.target.style.borderRadius = "15px";
            // e.target.style.padding = "5px 0";
            e.target.style.color = 'white';
        }else{
            e.target.className = 'form-row'
            e.target.style = 'none'
        }
    })

    function selectAnswer(e) {
        $(e).addClass('selected')
    }

</script>
