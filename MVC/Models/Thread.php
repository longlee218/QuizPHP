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

}