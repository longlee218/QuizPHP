<?php
require_once __DIR__."/../config/api.php";
require_once "JwtHandler.php";
require_once __DIR__."/../core/controllers.php";

class APILogin extends Controller {
    private function messages_token($success, $status, $mess, $token=null, $url=null, $expire=null){
            return array(
                "success"=>$success,
                "status"=>$status,
                "mess"=>$mess,
                "token"=>$token,
                "exp"=>$expire,
                "url"=>$url
            );
    }
    public function updateTokenAPI($id){
        setcookie("Authorization", false , time()-3600, "/", $_SERVER['SERVER_NAME']);
        $user_model = $this->requireModel("User");
        $user =  $user_model->selectAllByID($id);
        $row = $user->fetch_assoc();
        $jwt_handler = new JwtHandler();
        $token_return = $jwt_handler->_jwt_encode_token(
            "http:localhost:85/QuizSys/Home/InstructorHome",
            $row['id']
        );
        return $this->messages_token(true, 200, 'Update success', $token_return);
    }
    public function checkLoginAPI(){
        $user_model = $this->requireModel("User");
        $data = json_decode(file_get_contents("php://input"));
        $returnData = [];

        if($_SERVER["REQUEST_METHOD"] != "POST"){
            $returnData = $this->messages_token(false, 405, "Method is not allow");
        }
        if (!isset($data->email)||!isset($data->password)
            ||empty(trim($data->email))||empty(trim($data->password))){
            $returnData = $this->messages_token(false, 400, "Please fill in this fields");
        }
        elseif (!filter_var($data->email, FILTER_VALIDATE_EMAIL)){
            $returnData = $this->messages_token(false, 400, "Your email is not validate");
        }
        else{
            $email = $data->email;
            $password = $data->password;
            $user =  $user_model->selectUser($email);
            if ($user->num_rows){
                $row = $user->fetch_assoc();
                if (md5($password) == $row['password']){
                    $jwt_handler = new JwtHandler();
                    if ($row['user_type'] == 1){
                        $token_return = $jwt_handler->_jwt_encode_token(
                            "",
                            $row['id']
                        );
                        $url = "/../QuizSys/Home/InstructorHome";
                    }else if ($row['user_type'] == 2){
                        $token_return = $jwt_handler->_jwt_encode_token(
                            "",
                            $row['id']
                        );
                        $url = "/../QuizSys/Home/StudentHome";
                    }
                    setcookie('Authorization', $token_return, time()+3600, '/');
                    $_SESSION['id'] = $row['id'];
                    $returnData = $this->messages_token(true, 200, 'You are login', $token_return, $url, 3600);
                }else{
                    $returnData = $this->messages_token(false, 400, 'Wrong password');
                }
            }else{
                    $returnData = $this->messages_token(false, 400, 'Wrong email or username');
            }
        }
        echo json_encode($returnData);
    }
}
