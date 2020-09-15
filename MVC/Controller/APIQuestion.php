<?php
require_once __DIR__."/../config/api.php";
require_once __DIR__."/../core/controllers.php";

class APIQuestion extends Controller
{
    var $data_return = [];
    private function messages($success, $status, $mess, $url=null){
        return array(
            "success"=>$success,
            "status"=>$status,
            "mess"=>$mess,
            "url"=>$url
        );
    }
    public function createQuestion($explain, $image, $image_name ,$description, $thread_id){
//        $data = json_decode(file_get_contents("php://input"));
        $question_model = $this->requireModel("Question");
        return $question_model->insertQuestion($explain, $image,  $image_name,$description, $thread_id);

    }
}