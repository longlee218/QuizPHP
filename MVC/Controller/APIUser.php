<?php
require_once __DIR__."/../config/api.php";
require_once __DIR__."/../core/controllers.php";

class APIUser extends  Controller{
    private function messages($success, $messages, $status, $data=null){
        return array(
            "success"=>$success,
            "messages"=>$messages,
            "status"=>$status,
            "data"=>$data
        );
    }

    public function findInfoUser($id){
        $data_return = [];
        if ($this->auth->isAuth() == null){
            $data_return = $this->messages(false, 'Invalid token', 401);
        }else{
            if ($_SERVER['REQUEST_METHOD'] != 'GET'){
                $data_return = $this->messages(false, 'Not allowed this method', 405);
            }else{
                $user_model = $this->requireModel('User');
                try {
                    $user_obj = $user_model->selectAllByID($id);
                    $data_return = $this->messages(true, 'Success', 200, $user_obj->fetch_assoc());
                }catch (Exception $exception){
                    $data_return = $this->messages(false, $exception, 500);
                }
            }
        }
        echo json_encode($data_return);
    }

    public function findInfoUserByRoom($id_room){
        $data_return = [];
        if ($this->auth->isAuth() == null){
            $data_return = $this->messages(false, 'Invalid token', 401);
        }else{
            if ($_SERVER['REQUEST_METHOD'] != 'GET'){
                $data_return = $this->messages(false, 'Not allowed this method', 405);
            }else{
                $user_model = $this->requireModel('User');
                try {
                    $user_obj = $user_model->selectAllByIDRoom($id_room);
                    $data_return = $this->messages(true, 'Success', 200, $user_obj->fetch_assoc());
                }catch (Exception $exception){
                    $data_return = $this->messages(false, $exception, 500);
                }
            }
        }
        echo json_encode($data_return);
    }
}