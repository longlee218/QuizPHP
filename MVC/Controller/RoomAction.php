<?php
require_once __DIR__."/../core/controllers.php";

class RoomAction extends Controller
{
    public function defaultFunction(){
        $this->requireView("room_page");
    }
}