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
            try {
                $stmt = $this->con->prepare($query);
                $stmt->bind_param("si", $room_name, $id);
                $stmt->execute();
                return true;
            }catch (Exception $e){
                return false;
            }
        }else{
            $query = "insert into room(room_name, password, users_id) value (?, ?, ?)";
            $this->con->init();
            try {
                $stmt = $this->con->prepare($query);
                $stmt->bind_param("ssi", $room_name, $password, $id);
                $stmt->execute();
                return true;
            }catch (Exception $exception){
                return false;
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
    public function setOfflineRoomBack($room_id){
        $query = 'update room set status=?, time_end=? where  id=?';
        date_default_timezone_set('Asia/Bangkok');
        $time_now =  date('Y-m-d H:i');
        $status = '0';
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("ssi", $status, $time_now, $room_id);
        $stmt->execute();
        return true;
    }

    public function setTimeStartAndEnd($room_id, $time_start, $time_end){
        $query = "update room set  time_start= ?, time_end=? where id=?";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("ssi" ,$time_start, $time_end, $room_id);
        $stmt->execute();
        return true;
    }

    public function findRoomByTimeStart($time_start){
        $query = "select * from room where time_start = ?";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("s", $time_start);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    public function findRoomByTimeEnd($time_end){
        $query = "select * from room where time_end <= ?";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("s", $time_end);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }


    public function setOnline($room_id){
        $status = '1';
        $query = "update room set status = ? where id = ?";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("si", $status, $room_id);
        $stmt->execute();
        $stmt->close();
    }

    public function setOffline($room_id){
        $status = '0';
        $query = "update room set status = ? where id = ?";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("si", $status, $room_id);
        $stmt->execute();
        $stmt->close();
    }

    public function selectName(){
        $query = 'select * from room limit 10';
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function findByName($room_name){
        $query = 'select * from room where room_name like ?';
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $room_name = "%".$room_name."%";
        $stmt->bind_param('s', $room_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function findByRoomName($room_name){
        $query = 'select * from room where room_name = ?';
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('s', $room_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

}