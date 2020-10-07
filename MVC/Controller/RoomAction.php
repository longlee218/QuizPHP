<?php
require_once __DIR__."/../core/controllers.php";
require_once __DIR__."/../Middlewares/Auth.php";

class RoomAction extends Controller
{
    public function defaultFunction(){
        $this->requireView("list_room");
    }

    public function roomContent($id){
        $auth = new Auth($_COOKIE);
        if ($auth->isAuth() != null && $auth->isAuth()['user']['user_type'] == 2){
            $this->requireView("room_detail_student");
        }else{
            $this->requireView("login_page");
        }
    }

    public function createRoom(){
        $auth = new Auth($_COOKIE);
        if ($auth->isAuth() == null || $auth->isAuth()['user']['user_type'] != 1){
            $this->requireView('login_page');
        }else{
            $this->requireView('create_room');
        }
    }

    public function roomDetail($room_name){
        $auth = new Auth($_COOKIE);
        if ($auth->isAuth() == null){
            $this->requireView('login_page');
        }else{
            $this->requireView('room_detail');
        }
    }
}