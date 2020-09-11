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
        $data_return = [];
        if ($_REQUEST['REQUEST_METHOD'] != 'POST'){
            $data_return = $this->messages('0', 'Not allow this method', '405');
        }else{
            $data = $_POST;
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
                    if ($this->room_model->checkRoomNameExist($room_name)){
                        $data_return = $this->messages(0, "Please try other room name", 400);
                    }else{
                        $this->room_model->updateRoom($data['room_id'], $data['room_name'], $password_hash);
                        $data_return = $this->messages(1, "Update success", 200);
                    }
                }
            }
        }
        echo json_encode($data_return);
    }
    public function queryRoom($user_id){
        $data_return = [];
        if ($this->auth->isAuth() != null){
            if ($_SERVER['REQUEST_METHOD'] != 'GET'){
                $data_return = $this->messages('0', 'Method not allow', '405');
            }else{
                $result = $this->room_model->selectAllByID($user_id);
                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        array_push($data_return, $row);
                    }
                }
            }
        }else{
            $data_return = $this->messages(0, 'Invalid token', 400);
        }
        echo json_encode($data_return);
    }

    public function checkTime($start, $end){
        $data_return = [];
        if ($_SERVER['REQUEST_METHOD'] != 'GET'){
            $data_return = $this->messages('0', 'Method not allow', '405');
        }else{
            date_default_timezone_set('Asia/Bangkok');
            $time_now =  date('Y-m-d H:i');
            if (empty(trim($start)) || empty(trim($end))){
                $data_return =  $this->messages('0', 'Please fill all these fill', '400');
            }elseif ($start < $time_now){
                $data_return = $this->messages('0', 'Not valid time start. Please try again', '400');
            }else if ($end < $start){
                $data_return = $this->messages('0', 'Not valid time end. Please try again', '400');
            }
            else{
                $data_return = $this->messages('1','Check valid', '200');
            }
        }
        echo json_encode($data_return);
    }

    public function setRoomOffline(){
        $data_return = [];
        if ($_SERVER['REQUEST_METHOD'] != 'POST'){
            $data_return = $this->messages(1, 'Method not allow', '405');
        }else{
            $data = $_POST;
            if (!isset($data['room_id']) || empty($data['room_id'])){
                $data_return = $this->messages('0', 'Require room id', 500);
            }else{
                $id_room = $data['room_id'];
                $this->room_model->setOfflineRoomBack($id_room);
                $data_return = $this->messages(1, 'Success', '200');
            }
        }
        echo json_encode($data_return);
    }

    public function  setTimeOnline($id_room){
        $data_return = [];
        if ($_SERVER['REQUEST_METHOD'] != 'POST'){
            $data_return = $this->messages('0', 'Method not allow', '405');
        }else{
            $data = $_POST;
            date_default_timezone_set('Asia/Bangkok');
            $time_now =  date('Y-m-d H:i');
            if ($data['time-start'] == $time_now){
                $this->room_model->setOnlineRoomInTime($id_room ,$data['time-start'], $data['time-end']);
                $data_return = $this->messages("1", "Success update", "200");
            } else {
                $data_return = $this->messages("0", ["time-server"=>$time_now, "room_id"=>$id_room], "400");
            }
        }
        echo json_encode($data_return);
    }
    public function deleteRoom($id_room){
       return 0;
    }

}