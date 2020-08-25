<?php
require_once __DIR__."/../config/api.php";
require_once __DIR__."/APILogin.php";
require_once __DIR__."/../core/controllers.php";

class APIUpdateInfo extends Controller
{
    private function messages($success, $status, $mess, $url=null){
        return array(
            "success"=>$success,
            "status"=>$status,
            "mess"=>$mess,
            "url"=>$url
        );
    }
    public function updateInfo(){
        $user_model = $this->requireModel("User");
//        $data = json_decode(file_get_contents("php://input"));
        $data = $_REQUEST;
        $data_return = [];
        if (!isset($data['id'])){
            $data_return = $this->messages(0, 404, "Error");
        }else{
           $user_update =  $user_model->updateInfoInstructor($data['id'], $data['first_name'], $data['last_name'], $data['email'], $data['gender'],
                $data['country'], $data['organization_name'], $data['position']);
           if ($user_update){
               $data_return =$this->messages(1, 404, "Update success");
           }else{
               $data_return = $this->messages(0, 404, "Please fill all these fields");
           }
        }
        echo json_encode($data_return);
    }
}
