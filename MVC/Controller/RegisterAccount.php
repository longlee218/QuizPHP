<?php
require_once __DIR__."/../core/controllers.php";


class RegisterAccount extends Controller
{
    public function defaultFunction(){
        $this->requireView('register_page', []);
    }
}