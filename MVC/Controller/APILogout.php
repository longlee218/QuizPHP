<?php
require_once __DIR__."/../config/api.php";
require_once "JwtHandler.php";
require_once __DIR__."/../core/controllers.php";


class APILogout extends Controller
{
    private  function messages($status, $type, $messages, $url=null){
        return [
            "status"=> $status,
            "type"=>$type,
            "messages"=>$messages,
            "url"=>$url
        ];

    }
    public function logout(){
        try{
            setcookie("Authorization", false , time()-3600, "/", $_SERVER['SERVER_NAME']);
            $dataReturn = $this->messages(1, 200, "You are logout", "../Login");
        }catch (Exception $exception){
            $dataReturn =  $this->messages(0, 500, "Sorry, somethings wrong");
        }
        echo json_encode($dataReturn);
    }
}