<?php
require_once __DIR__."/../config/api.php";
require_once "JwtHandler.php";
require_once __DIR__."/../core/controllers.php";


class APILogout extends Controller
{
    public function logout(){
        try{
            setcookie("Authorization", false , time()-3600, "/", $_SERVER['SERVER_NAME']);
            $dataReturn = $this->messages(true, 200, "You are logout",null , "/../QuizSys/Login");
        }catch (Exception $exception){
            $dataReturn =  $this->messages(false, 500, "Sorry, somethings wrong");
        }
        echo json_encode($dataReturn);
    }
}