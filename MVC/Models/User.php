<?php
require_once __DIR__.'/../lib/database.php';
class User extends Database {
    private $model = 'users';
    public function defaultName(){
        echo 'users';
    }
    public function getUser(){
        $query = 'select * from '.$this->model;
        return mysqli_query($this->con, $query);
    }
    public function selectUser($name){
        $query = "select * from users where username=? or email=?";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("ss", $name, $name);
        $stmt->execute();
        return $stmt->get_result();

    }
    public function selectByID($id){
        $fetch_user_by_id = "SELECT username,email, id, user_type FROM users WHERE id=?";
        $this->con->init();
        $stmt = $this->con->prepare($fetch_user_by_id);
        $stmt->bind_param("d", $id);
        $stmt->execute();
        return $stmt->get_result();
    }
    public function selectAllByID($id){
        $fetch_user_by_id = "SELECT * FROM users WHERE id=?";
        $this->con->init();
        $stmt = $this->con->prepare($fetch_user_by_id);
        $stmt->bind_param("d", $id);
        $stmt->execute();
        return $stmt->get_result();
    }


    public function  insertInstructor($first_name, $last_name, $username, $email, $password, $gender,
                                      $organization_type, $organization_name, $position, $country, $city){
            $user_type = '1';
            $query = "insert into users(first_name, last_name, username, email, user_type, password, gender, organization_type,
                                        organization_name, position , country, city)
                        values (?,?,?,?,?,?,?,?,?,?,?,?)";
            $this->con->init();
            $stmt = $this->con->prepare($query);
            $stmt->bind_param('ssssssssssss', $first_name, $last_name, $username, $email, $user_type, $password,
                        $gender, $organization_type, $organization_name, $position, $country, $city);
            $stmt->execute();
            $stmt->close();
            return $this->selectUser($email);
    }


    public function  insertStudent($first_name, $last_name, $username, $email, $password, $gender,
                                      $school_name, $class_name, $country, $city){
        $user_type = '2';
        $query = "insert into users(first_name, last_name, username, email, user_type, password, gender, school_name, 
                                    class_name, country, city)
                        values (?,?,?,?,?,?,?,?,?,?,?)";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("sssssssssss",
            $first_name,
            $last_name,
            $username,
            $email,
            $user_type,
            $password,
            $gender,
            $school_name,
            $class_name,
            $country,
            $city);
        $stmt->execute();
        $stmt->close();
        return $this->selectUser($email);
    }



    public function checkEmail($email){
        $query = "select * from users where email=?";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows){
            $stmt->close();
            return true;
        }else{
            $stmt->close();
            return false;
        }
    }
    public function checkUsername($username){
        $query = "select * from users where username=?";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows){
            $stmt->close();
            return true;
        }else{
            $stmt->close();
            return false;
        }
    }

    public function checkAccountLogin($name, $password){
        $query = "select * from users where username=? or email=?";
        $this->con->init();
        $stmt =  $this->con->prepare($query);
        $stmt->bind_param("ss", $name, $name);
        $stmt->execute();
        $result = $stmt->get_result();
        if (!$result->num_rows){
            $stmt->close();
            return false;
        }else{
            $password_hash = md5($password);
            $query = "select * from users where (username=? or email=?) and password=?";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("sss", $name, $name, $password_hash);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows){
                $stmt->close();
                return true;
            }else{
                $stmt->close();
                return false;
            }
        }
    }
    public function updateInfoInstructor($id, $first_name, $last_name, $email, $gender, $country, $organization_name, $position){
        try {
            $query = "update users set first_name=?, last_name=?, email=?, gender=?, country=?, organization_name=?, position=? 
                        where id=?";
            $this->con->init();
            $stmt =  $this->con->prepare($query);
            $stmt->bind_param("sssssssi", $first_name, $last_name, $email, $gender, $country, $organization_name, $position, $id);
            $stmt->execute();
            $stmt->close();
            return true;
        }catch (Exception $exception){
            return false;
        }
    }

    public function resetPassword($password, $email){
        try {
            $query = "update users set password = ? where email = ?";
            $this->con->init();
            $stmt =  $this->con->prepare($query);
            $password_hash = md5($password);
            $stmt->bind_param("ss", $password_hash, $email);
            $stmt->execute();
            $stmt->close();
            return true;
        }catch (Exception $exception){
            return false;
        }
    }
}
