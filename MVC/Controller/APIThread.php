<?php
require_once __DIR__."/../config/api.php";
require_once "JwtHandler.php";
require_once __DIR__."/../core/controllers.php";
require_once  __DIR__."/APIQuestion.php";
require_once __DIR__."/APIChoices.php";

class APIThread extends Controller
{
    private function messages($success, $status, $mess, $data=null ,$url=null){
        return array(
            "success"=>$success,
            "status"=>$status,
            "mess"=>$mess,
            "data"=>$data,
            "url"=>$url
        );
    }
    public function checkValidateQuiz(){
        $data = json_decode(file_get_contents("php://input"));
        $data_return = [];
        if (empty(trim($data->title)) || empty(trim($data->room_id))){
            $data_return = $this->messages(0, 400, 'Require title or Room ID');
        }
        else{
            if(count($data->questions) != 0){
                $list_question = $data->questions;
                foreach ($list_question as $question){
                    if (empty(trim($question->description))){
                        $data_return = $this->messages(0, 400, 'Please fill the content of question');
                    }
                    elseif (count($question->choices) <= 1){
                        $data_return = $this->messages(0, 400, 'Need more than 1 selection');
                    }
                    else{
                        $list_choice = $question->choices;
                        $temp = 1;
                        foreach ($list_choice as $choice){
                            if (empty(trim($choice->choice_content))){
                                $data_return = $this->messages(0, 400, 'Please fill the content of answer');
                            }else{
                                $temp *= (int)$choice->correct;
                            }
                        }
                        if ($temp == 1){$data_return = $this->messages(0, 400, "Question can't wrong all or correct all");}
                        else{ $data_return = $this->messages(1, 200, "Validate data");}
                    }
                }
            }else{
                $data_return = $this->messages(0, 400, "Can't not submit because don't have any question");
            }
        }
        echo json_encode($data_return);
    }

    public function createQuiz(){
      if ($_SERVER['REQUEST_METHOD'] != 'POST'){
          $data = $this->messages('0', '500', 'Method is not allowed');
      }else{
          $data_return = [];
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
          if ($thread_obj->num_rows > 0){
              while ($row = $thread_obj->fetch_assoc()){
                  array_push($row, $data_return);
              }
          }
          $data_return = $this->messages('1', '200', 'Success', 'null');
      }
        echo json_encode($data_return);
    }

    public function queryQuiz($id_room){
        $data_return = [];
        if ($_SERVER['REQUEST_METHOD'] != 'GET'){
            $data_return = $this->messages(0, 402, "Not allow this method");
        }else{
            $list_thread = [];
            $result = $this->requireModel('Thread')->queryThreadByRoomID($id_room);
            if ($result->num_rows > 0){
                while ($row = $result->fetch_assoc()){
                    array_push($list_thread, $row);
                }
            }
            $data_return = $this->messages(1, 200, "Success", $list_thread);
        }
        echo json_encode($data_return);
    }

    public function arrayGroupBy($array, $id){
        $groups = [];
        foreach( $array as $row ) array_push($groups, $row);
        return $groups;
    }

    public function queryQuizDetail($id_thread){
        $data_return = [];
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] != 'GET'){
            $data_return = $this->messages(0, 402, "Not allow this method");
        }else{
            $result_thread = $this->arrayGroupBy($this->requireModel('Thread')->selectAllByID($id_thread), $id_thread);
            $result_question =$this->arrayGroupBy( $this->requireModel('Question')->selectAllByThreadID($id_thread), $id_thread);
            $result_choices = $this->arrayGroupBy( $this->requireModel('Choices')->selectAllByThreadIDJoin($id_thread), $id_thread);

            try {
                foreach ($result_thread as $index=>$single_thread){
                    $single_thread['questions'] =  $result_question;
                    foreach ($single_thread['questions'] as $index2=>&$single_question){
                       $single_question['choices'] = $result_choices;
                    }
                }
                $data = $single_thread;
            }catch (Exception $exception){
                echo $exception;
            }

        }
        echo json_encode($data);
    }
}