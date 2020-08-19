<?php
require_once __DIR__."/../config/api.php";
require_once __DIR__."/../core/controllers.php";

class APIResetPassword extends Controller
{
    private function messages($success, $status, $messages){
        return [
            "success"=>$success,
            "status"=>$status,
            "messages"=>$messages
        ];
    }
    public function resetPassword($username){
        $dataReturn = [];
        $data = $_REQUEST;
        if (empty(trim($data['password'])) || empty(trim($data['password_confirm'])) || !isset($data['password']) || !isset($data['password_confirm'])){
            $dataReturn = $this->messages(0, 400, "Please fill all these fields");
        }elseif ($data['password'] != $data['password_confirm']){
            $dataReturn = $this->messages(0, 400, "Your password is not same");
        }else{
            $user_model = $this->requireModel("User");
            $result = $user_model->selectUser($username);
            $row =  $result->fetch_assoc();
            $email = $row['email'];
            if($user_model->resetPassword($data['password_confirm'], $email)){
                $dataReturn = $this->messages(1, 200, "Your password have been update, please check again!");
            }else{
                $dataReturn = $this->messages(0, 400, "Something wrong, please try again!");
            }
        }
        echo json_encode($dataReturn);
    }
}