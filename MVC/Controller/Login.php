<?php
    class Login extends Controller {

        public function defaultFunction(){
            $this->requireView('login_page', []);
        }
    }