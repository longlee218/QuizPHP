<?php include_once './MVC/Views/navbar_student.php'?>
<style>
    #form-exam{
        margin: 20px;
        padding: 10px;
        border: black;
        background: #cccccc;
        border-radius: 5%;

    }


</style>

<body>
    <div class="container">

        <div class="container "></div>

        <div id="form-exam">

        </div>

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
                  <div class="row">
                        <div class="col-xl-1 qs_label">
                                <label for="question_title" class="font-weight-bold" name="label-question">
                                <h3>Câu ${state.page}</h3>
                        </label>
                        </div>
                        <div class="col-8 qs">
                           <div class="form-row">
                                <p>${myData[i]['description']}</p>
                            </div>
                               <div class="form-group">
                                     <div class="question_wrapper" id="all_answer"></div>
                                </div>

                            </div>
                        <div class="col col-2 picture">
                            <div class="image-preview" name="inpFile">
                                <img src="${myData[i]['image']}" alt="Image preview" height="150" width="150">
                            </div>
                        </div>
                        <div class="end-question"></div>
                    </div>
            `
            var choice = form_exam.querySelector("#all_answer")
            choice.innerHTML = ``
            myData[i]['choices'].forEach(value => {
                choice.innerHTML += `
                    <div class="form-choices">
                        <div class="form-row">
                            <label>${value['choice_name']}</label>
                            <input type="checkbox" class="form-group" value="">
                             <label>${value['choice_content']}</label>
                        </div>
                    </div>
                `
            })
        }
        pageButtons(data.pages)
    }

    buildForm()
</script>
