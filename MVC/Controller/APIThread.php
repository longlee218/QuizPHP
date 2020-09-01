<?php
require_once __DIR__."/../config/api.php";
require_once "JwtHandler.php";
require_once __DIR__."/../core/controllers.php";
require_once  __DIR__."/APIQuestion.php";
require_once __DIR__."/APIChoices.php";

class APIThread extends Controller
{
    private function messages($success, $status, $mess, $url=null){
        return array(
            "success"=>$success,
            "status"=>$status,
            "mess"=>$mess,
            "url"=>$url
        );
    }
    public function createQuiz(){
        $data_return = [];
        $data_question_return = [];
        $data_choice_return = [];
        $data = json_decode(file_get_contents("php://input"));
        $thread_model = $this->requireModel('Thread');

        $thread_obj =  $thread_model->insertThread($data->title, $data->subject, $data->grade, $data->room_id);
        $thread_id = $thread_obj->fetch_assoc()['id'];
        $question_array = $data->questions;
        foreach($question_array as $question){
           $question_obj = new APIQuestion();
           $question_id =  $question_obj->createQuestion($question->explain, $question->image, $question->description, $thread_id)->fetch_assoc()['id'];
           $choice_array = $question->choices;
           foreach ($choice_array as $choice){
               $choice_obj = new APIChoices();
               $choice_obj->createChoices($choice->choice_name, $choice->choice_content, $choice->correct, $question_id);
           }
        }
        echo json_encode($thread_obj->fetch_assoc()['id']);
    }
}