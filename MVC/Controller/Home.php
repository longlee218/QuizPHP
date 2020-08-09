<?php
    class Home extends Controller {
        function defaultFunction(){
            $user = $this->requireModel("User");
            $name = $user->defaultName();
            $this->requireView('home', ['username'=>$name, 'user_table'=>$user->getUser()]);
        }
        function setName($name, $old){
            echo 'This is '.$name.' '.$old;
        }
        function setAddress($a, $b){
            $user = $this->requireModel("User");
            echo $user->calculate($a, $b);
        }
    }
