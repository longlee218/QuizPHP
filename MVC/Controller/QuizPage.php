<?php
require_once __DIR__."/../core/controllers.php";


class QuizPage extends Controller
{
    public function defaultFunction(){
        $this->requireView("quiz_page");
    }
    public function listQuiz(){
        $this->requireView("list_quiz");
    }
    public function detail($id_quiz){
        $this->requireView("quiz_detail", ['idQuiz'=>$id_quiz]);
    }
    public function hi(){
        $this->requireView("hi");
    }
}