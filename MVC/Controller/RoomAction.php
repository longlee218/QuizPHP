<?php
require_once __DIR__."/../core/controllers.php";
require_once __DIR__."/../Middlewares/Auth.php";

class RoomAction extends Controller
{
    public function defaultFunction(){
        $this->requireView("room_page");
    }

    public function roomContent($id){
        $auth = new Auth($_COOKIE);
        if ($auth->isAuth() != null && $auth->isAuth()['user']['user_type'] == 2){
            $this->requireView("room_detail_student");
        }else{
            $this->requireView("inc/404_page");
        }
    }
}