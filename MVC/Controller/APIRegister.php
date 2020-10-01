<?php
require_once __DIR__."/../config/api.php";
require_once "JwtHandler.php";
require_once __DIR__."/../core/controllers.php";

class APIRegister extends Controller {
//    private function messages($success, $status, $mess, $url=null){
//        return array(
//            "success"=>$success,
//            "status"=>$status,
//            "mess"=>$mess,
//            "url"=>$url
//        );
//    }
    public function registerUserInstructor(){
        $user_model = $this->requireModel("User");
        $data = json_decode(file_get_contents("php://input"));
        $returnData = [];
        if ($_SERVER['REQUEST_METHOD'] != 'POST'){
            $returnData = $this->messages(false, 405, "Not allow this method");
        }
        else{
            if (!isset($data->first_name) || !isset($data->last_name) || !isset($data->email)
            ||!isset($data->password) || empty(trim($data->first_name)) ||
            empty(trim($data->last_name)) || empty(trim($data->email)) || empty($data->password)){
                $returnData = $this->messages(false, 400, "Please fill these fields");
            }
            else{
                $first_name = trim($data->first_name);
                $last_name = trim($data->last_name);
                $username = $first_name.$last_name.mt_rand(100000, 999999);
                $email = trim($data->email);
                $password = md5(trim($data->password));
                $gender = trim($data->gender);
                $city = trim($data->city);
                $country = trim($data->country);
                $organization_name = trim($data->organization_name);
                $organization_type = trim($data->organization_type);
                $position = trim($data->position);
                if ($user_model->checkEmail($email)){
                    $returnData = $this->messages(false, 400, "This email have been exists");
                }
                else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $returnData = $this->messages(false, 400, "This email have been exists");
                }
                else{
                    $user =  $user_model->insertInstructor($first_name, $last_name, $username, $email, $password, $gender,
                                                            $organization_type, $organization_name, $position, $country, $city);
                    $room_model = $this->requireModel('Room');
                    $room_name = 'Room'.$user;
                    $room_model->createRoom($room_name, $user, null);
                    $returnData = $this->messages(true, 200, 'You are register success', '/../QuizSys/RegisterAccount/registerPageInstructor/');
                }
            }
        }
        echo json_encode($returnData);
    }


    public function registerUserStudent(){
        $user_model = $this->requireModel("User");

        //Data POST and data return
        $data = $_REQUEST;
        $returnData = [];
        if ($_SERVER['REQUEST_METHOD'] != 'POST'){
            $returnData = $this->messages(true, 405, "Not allow this method");
        }
        else{
            if (!isset($data['first_name']) || !isset($data['last_name']) || !isset($data['email'])
                ||! isset($data['password']) || !isset($data['gender']) || !isset($data['school_name']) || !isset($data['class_name'])
                ||! isset($data['city']) || !isset($data['country']) ||empty(trim($data['first_name'])) ||
                empty(trim($data['last_name'])) ||  empty(trim($data['email'])) || empty($data['password']) ||empty(trim($data['gender'])) ||
                empty(trim($data['school_name'])) ||  empty(trim($data['class_name'])) || empty($data['city']) || empty(trim($data['country']))){
                $returnData = $this->messages(0, 400, "Please fill these fields");
            }
            else{
                $first_name = trim($data['first_name']);
                $last_name = trim($data['last_name']);
                $email = trim($data['email']);
                $username = $first_name.$last_name.mt_rand(100000, 999999);
                $password = trim($data['password']);
                $gender = trim($data['gender']);
                $school_name = trim($data['school_name']);
                $class_name = trim($data['class_name']);
                $city = trim($data['city']);
                $country = trim($data['country']);
                if ($user_model->checkEmail($email)){
                    $returnData = $this->messages(false, 400, "This email have been exists");
                }elseif (strlen($password) < 8){
                    $returnData = $this->messages(false, 400, "Your password is too short");
                }
                else{
                    $user =  $user_model->insertStudent($first_name, $last_name, $username, $email, md5($password), $gender,
                                                    $school_name, $class_name, $country, $city);
                    $returnData = $this->messages(true, 200, 'You are register success', '/../QuizSys/Login');
                }
            }
        }
        echo json_encode($returnData);
    }
}