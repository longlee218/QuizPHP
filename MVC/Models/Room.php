<?php
require_once __DIR__.'/../lib/database.php';

class Room extends Database
{
    public function defaultFunction(){
        echo "This is RoomAction models";
    }
    public function checkRoomNameExist($room_name){
        $query = "select * from room where room_name=?";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("s", $room_name);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0){
            return true;
        }
        return false;
    }
    public function createRoom($room_name, $id, $password=null){
        if ($password == null){
            $query = "insert into room(room_name, users_id) value (?, ?)";
            $this->con->init();
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("si", $room_name, $id);
            return true;
        }else{
            $query = "insert into room(room_name, password, users_id) value (?, ?, ?)";
            $this->con->init();
            try {
                $stmt = $this->con->prepare($query);
                $stmt->bind_param("ssi", $room_name, $password, $id);
                $stmt->execute();
                return true;
            }catch (Exception $exception){
                return $exception->getMessage();
            }

        }
    }
    public function selectAllByID($user_id){
        $query = "select * from room where  users_id = ?";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }
    public function selectAllByIDRoom($id){
        $query = "select * from room where id = ?";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function updateRoomWithoutName($room_id, $password){
        $query = "update room set password=? where id=?";
        $this->con->init();
        try {
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("si",  $password, $room_id);
            $stmt->execute();
            return true;
        }catch (Exception $exception){
            echo $exception;
            return false;
        }
    }
    public function updateRoom($room_id, $room_name, $password){
        $query = "update room set room_name= ?, password=? where id=?";
        $this->con->init();
        try {
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("ssi", $room_name, $password, $room_id);
            $stmt->execute();
            return true;
        }catch (Exception $exception){
            echo $exception;
            return false;
        }
    }
}