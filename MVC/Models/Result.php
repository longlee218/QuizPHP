<?php
require_once __DIR__.'/../lib/database.php';

class Result extends Database
{
    public function insertResult($score, $start_at){
        $query= 'insert into result (score, start_at) values(?, ?)';
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('ss', $score, $start_at);
        $stmt->execute();
        $result_id = $stmt->insert_id;
        $stmt->close();
        return $result_id;
    }

    public function updateResult($id, $score, $finish_at){
        $query = "update result set score = ?, finish_at = ? where id = ?";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('ssi', $score, $finish_at, $id);
        $stmt->execute();
        $stmt->close();
        return $id;
    }



}