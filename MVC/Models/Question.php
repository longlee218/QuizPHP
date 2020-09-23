<?php
require_once "./MVC/lib/database.php";

class Question extends Database
{
    public function insertQuestion($explain, $image, $image_name ,$description, $thread_id){
        $query = "insert into question (`explain`, image, image_name, description, thread_id) 
                    values (?, ?, ?, ?, ?)";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("ssssi", $explain, $image, $image_name, $description, $thread_id);
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

    public function selectAllByThreadID($thread_id){
        $query = 'select * from question where thread_id = ?';
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('i', $thread_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function deleteAllByThreadID($thread_id){
        try {
            $query = 'delete from question where thread_id = ?';
            $this->con->init();
            $stmt = $this->con->prepare($query);
            $stmt->bind_param('i', $thread_id);
            $stmt->execute();
            $stmt->close();
            return 1;
        }catch (SQLiteException $exception){
            echo $exception;
            return 0;
        }
    }

    public function selectIDByThreadID($thread_id){
        $query = 'select id from question where thread_id = ?';
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('i', $thread_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
}