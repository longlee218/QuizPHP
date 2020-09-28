<?php
require_once __DIR__.'/../Middlewares/Auth.php';
    class Controller{
        public $model_path = '';
        public $view_path = '';
        protected $auth;
        function __construct(){
            if (!function_exists('getallheaders')) {
                function getallheaders() {
                    $headers = [];
                    foreach ($_SERVER as $name => $value) {
                        if (substr($name, 0, 5) == 'HTTP_') {
                            $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
                        }
                    }
                    return $headers;
                }
            }
            $this->auth = new Auth(getallheaders());
        }
        protected function messages($success, $status, $mess, $data=null ,$url=null){
            return array(
                "success"=>$success,
                "status"=>$status,
                "mess"=>$mess,
                "data"=>$data,
                "url"=>$url
            );
        }

        public function requireModel($model){
            $this->model_path =  __DIR__.'/../Models/'.$model.'.php';
            require_once $this->model_path;
            return new $model();
        }

        public function requireView($view, $data=[]){
            $this->view_path =  "./MVC/Views/".$view.".php";
            require_once $this->view_path;
        }
    }