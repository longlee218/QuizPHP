<?php
require_once __DIR__."/../config/api.php";
require_once __DIR__."/../core/controllers.php";
require_once __DIR__."/JwtHandler.php";

class APIResetPassword extends Controller
{
    private function messages($success, $status, $messages){
        return [
            "success"=>$success,
            "status"=>$status,
            "messages"=>$messages
        ];
    }
    public function changePassword(){
        $data_return = [];
        if ($_SERVER['REQUEST_METHOD'] != 'POST'){
            $data_return = $this->messages(false, 405, 'Not allowed this method');
        }else{
            if ($this->auth->isAuth() == null){
                $data_return = $this->messages(false, 401, 'Invalid token');
            }else{
                $data = json_decode(file_get_contents('php://input'));
                if (empty(trim($data->password)) || empty(trim($data->password_confirm)) || !isset($data->password) || !isset($data->password_confirm)){
                    $data_return = $this->messages(false, 400, 'Please fill all this fields');
                }elseif ($data->password != $data->password_confirm){
                    $data_return = $this->messages(false, 400, "Your password is not match");
                }else{
                    $info = $this->auth->isAuth();
                    $id = $info['user']['id'];
                    $user_model = $this->requireModel("User");
                    $result = $user_model->selectByID($id);
                    $row =  $result->fetch_assoc();
                    $email = $row['email'];
                    try {
                        $user_model->resetPassword(md5($data->password_confirm), $email);
                        $data_return = $this->messages(true, 200, "Your password have been update, please check again!");
                    }catch (Exception $exception){
                        $data_return = $this->messages(false, 500, $exception);
                    }
                }
            }
        }
        echo json_encode($data_return);
    }

    public function resetPassword($username){
        $data_return = [];
        if ($_SERVER['REQUEST_METHOD'] != 'POST'){
            $data_return = $this->messages(false, 405, 'Not allowed this method');
        }else{
            $data = json_decode(file_get_contents("php://input"));
            if (empty(trim($data->password)) || empty(trim($data->password_confirm)) || !isset($data->password) || !isset($data->password_confirm)){
                $data_return = $this->messages(false, 400, "Please fill all these fields");
            }elseif ($data->password != $data->password_confirm){
                $data_return = $this->messages(false, 400, "Your password is not same");
            }else{
                $user_model = $this->requireModel("User");
                $result = $user_model->selectUser($username);
                $row =  $result->fetch_assoc();
                $email = $row['email'];
                try {
                    $user_model->resetPassword(md5($data->password_confirm), $email);
                    $data_return = $this->messages(true, 200, "Your password have been update, please check again!");
                }catch (Exception $exception){
                    $data_return = $this->messages(false, 500, $exception);
                }
            }
        }
        echo json_encode($data_return);
    }
}