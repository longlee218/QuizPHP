<?php
require "./MVC/config/api.php";
require "./MVC/Controller/JwtHandler.php";

class APIRegister extends Controller {
    private function messages($success, $status, $mess, $token=null){
        return array(
            "success"=>$success,
            "status"=>$status,
            "mess"=>$mess,
            "token"=>$token
        );
    }
    public function registerUserInstructor(){
        $user_model = $this->requireModel("User");
        $instructor_model = $this->requireModel("Instructor");

        //Data POST and data return
        $data = json_decode(file_get_contents("php://input"));
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
                $first_name = trim($data->first_name);
                $last_name = trim($data->last_name);
                $email = trim($data->email);
                $username = trim($data->username);
                $password = trim($data->password);
                if ($user_model->checkUsername($username)){
                    $returnData = $this->messages(0, 400, "This username have been exists");
                }elseif ($user_model->checkEmail($email)){
                    $returnData = $this->messages(0, 400, "This email have been exists");
                }else{
                    $user =  $user_model->insertUser($first_name, $last_name, $username, $email, $password);
                    $row = $user->fetch_assoc();
                    $instructor =  $instructor_model->insertInstructor(trim($data->organization_type),
                        trim($data->organization_name), trim($data->position), trim($data->country), $row['id']);
                    $returnData = $this->messages(1, 200, 'You are register success');
                }
            }
        }
        echo json_encode($returnData);
    }


    public function registerUserStudent(){
        $user_model = $this->requireModel("User");
        $student_model = $this->requireModel("Student");

        //Data POST and data return
        $data = json_decode(file_get_contents("php://input"));
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
                $first_name = trim($data->first_name);
                $last_name = trim($data->last_name);
                $email = trim($data->email);
                $username = trim($data->username);
                $password = trim($data->password);
                if ($user_model->checkUsername($username)){
                    $returnData = $this->messages(0, 400, "This username have been exists");
                }elseif ($user_model->checkEmail($email)){
                    $returnData = $this->messages(0, 400, "This email have been exists");
                }else{
                    $user =  $user_model->insertUser($first_name, $last_name, $username, $email, $password);
                    $row = $user->fetch_assoc();
                    $student =  $student_model->insertStudent(trim($data->class_name), trim($data->school_name), $row['id']);
                    $returnData = $this->messages(1, 200, 'You are register success');
                }
            }
        }
        echo json_encode($returnData);
    }
}