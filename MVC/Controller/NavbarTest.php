<?php
require_once __DIR__."/../core/controllers.php";
require_once "./MVC/Middlewares/Auth.php";

class NavbarTest extends Controller{
    public function defaultFunction(){
        $this->requireView("navbar");
    }

}