<?php
require_once __DIR__."/../config/api.php";
require_once __DIR__."/../core/controllers.php";


class APIChoices extends Controller
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
    public function createChoices($choice_name, $choice_content, $correct, $question_id){
//        $data = json_decode(file_get_contents("php://input"));
        $choices_model = $this->requireModel("Choices");
        return $choices_model->insertChoices($choice_name, $choice_content, $correct, $question_id);
    }
}