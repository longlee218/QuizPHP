<?php
require_once './MVC/lib/database.php';
    class User extends Database {
        private $model = 'User';
        public function defaultName(){
            return 'Admin';
        }
        public  function calculate($a, $b){return $a+$b;}
        public function getUser(){
            $query = 'select * from users';
            return mysqli_query($this->con, $query);
        }
    }
