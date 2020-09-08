<?php
require_once "./MVC/lib/database.php";

class Thread extends Database
{
    var $model = "thread";
    public function defaultFunction(){
        echo $this->model;
    }
    public function insertThread($title, $subject, $grade, $room_id){
        $query = "insert into thread(title, subject, grade, room_id) values 
                    (?, ?, ?, ?)";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("sssi", $title, $subject, $grade, $room_id);
        $stmt->execute();
        $id =  $stmt->insert_id;
        $stmt->close();
        $query = "select * from thread where id=?";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function queryThreadByRoomID($room_id){
        $query = 'select * from thread where (room_id=? and flag_delete = ?)';
        $flag_delete = '0';
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('is', $room_id, $flag_delete);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function selectAllByID($thread_id){
        $query = 'select * from thread where id = ?';
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('i', $thread_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    public function updateThread($thread_id, $grade, $room_id, $subject, $title){
        try {
            $query = 'update thread set grade = ? , room_id = ?, subject = ?, title = ? where id = ?';
            $stmt = $this->con->prepare($query);
            $stmt->bind_param('sissi', $grade, $room_id, $subject, $title, $thread_id);
            $stmt->execute();
            $stmt->close();
            return 1;
        }catch (PDOException $exception){
            echo $exception;
            return 0;
        }
    }
    public function setFlagDeleteTo0($id){
        try {
            $query = 'update thread set flag_delete = ? where id = ?';
            $stmt = $this->con->prepare($query);
            $flag_delete = '1';
            $stmt->bind_param('si', $flag_delete, $id);
            $stmt->execute();
            $stmt->close();
            return 1;
        }catch (PDOException $exception){
            echo $exception;
            return 0;
        }
    }
}