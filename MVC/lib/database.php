<?php
    require_once './MVC/config/config.php';

    class Database{
        protected $con;
        private $host;
        private $username;
        private $password;
        private $databaseName;

        public function __construct()
        {
            $this->host =constant('DB_HOST');
            $this->username = constant('DB_USER');
            $this->password = constant('DB_PASSWORD');
            $this->databaseName = constant('DB_DATABASE');
            $this->con = mysqli_connect($this->host, $this->username, $this->password);
            mysqli_select_db($this->con, $this->databaseName);
            mysqli_query($this->con, "set names 'utf8'");
        }
    }
