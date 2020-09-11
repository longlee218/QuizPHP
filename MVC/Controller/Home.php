<?php
require_once __DIR__."/../core/controllers.php";
require_once "./MVC/Middlewares/Auth.php";

class Home extends Controller {
    public function InstructorHome(){
        $this->requireView('home', []);
    }

    public function StudentHome(){
        $this->requireView('home_student', []);
    }

    public function infoUserJWT(){
        $auth = new Auth(getallheaders());
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
