<?php
require_once "./MVC/config/api.php";
require_once "./MVC/Middlewares/Auth.php";

class Home extends Controller {
    function defaultFunction(){
        $this->requireView('This is home');
    }
    public function infoUserJWT(){
        $getAllHeaders = getallheaders();
        $auth = new Auth($this->requireModel("User"), $getAllHeaders);
        $returnData = [
            "success"=>0,
            "status"=>404,
            "mess"=>"Not author"
        ];
        if ($auth->isAuth()){
            $returnData = $auth->isAuth();
        }
        echo json_encode($returnData);
    }
}
