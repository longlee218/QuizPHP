<?php
require_once __DIR__."/../config/api.php";
require_once "JwtHandler.php";
require_once __DIR__."/../core/controllers.php";
require_once  __DIR__."/APIQuestion.php";
require_once __DIR__."/APIChoices.php";
require_once __DIR__."/../lib/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php";

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
        $data = $_POST;
        $data_return = [];
        if (empty(trim($data['title'])) || empty(trim($data['room_id']))){
            $data_return = $this->messages(false, 400, 'Require title or Room ID');
        }
        else{
            if(count(json_decode($data['questions'])) != 0){
                $list_question = json_decode($data['questions']);
                foreach ($list_question as $question){
                    if (empty(trim($question->description))){
                        $data_return = $this->messages(false, 400, 'Please fill the content of question');
                    }
                    elseif (count($question->choices) <= 1){
                        $data_return = $this->messages(false, 400, 'Need more than 1 selection');
                    }
                    else{
                        $list_choice = $question->choices;
                        $array_check = [];
                        foreach ($list_choice as $index => $choice){
                            if (empty(trim($choice->choice_content))){
                                $data_return = $this->messages(false, 400, 'Please fill the content of answer');
                            }else{
                                array_push($array_check, $choice->correct);
                            }
                        }
                        if (min($array_check) == 0 && max($array_check) == 0){$data_return = $this->messages(0, 400, "Question can't wrong all or correct all");}
                        else{ $data_return = $this->messages(true, 200, "Validate data");}
                    }
                }
            }else{
                $data_return = $this->messages(false, 400, "Can't not submit because don't have any question");
            }
        }
        echo json_encode($data_return);
    }

    public function createQuiz(){
        $data_return= [];
      if ($_SERVER['REQUEST_METHOD'] != 'POST'){
          $data_return = $this->messages(false, 405, 'Method is not allowed');
      }else{
          $data = $_POST;
          $thread_model = $this->requireModel('Thread');
          $thread_obj =  $thread_model->insertThread($data['title'], $data['subject'], $data['grade'], $data['room_id']);
          $thread_id = $thread_obj->fetch_assoc()['id'];
          $question_array = json_decode($data['questions']);
          foreach($question_array as $index=>$question){
              $question_obj = new APIQuestion();
              $value_file = $this->load_file($index);
              $img = $value_file['image'];
              $img_name = $value_file['image_name'];
              $question_id =  $question_obj->createQuestion($question->explain, $img, $img_name,$question->description, $thread_id)->fetch_assoc()['id'];
              $choice_array = $question->choices;
              foreach ($choice_array as $choice){
                  $choice_obj = new APIChoices();
                  $choice_obj->createChoices($choice->choice_name, $choice->choice_content, $choice->correct, $question_id);
              }
          }
//          if ($thread_obj->num_rows > 0){
//              while ($row = $thread_obj->fetch_assoc()){
//                  array_push($row, $data_return);
//              }
//          }
          $data_return = $this->messages(true, 200, 'Success', 'null');
      }
        echo json_encode($data_return);
    }

    public function load_file($index){
        $value_file = [
            'image' => null,
            'image_name' => null,
        ];
        if (array_key_exists($index, $_FILES)){
            $target_dir = __DIR__."/../../uploads/";
            $name = $_FILES[$index]['name'];
            $target_file = $target_dir.basename($_FILES[$index]['name']);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $extensions_arr = array("jpg","jpeg","png","gif");
            if (in_array($imageFileType, $extensions_arr)){
                $image_base64 = base64_encode(file_get_contents($_FILES[$index]['tmp_name']));
                $img = 'data:image/'.$imageFileType.';base64,'.$image_base64;
                move_uploaded_file($_FILES[$index]['tmp_name'], $target_dir.$name);
                $value_file['image'] = $img;
                $value_file['image_name'] = $name;

            }
        }
        return $value_file;
    }

    public function queryQuiz($id_room){
        $data_return = [];
        if ($_SERVER['REQUEST_METHOD'] != 'GET'){
            $data_return = $this->messages(false, 405, "Not allow this method");
        }else{
           if ($this->auth->isAuth() != null){
               $list_thread = [];
               $result = $this->requireModel('Thread')->queryThreadByRoomID($id_room);
               if ($result->num_rows > 0){
                   while ($row = $result->fetch_assoc()){
                       array_push($list_thread, $row);
                   }
               }
               $data_return = $this->messages(true, 200, "Success", $list_thread);
           }else{
               $data_return = $this->messages(false, 401, 'Invalid token');
           }

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
            $data_return = $this->messages(0, 405, "Not allow this method");
        }else{
            $result_thread = $this->arrayGroupBy($this->requireModel('Thread')->selectAllByID($id_thread), $id_thread);
            $result_question =$this->arrayGroupBy( $this->requireModel('Question')->selectAllByThreadID($id_thread), $id_thread);
            $result_choices = $this->arrayGroupBy( $this->requireModel('Choices')->selectAllByThreadIDJoin($id_thread), $id_thread);

            try {
                foreach ($result_thread as $index=>$single_thread){
                    $single_thread['questions'] =  $result_question;
                    foreach ($single_thread['questions'] as $index2=>&$single_question){
                       $single_question['choices'] = [];
                       foreach ($result_choices as  $index3 => $single_choice){
                           if ($single_choice['question_id'] == $single_question['id']){
                               array_push($single_question['choices'], $single_choice);
                           }
                       }
                    }
                }
                $data = $single_thread;
            }catch (Exception $exception){
                echo $exception;
            }

        }
        echo json_encode($data);
    }

    public function  updateQuiz(){
        $data_return = [];
        if ($_SERVER['REQUEST_METHOD'] != 'POST'){
            $data_return = $this->messages(false, 405, "Not allowed this method");
        }else{
           $data = $_POST;
           if (!array_key_exists('id', $data)){
               $data_return = $this->messages(false, 500, "Can't not update!");
           }
           else{
               $id_thread = $data['id'];
               $modelThread = $this->requireModel('Thread');
               $model_question = $this->requireModel('Question');
               $model_choices = $this->requireModel('Choices');
               $this_is_test = $modelThread->selectAllByID($id_thread)->fetch_assoc()['is_test'];
               if ($this_is_test != 0){
                   $data_return = $this->messages(0, 500, "Can't not update!");
               }else{
                   try {
                       $modelThread->updateThread($data['id'], $data['grade'], $data['room_id'], $data['subject'], $data['title']);
                       if ($model_choices->deleteAllByThreadIDJoin($data['id']) == 1 && $model_question->deleteAllByThreadID($data['id']) == 1){
                           $question_array = json_decode($data['questions']);
                           foreach ($question_array as $index=>$single_question){
                               $question_obj = new APIQuestion();
                               $value_file = $this->load_file($index);
                               $img = $value_file['image'];
                               $img_name = $value_file['image_name'];
                               $id_question = $question_obj->createQuestion($single_question->explain, $img, $img_name ,$single_question->description, $id_thread)->fetch_assoc()['id'];
                               foreach ($single_question->choices as $index2=>$single_choice){
                                   $choice_obj = new APIChoices();
                                   $choice_obj->createChoices($single_choice->choice_name, $single_choice->choice_content, $single_choice->correct, $id_question);
                               }
                           }
                           $data_return = $this->messages(true, 200, "Success update");
                       }
                   }catch (BadFunctionCallException $exception){
                       $data_return = $this->messages(false, 400, $exception);
                   }
               }
           }
        }
        echo json_encode($data_return);
    }
    public function deleteQuiz(){
        $data_return = [];
        if ($_SERVER['REQUEST_METHOD'] != 'PUT'){
            $data_return = $this->messages(0, 405, 'Not allow this method');
        }else{
            $data = json_decode(file_get_contents('php://input'));
            $model_thread = $this->requireModel('Thread');
            foreach ($data->list_delete as $index=>$single){
              if ($model_thread->setFlagDeleteTo0($single)){
                  $data_return = $this->messages(1, 200, 'Delete success');
              }else{
                  $data_return =$this->messages(0, 400, 'Error');
              }
            }
        }
        echo json_encode($data_return);
    }
    public function test(){
        print_r($_FILES);
        print_r($_POST);
    }
    public function exportQuiz($id_thread){
        $data_return = [];
        if ($_SERVER['REQUEST_METHOD'] != 'POST'){
            $data_return = $this->messages(0, 405, 'Not allowed this method');
        }else{
            $model_thread = $this->requireModel('Thread');
            $thread_name = $model_thread->selectAllByID($id_thread)->fetch_assoc()['title'];
//            $file_name =  $thread_name.'-'.$id_thread.'.xlsx';
            try {
//                $objExcel = new PHPExcel();
//                $objExcel->setActiveSheetIndex(0);
//                $sheet = $objExcel->getActiveSheet()->setTitle('Sheet '.$file_name);
//                $row_count = 1;
//                $style = array(
//                    'alignment'=>array(
//                        'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
//                    )
//                );
//                $objPHPExcel = new PHPExcel();
//                $sheet = $objPHPExcel->getActiveSheet();
//                $sheet->setCellValueByColumnAndRow(0, 1, "test");
//                $sheet->mergeCells('A1:B1');
//                $sheet->getStyle('A1')->getAlignment()->applyFromArray(
//                    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
//                );
//                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//                $objWriter->save('hello.xlsx');
//                $objWriter->save($fileName);

                $data = [
                    ['Nguyễn Khánh Linh', 'Nữ', '500k'],
                    ['Ngọc Trinh', 'Nữ', '700k'],
                    ['Tùng Sơn', 'Không xác định', 'Miễn phí'],
                    ['Kenny Sang', 'Không xác định', 'Miễn phí']
                ];
//Khởi tạo đối tượng
                $excel = new PHPExcel();
//Chọn trang cần ghi (là số từ 0->n)
                $excel->setActiveSheetIndex(0);
//Tạo tiêu đề cho trang. (có thể không cần)
                $excel->getActiveSheet()->setTitle('demo ghi dữ liệu');

//Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()
                $excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
                $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                $excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);

//Xét in đậm cho khoảng cột
                $excel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
//Tạo tiêu đề cho từng cột
//Vị trí có dạng như sau:
                /**
                 * |A1|B1|C1|..|n1|
                 * |A2|B2|C2|..|n1|
                 * |..|..|..|..|..|
                 * |An|Bn|Cn|..|nn|
                 */
                $excel->getActiveSheet()->setCellValue('A1', 'Tên');
                $excel->getActiveSheet()->setCellValue('B1', 'Giới Tính');
                $excel->getActiveSheet()->setCellValue('C1', 'Đơn giá(/shoot)');
// thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
// dòng bắt đầu = 2
                $numRow = 2;
                foreach ($data as $row) {
                    $excel->getActiveSheet()->setCellValue('A' . $numRow, $row[0]);
                    $excel->getActiveSheet()->setCellValue('B' . $numRow, $row[1]);
                    $excel->getActiveSheet()->setCellValue('C' . $numRow, $row[2]);
                    $numRow++;
                }
// Khởi tạo đối tượng PHPExcel_IOFactory để thực hiện ghi file
// ở đây mình lưu file dưới dạng excel2007
                PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('data.xlsx');
                PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
            } catch (PHPExcel_Reader_Exception $e) {
                echo $e;
            } catch (PHPExcel_Exception $e) {
                echo $e;
            }
        }
    }

    public function searchQuizTitle($id_room, $title=null){
        $data_return = [];
        if ($this->auth->isAuth() == null){
            $data_return = $this->messages(false, 401, 'Invalid token');
        }else{
            if ($_SERVER['REQUEST_METHOD'] != 'GET'){
                $data_return = $this->messages(false, 405, 'Not allowed this method');
            }else{
                $thread_model = $this->requireModel('Thread');
                try {
                    $array_data = [];
                    $result = $thread_model->findByTitleLike($id_room, $title);
                    if ($result->num_rows > 0){
                        while ($row = $result->fetch_assoc()){
                            array_push($array_data, $row);
                            $data_return = $this->messages(true, 200, 'Find its', $array_data);
                        }
                    }
                }catch (Exception $e){
                    $data_return = $this->messages(false, 500, $e);
                }
            }
        }
        echo json_encode($data_return);
    }

}