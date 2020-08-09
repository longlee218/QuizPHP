<!--USING TO CALL MODELS AND VIEWS-->

<?php
    class Controller{
        public $model_path = '';
        public $view_path = '';
        function __construct(){
        }

        public function requireModel($model){
            $this->model_path =  './MVC/Models/'.$model.'.php';
            require_once $this->model_path;
            return new $model();
        }

        public function requireView($view, $data=[]){
            $this->view_path = './MVC/Views/'.$view.'.php';
            require_once $this->view_path;
        }
    }