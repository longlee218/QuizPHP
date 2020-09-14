<?php
require "./MVC/Controller/JwtHandler.php";
require_once "./MVC/core/controllers.php";
require_once __DIR__.'/../Models/User.php';

    class Auth extends JwtHandler {
        protected $db;
        protected $headers;
        protected $token;
        public function __construct($headers) {
            parent::__construct();
            $this->db = new User();
            $this->headers = $headers;
        }
        private function messages($success, $status, $user){
            return array(
                "success"=>$success,
                "status"=>$status,
                "user"=>$user
            );
        }
        public function isAuth(){
            if(array_key_exists('Authorization',$this->headers) && !empty(trim($this->headers['Authorization']))):
                $this->token = explode(" ", trim($this->headers['Authorization']));
                if(isset($this->token[0]) && !empty(trim($this->token[0]))):
                    $data = $this->_jwt_decode_token($this->token[0]);
                    $object = $data['data'];
                    if(isset($data['auth']) && isset($object->data) && $data['auth']):
                        return $this->fetchUser($object->data);
                    else:
                        return null;

                    endif; // End of isset($this->token[1]) && !empty(trim($this->token[1]))

                else:
                    return null;

                endif;// End of isset($this->token[1]) && !empty(trim($this->token[1]))

            else:
                return null;

            endif;
        }

        protected function fetchUser($user_id){
            try{
                $result = $this->db->selectAllByID($user_id);
                if($result->num_rows):
                    $row = $result->fetch_assoc();
                    return $this->messages(1, 200, $row);
                else:
                    return null;
                endif;
            }
            catch(PDOException $e){
                return null;
            }
        }
    }
