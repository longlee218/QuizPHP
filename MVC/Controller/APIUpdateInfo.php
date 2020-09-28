<?php
require_once __DIR__."/../config/api.php";
require_once __DIR__."/APILogin.php";
require_once __DIR__."/../core/controllers.php";

class APIUpdateInfo extends Controller
{
//    private function messages($success, $status, $mess, $url=null){
//        return array(
//            "success"=>$success,
//            "status"=>$status,
//            "mess"=>$mess,
//            "url"=>$url
//        );
//    }
    public function updateInfo(){
        $data_return = [];
        if ($this->auth->isAuth() == null){
            $data_return = $this->messages(false, 401, 'Invalid token');
        }else{
            if ($_SERVER['REQUEST_METHOD'] != 'POST'){
                $data_return = $this->messages(false, 405, 'Not allowed this method');
            }else{
                $data = json_decode(file_get_contents("php://input"));
                $user_model = $this->requireModel("User");
                if (!isset($data->id)){
                    $data_return = $this->messages(false, 400, "Error");
                }else{
                    try {
                        $user_model->updateInfoInstructor($data->id, $data->first_name, $data->last_name, $data->email, $data->gender,
                            $data->country, $data->organization_name, $data->position);
                        $data_return =$this->messages(true, 200, "Update success");
                    }catch (Exception $exception){
                        $data_return = $this->messages(false, 500, $exception);
                    }
                }
            }
        }
        echo json_encode($data_return);
    }
}
