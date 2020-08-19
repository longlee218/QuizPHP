<?php
require_once __DIR__."/../config/api.php";
require_once "JwtHandler.php";
require_once __DIR__."/../core/controllers.php";


class APILogout extends Controller
{
    private  function messages($status, $type, $messages){
        return [
            "status"=> $status,
            "type"=>$type,
            "messages"=>$messages
        ];

    }
    public function logout(){
        try{
            setcookie( 'Authorization', '', time() - 999999, '/', $_SERVER['SERVER_NAME'] );
            echo($_COOKIE['Authorization']);
            $dataReturn = $this->messages(1, 200, "You are logout");
        }catch (Exception $exception){
            $dataReturn =  $this->messages(0, 500, "Sorry, somethings wrong");
        }
        echo json_encode($dataReturn);
    }
}