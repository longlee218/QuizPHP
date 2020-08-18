<?php
require_once __DIR__."/../core/controllers.php";
require_once "./MVC/Middlewares/Auth.php";

class Home extends Controller {
    public function defaultFunction(){
        $this->requireView('home', []);
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
