<?php
require_once "./MVC/lib/database.php";

class Thread extends Database
{
    var $model = "thread";
    public function defaultFunction(){
        echo $this->model;
    }
    public function insertThread($title, $subject, $grade, $description, $user_id){
        $query = " insert into thread  (title, subject, grade, description, user_id) 
                   values              (  ?  ,    ?   ,   ?  ,      ?     ,    ?   ) ";
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("ssssi", $title, $subject, $grade, $description, $user_id);
        $stmt->execute();
        $id =  $stmt->insert_id;
        $stmt->close();
        $query = " select    * 
                   from      thread 
                   where     id = ? ";
        $stmt = $this->con->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function queryThreadByIDUser($id_user){
        $query = 'select * from thread where (user_id = ? and flag_delete = ?) order by update_at desc';
        $flag_delete = '0';
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('is', $id_user, $flag_delete);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function selectAllByID($thread_id){
        $query = 'select * from thread where id = ?';
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('i', $thread_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    public function updateThread($thread_id, $grade, $room_id, $subject, $title){
        try {
            $query = 'update thread set grade = ? , room_id = ?, subject = ?, title = ? where id = ?';
            $stmt = $this->con->prepare($query);
            $stmt->bind_param('sissi', $grade, $room_id, $subject, $title, $thread_id);
            $stmt->execute();
            $stmt->close();
            return 1;
        }catch (PDOException $exception){
            echo $exception;
            return 0;
        }
    }
    public function setFlagDeleteTo0($id){
        try {
            $query = 'update thread set flag_delete = ? where id = ?';
            $stmt = $this->con->prepare($query);
            $flag_delete = '1';
            $stmt->bind_param('si', $flag_delete, $id);
            $stmt->execute();
            $stmt->close();
            return 1;
        }catch (PDOException $exception){
            echo $exception;
            return 0;
        }
    }

    public function findByTitleLikeUser($user_id, $title){
        $query = 'select * from thread where (user_id = ? and flag_delete = ? and title like ?) order by update_at desc ';
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $title = '%'.$title.'%';
        $flag_delete = '0';
        $stmt->bind_param('iss',$user_id, $flag_delete, $title);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }


    public function findByTitleLike($id_room, $title){
        $query = 'select * from thread where (room_id = ? and flag_delete = ? and title like ?)';
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $title = '%'.$title.'%';
        $flag_delete = '0';
        $stmt->bind_param('iss',$id_room, $flag_delete, $title);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
    public function setStatusThread($id_thread){
        $query = 'update thread set is_test = ? where id = ?';
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $is_test = '1';
        $stmt->bind_param('si',$is_test, $id_thread);
        $stmt->execute();
        $stmt->close();
    }

    public function countThread($id_room){
        $query = 'select count(room.id) as `SL`
                    from room inner join room_thread rt on room.id = rt.room_id
                    where room.id = ?
                    group by room.id';
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('i',$id_room);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function selectThreadNotInRoom($id_room){
        $query = '  select *
                    from thread
                    where id not in (select thread_id from room_thread where room_id = ?)';
        $this->con->init();
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('i',$id_room);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
}