<?php
require_once __DIR__."/../core/controllers.php";
require_once __DIR__."/../Middlewares/Auth.php";

class QuizPage extends Controller
{

    public function defaultFunction(){
        $auth = new Auth($_COOKIE);
        if ($auth->isAuth() != null && $auth->isAuth()['user']['user_type'] ==1){
            $this->requireView("quiz_page");
        }else{
            $this->requireView('inc/404_page');
        }
    }
    public function listQuiz(){
        $auth = new Auth($_COOKIE);
        if ($auth->isAuth() != null && $auth->isAuth()['user']['user_type'] ==1){
            $this->requireView("list_quiz");
        }else{
            $this->requireView('inc/404_page');
        }
    }
    public function detail($id_quiz){
        $this->requireView("quiz_detail", ['idQuiz'=>$id_quiz]);
    }
    public function hi(){
        $this->requireView("hi");
    }

    public function Test($id_quiz = null){
        $auth = new Auth($_COOKIE);
        if ($auth->isAuth() != null && $auth->isAuth()['user']['user_type'] == 2){
            $this->requireView("exam_page");
        }else{
            $this->requireView('inc/404_page');
        }
    }
}