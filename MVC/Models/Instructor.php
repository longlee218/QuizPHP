<?php

require_once "./MVC/lib/database.php";

class Instructor extends Database
{
    private $model = "instructors";
    public function defaultName(){
        echo $this->model;
    }
    public function insertInstructor($organization_type, $organization_name, $position, $country, $user_id){
        $query = "insert into instructors(organization_type, organization_name, position, country, users_id)
 values (?,?,?,?,?)";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('sssss', $organization_type, $organization_name, $position, $country, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

}