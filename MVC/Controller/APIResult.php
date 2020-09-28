<?php
require_once __DIR__."/../config/api.php";
require_once "JwtHandler.php";
require_once __DIR__."/../core/controllers.php";

class APIResult extends Controller
{

    public function listResultStudent(){
        $data_return = [];
        if ($this->auth->isAuth() == null && $this->auth->isAuth()['user_type']['user_id'] != 2){
            $data_return = $this->messages(false, 401, 'Invalid token');
        }
    }

}