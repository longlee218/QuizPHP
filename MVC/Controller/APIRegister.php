<?php
require_once __DIR__."/../config/api.php";
require_once "JwtHandler.php";
require_once __DIR__."/../core/controllers.php";

class APIRegister extends Controller {
    private function messages($success, $status, $mess, $url=null){
        return array(
            "success"=>$success,
            "status"=>$status,
            "mess"=>$mess,
            "url"=>$url
        );
    }
    public function registerUserInstructor(){
        $user_model = $this->requireModel("User");
//        $instructor_model = $this->requireModel("Instructor");

        //Data POST and data return
//        $data = json_decode(file_get_contents("php://input"));
        $data = $_REQUEST;
        $returnData = [];
        if ($_SERVER['REQUEST_METHOD'] != 'POST'){
            $returnData = $this->messages(0, 404, "Not allow this method");
        }
        else{
            if (!isset($data->first_name) || !isset($data->last_name) || !isset($data->email)
            ||! isset($data->username)||! isset($data->password) || empty(trim($data->first_name)) ||
            empty(trim($data->last_name)) || empty(trim($data->username)) || empty(trim($data->email)) || empty($data->password)){
                $returnData = $this->messages(0, 400, "Please fill these fields");
            }
            else{
                $first_name = trim($data['first_name']);
                $last_name = trim($data['last_name']);
                $email = trim($data['email']);
                $username = trim($data['username']);
                $password = trim($data['password']);

                if ($user_model->checkUsername($username)){
                    $returnData = $this->messages(0, 400, "This username have been exists");
                }elseif ($user_model->checkEmail($email)){
                    $returnData = $this->messages(0, 400, "This email have been exists");
                }else{
                    $user =  $user_model->insertInstructor($first_name, $last_name, $username, $email, $password, $gender,
                                                            $organization_type, $organization_name, $position, $country, $city);
                    $returnData = $this->messages(1, 200, 'You are register success');
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
            $returnData = $this->messages(0, 404, "Not allow this method");
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
                    $returnData = $this->messages(0, 400, "This email have been exists");
                }elseif (strlen($password) < 8){
                    $returnData = $this->messages(0, 400, "Your password is too short");
                }
                else{
                    $user =  $user_model->insertStudent($first_name, $last_name, $username, $email, md5($password), $gender,
                                                    $school_name, $class_name, $country, $city);
                    $returnData = $this->messages(1, 200, 'You are register success', '../QuizSys/Login');
                }
            }
        }
        echo json_encode($returnData);
    }
}