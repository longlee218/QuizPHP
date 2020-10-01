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

//    private function messages($success, $messages, $type, $data=null){
//        return [
//            "success"=>$success,
//            "messages"=>$messages,
//            "type"=>$type,
//            "data"=>$data
//        ];
//    }
    public function createRoom(){
        $data_return = [];
        if ($_SERVER['REQUEST_METHOD'] != 'POST'){
            $data_return = $this->messages(false, 405, 'Not allowed this methd');
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
                    $data_return = $this->messages(false, 400, "Please try other room name");
                }else{
                    if ($this->room_model->createRoom($room_name, $data['id'],  $password_hash)){
                        $data_return = $this->messages(true,200 , "RoomAction have been create");
                    }
                }
            }
            else{
                $result = $this->room_model->selectAllByIDRoom($data['room_id']);
                $room_name = $data['room_name'];
                if ($data['room_name'] == $result->fetch_assoc()['room_name']){
                    if($this->room_model->updateRoomWithoutName($data['room_id'], $password_hash)){
                        $data_return = $this->messages(true, 200, 'Update success');
                    }
                }else{
                    if ($this->room_model->checkRoomNameExist($room_name)){
                        $data_return = $this->messages(false, 400, "Please try other room name");
                    }else{
                        $this->room_model->updateRoom($data['room_id'], $data['room_name'], $password_hash);
                        $data_return = $this->messages(true, 200, 'Update success');
                    }
                }
            }
        }
        echo json_encode($data_return);
    }

    public function getInfoRoom($id_room){
        $data_return = [];
        if ($this->auth->isAuth() == null){
            $data_return = $this->messages(false, 401, 'Invalid token');
        }else{
            if ($_SERVER['REQUEST_METHOD'] != 'GET'){
                $data_return = $this->messages(false, 405, 'Not allowed this method');
            }else{
                $room_model = $this->requireModel('Room');
                $room_obj = $room_model->selectAllByIDRoom($id_room);
                if ($room_obj->num_rows <= 0){
                    $data_return = $this->messages(false, 400, "Don't have this room");
                }else{
                    $data_return = $this->messages(true, 200, 'success', $room_obj->fetch_assoc());
                }
            }
        }
        echo json_encode($data_return);
    }

    public function queryRoom($user_id){
        $data_return = [];
        if ($this->auth->isAuth() == null || $this->auth->isAuth()['user']['user_type'] != 1){
            $data_return = $this->messages(false, 401,'Invalid token');
        }
        else{
            if ($_SERVER['REQUEST_METHOD'] != 'GET'){
                $data_return = $this->messages(false, 405, 'Method not allow');
            }else{
                $data = [];
                $result = $this->room_model->selectAllByID($user_id);
                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        array_push($data, $row);
                    }
                    $data_return = $this->messages(true, 200,'Success',  $data);
                }
            }
        }
        echo json_encode($data_return);
    }

    public function checkTime($start, $end){
        $data_return = [];
        if ($_SERVER['REQUEST_METHOD'] != 'GET'){
            $data_return = $this->messages(false, 405,'Method not allow');
        }else{
            date_default_timezone_set('Asia/Bangkok');
            $time_now =  date('Y-m-d H:i');
            if (empty(trim($start)) || empty(trim($end))){
                $data_return =  $this->messages(false,400,'Please fill all these fill');
            }elseif ($start < $time_now){
                $data_return = $this->messages(false, 400,'Not valid time start. Please try again');
            }else if ($end < $start){
                $data_return = $this->messages(false, 400, 'Not valid time end. Please try again');
            }
            else{
                $data_return = $this->messages(true, 200, 'Check valid');
            }
        }
        echo json_encode($data_return);
    }

    public function setRoomOffline(){
        $data_return = [];
        if ($_SERVER['REQUEST_METHOD'] != 'POST'){
            $data_return = $this->messages(false, 405, 'Method not allow');
        }else{
            $data = $_POST;
            if (!isset($data['room_id']) || empty($data['room_id'])){
                $data_return = $this->messages(false, 400, 'Require room id');
            }else{
                try {
                    $id_room = $data['room_id'];
                    $this->room_model->setOfflineRoomBack($id_room);
                    $data_return = $this->messages(true, 200, 'Success');
                }catch (Exception $exception){
                    $data_return = $this->messages(false, 500, $exception);
                }
            }
        }
        echo json_encode($data_return);
    }

    public function  setTimeOnline($id_room){
        $data_return = [];
        if ($_SERVER['REQUEST_METHOD'] != 'POST'){
            $data_return = $this->messages(false, 405, 'Method not allow');
        }else{
            $data = $_POST;
            date_default_timezone_set('Asia/Bangkok');
            $time_now =  date('Y-m-d H:i');
            $this->room_model->setTimeStartAndEnd($id_room ,$data['time-start'], $data['time-end']);
            $data_return = $this->messages(true, 200, "Success update");
        }
        echo json_encode($data_return);
    }
    public function deleteRoom($id_room){
       return 0;
    }

    public function cronSetOnlineRoom(){
        $room_model = $this->requireModel('Room');
        date_default_timezone_set('Asia/Bangkok');
        $time_now =  date('Y-m-d H:i');
        try {
            echo $time_now;
            $result = $room_model->findRoomByTimeStart($time_now);
            if ($result->num_rows != 0){
                $id_room =  $result->fetch_assoc()['id'];
                echo 'Find time start';
                $room_model->setOnline($id_room);
            }else{
                echo 'Waiting time start....';
            }
        }catch (Exception $exception){
            echo $exception;
        }
        return 0;
    }

    public function cronSetOfflineRoom(){
        $room_model = $this->requireModel('Room');
        date_default_timezone_set('Asia/Bangkok');
        $time_now =  date('Y-m-d H:i');
        try {
            $result = $room_model->findRoomByTimeEnd($time_now);
            if ($result->num_rows != 0){
                $id_room =  $result->fetch_assoc()['id'];
                echo 'Find time end';
                $room_model->setOffline($id_room);
            }else{
                echo 'Waiting time end....';
            }
        }catch (Exception $exception){
            echo $exception;
        }
        return 0;
    }

    // function for student

    public  function viewRoom(){
        $data_return = [];
        if ($this->auth->isAuth() == null || $this->auth->isAuth()['user']['user_type'] != 2){
            $data_return = $this->messages(false, 401, 'Invalid token');
        }else{
            if ($_SERVER['REQUEST_METHOD'] != 'GET'){
                $data_return = $this->messages(false, 405, 'Not allowed this method');
            }else{
                $data = [];
                try {
                    $room_model = $this->requireModel('Room');
                    $room_object = $room_model->selectName();
                    if ($room_object->num_rows > 0){
                        while ($row = $room_object->fetch_assoc()){
                            array_push($data, $row);
                        }
                    }
                    $data_return = $this->messages(true, 200, 'Success', $data);
                }catch (Exception $exception){
                    $data_return = $this->messages(false, $exception, 500);
                }
            }
        }
        echo json_encode($data_return);
    }

    public function searchRoom($room_name=null){
        $data_return = [];
        if ($this->auth->isAuth() == null || $this->auth->isAuth()['user']['user_type'] != 2){
            $data_return = $this->messages(false, 401, 'Invalid token');
        }else{
            if ($_SERVER['REQUEST_METHOD'] != 'GET'){
                $data_return = $this->messages(false, 405, 'Not allowed this method');
            }else{
                $array_value_return = [];
                try {
                    $room_model = $this->requireModel('Room');
                    $room_object = $room_model->findByName($room_name);
                    if ($room_object->num_rows > 0){
                        while ($row = $room_object->fetch_assoc()){
                            array_push($array_value_return, $row);
                        }
                    }
                    $data_return = $this->messages(true,200, 'Success',$array_value_return);
                }catch (Exception $exception){
                    $data_return = $this->messages(false, $exception, 500);
                }
            }
        }
        echo json_encode($data_return);
    }

    public function loginIntoRoom(){
        $data_return = [];
        if ($this->auth->isAuth() == null && $this->auth->isAuth()['user']['user_type'] != 2){
            $data_return = $this->messages(false, 401, 'Invalid token');
        }else{
            if ($_SERVER['REQUEST_METHOD'] != 'POST'){
                $data_return = $this->messages(false, 405, 'Not allowed this method');
            }else{
                $data = json_decode(file_get_contents("php://input"));
                $room_model = $this->requireModel('Room');
                try {
                    $room_name = $data->room_name;
                    $password = $data->password;
                    $room_obj = $room_model->findByRoomName($room_name);
                    $row = $room_obj->fetch_assoc();
                    $id = $row['id'];
                    if ($room_obj->num_rows > 0){
                        if (md5($password) == $row['password']){
                            setcookie('AuthorizationRoom', md5($password), time()+3600, '/');
                            $url = '/../QuizSys/RoomAction/roomContent/'.$id;
                            $data_return = $this->messages(true, 200, 'Success', $url);
                        }else{
                            $data_return = $this->messages(false, 400,'Wrong password');
                        }
                    }
                }catch (Exception $exception){
                    $data_return = $this->messages(false, 500, $exception);
                }
            }
        }
        echo json_encode($data_return);
    }
}