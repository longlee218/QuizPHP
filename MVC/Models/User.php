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
        $fetch_user_by_id = "SELECT username,email FROM users WHERE id=?";
        $this->con->init();
        $stmt = $this->con->prepare($fetch_user_by_id);
        $stmt->bind_param("d", $id);
        $stmt->execute();
        return $stmt->get_result();
    }
    public function  insertUser($first_name, $last_name, $username, $email, $password){
            $user_type = 2;
            $password_hash = md5($password);
            $query = "insert into users(first_name, last_name, username, email, user_type, password)
                        values (?,?,?,?,?,?)";
            $this->con->init();
            $stmt = $this->con->prepare($query);
            $stmt->bind_param('ssssis', $first_name, $last_name, $username, $email, $user_type, $password_hash);
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
