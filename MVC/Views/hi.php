<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>

<div class="row">
    <div class="col-sm d-inline-flex p-2">
        <div class="p-2 position-relative">
            <div class="dropdown">
                <button type="button" class="dropbtn btn" id="btn_drop" onclick="showNav()">{{ quiz.title }}<i
                            class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content" id="question_nav"></div>
            </div>
        </div>
    </div>
    <div class="col-sm p-2">
        <div class="p-2 float-right"><a href="#" class="btn btn-warning btn-add-room"
                                        id="btn-finish-quiz"
                                        style="border-radius: 30px; font-size:20px; width: 150px; color: #fff">FINISH
                QUIZ</a>
        </div>
    </div>
</div>
<hr>
<div class="bound-1">
    <div class="quiz_container">
        <div id="quiz"></div>
    </div>
    <div class="button_nav">
        <button id="previous_quiz" class="btn btn-warning ">Previous Question</button>
        <button id="next_quiz" class="btn btn-warning">Next Question</button>
    </div>
</div>
<script>
    let myQuestions = JSON.parse("{{ detail|escapejs }}");
    const quizContainer = document.getElementById('quiz');
    const resultsContainer = document.getElementById('results');
    const submitButton = document.getElementById('btn-finish-quiz');
    const questionNav = document.getElementById("question_nav");

    function buildQuiz() {
        const output = [];
        myQuestions.forEach(
            (currentQuestion, questionNumber) => {

                const title = [];
                const num = [];
                for (i in currentQuestion.question_title) {
                    title.push(
                        `<div class="num row justify-content-center"><h2>${i} of ${myQuestions.length}</h2></div>
                            <div class="row justify-content-center">
                            <label>
                                <span name="question${questionNumber}" style="font-size: 30px">${currentQuestion.question_title[i]}</span>
                            </label>
                            </div>`
                        )
                }
                const answer = [];
                for (let letter in currentQuestion.choices) {
                    answer.push(
                        `<div class="row" style="display: block;"><label>
                        <input type="checkbox" class="checkbox-round" name="question${questionNumber}" value="${letter}">
                        <span class="answer">${letter} :
                        ${currentQuestion.choices[letter]}</span>
                      </label></div>`
                        );
                }
                output.push(
                    `
                        <div class="slide" id="question${questionNumber + 1}">
                            <div class="question">${title.join('')}</div>
                            <div class="answers">${answer.join('')}</div>
                        </div>`
                    );
            }
            );
        quizContainer.innerHTML = output.join('');
    }

    buildQuiz();

    function showResults() {

        const answerContainers = quizContainer.querySelectorAll('.answers');
        let numCorrect = 0;

        myQuestions.forEach((currentQuestion, questionNumber) => {

            const answerContainer = answerContainers[questionNumber];
            const selector = `input[name=question${questionNumber}]:checked`;
            const userAnswer = (answerContainer.querySelectorAll(selector) || {});
            let answerss = []
            for (let i = 0; i < userAnswer.length; i++) {
                answerss.push(userAnswer[i].value);
            }
            let correct = Object.keys(currentQuestion['correct'])
            if (JSON.stringify(answerss) === JSON.stringify(correct)) {
                numCorrect++;

                answerContainers[questionNumber].style.color = 'lightgreen';
            } else {
                answerContainers[questionNumber].style.color = 'red';
            }

        });

        alert(`${(numCorrect / myQuestions.length * 100).toFixed(2)}%,<div>correct:${numCorrect}/${myQuestions.length}</div>`);
    }

    submitButton.addEventListener('click', showResults);
    const previousButton = document.getElementById("previous_quiz");
    const nextButton = document.getElementById("next_quiz");
    const slides = document.querySelectorAll(".slide");
    let currentSlide = 0;

    function showSlide(n) {
        slides[currentSlide].classList.remove('active-slide');
        slides[n].classList.add('active-slide');
        currentSlide = n;
        if (currentSlide === 0) {
            previousButton.style.display = 'none';
        } else {
            previousButton.style.display = 'inline-block';
        }
        if (currentSlide === slides.length - 1) {
            nextButton.style.display = 'none';
        } else {
            nextButton.style.display = 'inline-block';
        }
    }

    showSlide(currentSlide)

    function showNextSlide() {
        checkAnswer();
        showSlide(currentSlide + 1);
    }

    function showPreviousSlide() {
        checkAnswer();
        showSlide(currentSlide - 1);
    }

    previousButton.addEventListener("click", showPreviousSlide);
    nextButton.addEventListener("click", showNextSlide);

    function generateNav() {
        for (let i = 1; i < myQuestions.length + 1; i++) {
            let div = document.createElement("a");
            div.setAttribute("class", "square");
            div.setAttribute("id", `#question${i}`);
            div.setAttribute("href", `#question${i}`);

            let h = document.createElement("a");
            h.textContent = i;
            div.appendChild(h);
            questionNav.appendChild(div);
        }
    }

    generateNav();

    function showNav() {
        questionNav.classList.toggle("show");
    }

    function checkAnswer() {
        const answerContainers = quizContainer.querySelectorAll('.answers');
        myQuestions.forEach((currentQuestion, questionNumber) => {
            const answerContainer = answerContainers[questionNumber];
            const selector = `input[name=question${questionNumber}]:checked`;
            const userAnswer = (answerContainer.querySelector(selector));
            if (userAnswer) {
                const parent = answerContainer.parentElement.id
                let a = document.getElementsByTagName("a");
                for (let i = 0; i < a.length; i++) {
                    if (a[i].id === `#${parent}`) {
                        a[i].style.backgroundColor = "#8cb4d2";
                    }
                }
            } else {
                const parent = answerContainer.parentElement.id
                let a = document.getElementsByTagName("a");
                for (let i = 0; i < a.length; i++) {
                    if (a[i].id === `#${parent}`) {
                        a[i].style.backgroundColor = "#fff";
                    }
                }
            }
        })
    }

    function checkSlide(){
        let currentSlide = 0;

    }

    $('#question_nav a').on('click', function (e) {
        $(this.id).addClass("active-slide").fadeIn().siblings('div').removeClass('active-slide');
    });

</script>