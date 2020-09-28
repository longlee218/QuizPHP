<?php
require_once __DIR__."/../core/controllers.php";
require_once "./MVC/Middlewares/Auth.php";

class Home extends Controller {
    public function InstructorHome(){
        $auth = new Auth($_COOKIE);
        if ($auth->isAuth() == null && $this->auth->isAuth()['user']['user_type'] != 1){
            print_r($auth->isAuth());
        }else{
            $this->requireView('home', []);

        }
    }

    public function StudentHome(){
        $auth = new Auth($_COOKIE);
        if ($auth->isAuth() == null && $this->auth->isAuth()['user']['user_type'] != 2){
            $this->requireView('inc/404_page', []);
        }else{
            $this->requireView('home_student', []);
        }
    }

    public function infoUserJWT(){
        $returnData = [
            "success"=>false,
            "status"=>404,
            "mess"=>"Not author"
        ];
        if ($this->auth->isAuth()){
            $returnData = $this->auth->isAuth();
        }
        echo json_encode($returnData);
    }
}
