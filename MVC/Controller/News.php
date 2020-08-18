<?php
    echo 'This is new';
    class News extends Controller {
        function defaultFunction(){
            $this->requireView('home', []);
        }
    }