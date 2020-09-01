<?php
require_once __DIR__."/../core/controllers.php";


class QuizPage extends Controller
{
    public function defaultFunction(){
        $this->requireView("quiz_page");
    }
}