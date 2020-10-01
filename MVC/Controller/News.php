<?php
    class News extends Controller {
        function defaultFunction(){
            $this->requireView('home', []);
        }
    }