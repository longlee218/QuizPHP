<?php
require_once "./MVC/lib/database.php";

class Choices extends Database
{
    public function insertChoices($choice_name, $choice_content, $correct, $question_id){
        $query = "insert into choices (choice_name, choice_content, correct, question_id) 
                values (?, ?, ?, ?)";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("sssi", $choice_name, $choice_content, $correct, $question_id);
        $stmt->execute();
        $id =  $stmt->insert_id;
        $stmt->close();
        $query = "select * from choices where id=?";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
}