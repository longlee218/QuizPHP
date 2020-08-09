<!--THIS FILE IS USING TO SOLVE URL CONTROLLER-->
<?php
    class App
    {
        private $controller = 'Home';           //file in .MVC/Controller/
        private $action = 'defaultFunction';    //function in .MVC/Controller/$controller/
        private $param = [];                    //variable for function
        private $file_path = '';                //file path

        //Determine the url
        public function __construct()
        {
            $arr = $this->urlProcess();

            //Controller in url
            if(file_exists("./MVC/Controller/".$arr[0].".php")){
                $this->controller = $arr[0];
            }
            unset($arr[0]);
            $this->file_path =  "./MVC/Controller/".$this->controller.".php";
            require_once $this->file_path;

            $this->controller = new $this->controller;

            //Action in url
            if (isset($arr[1])){
                if (method_exists($this->controller, $arr[1])){
                    $this->action = $arr[1];
                }
                unset($arr[1]);
            }
            //Params in url
            if ($arr){
                $this->param = $arr;
            }
            call_user_func_array([$this->controller, $this->action], $this->param);
        }

        public function urlProcess()
        {
            if (isset($_GET['url'])) {
                return explode('/', filter_var(trim($_GET['url'], '/')));
            }
            return null;
        }
    }
