<?php
require_once __DIR__."/../core/controllers.php";


class ProfileInstructor extends Controller
{
    public function defaultFunction(){
        $this->requireView('info_instructor_page');
    }
}