<?php
require_once __DIR__.'/../lib/database.php';

class ResultDetail extends Database
{
    public function insertResultDetail($user_id, $question_id, $answer, $correct, $result_id){
        $query = 'insert into resultdetail (users_id, question_id, answer, correct, result_id) values (?,?,?,?,?)';
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('iisii', $user_id, $question_id, $answer, $correct, $result_id);
        $stmt->execute();
        $result_id = $stmt->insert_id;
        $stmt->close();
        return $result_id;
    }

    public function updateResultDetail($id, $question_id, $answer, $correct){
        $query = 'update resultdetail set question_id = ?, answer = ?, correct = ? where id = ?';
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('isii', $question_id, $answer, $correct, $id);
        $stmt->execute();
        $stmt->close();
        return $id;
    }

    public function selectAllByResultID($result_id){
        $query = 'select * from resultdetail where result_id = ?';
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('i', $result_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
}