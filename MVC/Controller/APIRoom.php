<?php
require_once __DIR__."/../core/controllers.php";
require_once __DIR__."/../config/api.php";


class APIRoom extends Controller
{
    var $room_model;
    public function __construct()
    {
        parent::__construct();
        $this->room_model = $this->requireModel('Room');
    }

    private function messages($success, $messages, $type){
        return [
            "success"=>$success,
            "messages"=>$messages,
            "type"=>$type,
        ];
    }
    public function createRoom(){
        $data = $_REQUEST;
        $data_return = [];
        $password_hash = null;
        $room_name = null;
        if (!empty(trim($data['password']))){
            $password_hash = md5($data['password']);
        }
        if (!isset($data['room_name']) || empty(trim($data['room_name']))){
            $room_name = "RoomNameDefault".mt_rand(100000, 999999);
        }
        if (!isset($data['room_id'])){
            $room_name = $data['room_name'];
            if ($this->room_model->checkRoomNameExist($room_name)){
                $data_return = $this->messages(0, "Please try other room name", 400);
            }else{
                if ($this->room_model->createRoom($room_name, $data['id'],  $password_hash)){
                    $data_return = $this->messages(1, "RoomAction have been create", 200);
                }else{
                    $data_return = $this->messages(0, "Somethings wrong", 400);
                }
            }
        }
        else{
            $result = $this->room_model->selectAllByIDRoom($data['room_id']);
            $room_name = $data['room_name'];
            if ($data['room_name'] == $result->fetch_assoc()['room_name']){
                if($this->room_model->updateRoomWithoutName($data['room_id'], $password_hash)){
                    $data_return = $this->messages(1, "Update success", 200);
                }
            }else{
                //Fix doan nay
                if ($this->room_model->checkRoomNameExist($room_name)){
                    $data_return = $this->messages(0, "Please try other room name", 400);
                }else{
                    $this->room_model->updateRoom($data['room_id'], $data['room_name'], $password_hash);
                    $data_return = $this->messages(1, "Update success", 200);
                }
            }
        }
        echo json_encode($data_return);
    }


//    public function createRoom(){
//        $data = $_REQUEST;
//        $data_return = [];
//        $password_hash = null;
//        if (!isset($data['room_name']) || empty(trim($data['room_name']))){
//            $room_name = "RoomNameDefault".mt_rand(100000, 999999);
//        }else{
//           if (!isset($data['room_id'])){
//               $room_name = $data['room_name'];
//               if ($this->room_model->checkRoomNameExist($room_name)){
//                   $data_return = $this->messages(0, "Please try other room name", 400);
//               }else{
//                   if (empty($data['password'])){
//                       $result = $this->room_model->createRoom($room_name, $data['id']);
//                   }
//                   else{
//                       $password_hash = md5($data['password']);
//                       $result = $this->room_model->createRoom($room_name, $data['id'],  $password_hash);}
//                   if ($result){
//                       $data_return = $this->messages(1, "RoomAction have been create", 200);
//                   }else{
//                       $data_return = $this->messages(0, "Somethings wrong", 400);
//                   }
//               }
//           }
//           if (isset($data['room_id'])){
//               $result = $this->room_model->selectAllByIDRoom($data['room_id']);
//               $room_name = $data['room_name'];
//               if ($data['room_name'] == $result->fetch_assoc()['room_name']){
//                   $password_hash = md5($data['password']);
//                   if($this->room_model->updateRoomWithoutName($data['room_id'], $data['room_name'], $password_hash)){
//                       $data_return = $this->messages(1, "Update success", 200);
//                   }
//               }
//               if ($data['password'] == $data['password_confirm']){
//                   $password_hash = md5($data['password']);
//                   if($this->room_model->updateRoom($data['room_id'], $data['room_name'], $password_hash)){
//                       $data_return = $this->messages(1, "Update success", 200);
//                   }
//               }else{
//                   $data_return = $this->messages(0, "Password is not confirm", 400);
//               }
//           }
//            echo json_encode($data_return);
//        }
//    }
    public function queryRoom($user_id){
        $data_return = [];
        $result = $this->room_model->selectAllByID($user_id);
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                array_push($data_return, $row);
            }
        }
        echo json_encode($data_return);
    }
}