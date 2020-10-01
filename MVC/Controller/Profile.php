<?php
require_once __DIR__."/../core/controllers.php";


class Profile extends Controller
{
    public function defaultFunction(){
        $auth = new Auth($_COOKIE);
        if ($auth->isAuth() != null && $auth->isAuth()['user']['user_type'] == 1){
            $this->requireView('info_instructor_page');
        }
    }

    public function profileStudent(){
        $auth = new Auth($_COOKIE);
        if ($auth->isAuth() != null && $auth->isAuth()['user']['user_type'] == 2){
            $this->requireView('info_student_page');
        }
    }
}