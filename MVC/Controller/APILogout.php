<?php
require "./MVC/config/api.php";
require "./MVC/Controller/JwtHandler.php";

class APILogout
{
    private  function messages($status, $type, $messages){
        return [
            "status"=> $status,
            "type"=>$type,
            "messages"=>$messages
        ];

    }
    public function logout(){
        $get_headers =  getallheaders();
        $dataReturn = [];
        echo $get_headers['Authorization'];
        try{
            unset($get_headers['Authorization']);
            $dataReturn = $this->messages(1, 200, "You are logout");
        }catch (Exception $exception){
            $dataReturn =  $this->messages(0, 500, "Sorry, somethings wrong");
        }
        echo json_encode($dataReturn);
    }
}