<?php
require_once __DIR__."/../config/api.php";
require_once "JwtHandler.php";
require_once __DIR__."/../core/controllers.php";

class APILogin extends Controller {
    private function messages($success, $status, $mess, $token=null){
            return array(
                "success"=>$success,
                "status"=>$status,
                "mess"=>$mess,
                "token"=>$token
            );
    }
    public function checkLoginAPI(){
        $user_model = $this->requireModel("User");
        $data = $_REQUEST;
        $returnData = [];

        if($_SERVER["REQUEST_METHOD"] != "POST"){
            $returnData = $this->messages(0, 404, "Method is not allow");
        }
        elseif (!isset($data['email'])||!isset($data['password'])
            ||empty(trim($data['email']))||empty(trim($data['password']))){
            $returnData = $this->messages(0, 400, "Please fill in this fields");
        }
        elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $returnData = $this->messages(0, 400, "Your email is not validate");
        }
        else{
            $email = $data['email'];
            $password = $data['password'];
            $user =  $user_model->selectUser($email);
            if ($user->num_rows){
                $row = $user->fetch_assoc();
                if (md5($password) == $row['password']){
                    $jwt_handler = new JwtHandler();
                    $token_return = $jwt_handler->_jwt_encode_token(
                        "http:localhost:85/QuizSys/Home/defaultFunction",
                        $row['id']
                    );
                    $returnData = $this->messages(1, 200, 'You are login', $token_return);
                }else{
                    $returnData = $this->messages(0, 500, 'Wrong password');
                }
            }else{
                    $returnData = $this->messages(0, 500, 'Wrong email or username');
            }
        }
        echo json_encode($returnData);
    }
}