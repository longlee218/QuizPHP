<?php
require_once "./MVC/lib/database.php";
class  Student extends  Database {
    public function defaultFunction(){
        return "This is Student";
    }
    public function insertStudent($class_name, $school_name, $user_id){
        $query = "insert into students(class_name, school_name, users_id)
 values (?,?,?)";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('sss', $class_name, $school_name, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
}
