<?php
require_once __DIR__."/../core/controllers.php";

class ForgotPassword extends Controller
{
    public function defaultFunction(){
        $this->requireView('forgot_password', []);
    }
}