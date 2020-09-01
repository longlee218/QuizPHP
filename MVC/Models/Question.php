<?php
require_once "./MVC/lib/database.php";

class Question extends Database
{
    public function insertQuestion($explain, $image, $description, $thread_id){
        $query = "insert into question (`explain`, image, description, thread_id) 
                    values (?, ?, ?, ?)";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("sssi", $explain, $image, $description, $thread_id);
        $stmt->execute();
        $id =  $stmt->insert_id;
        $stmt->close();
        $query = "select * from question where id=?";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
}