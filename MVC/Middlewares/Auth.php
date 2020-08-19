<?php
require "./MVC/Controller/JwtHandler.php";
require_once "./MVC/core/controllers.php";
    class Auth extends JwtHandler {
        protected $db;
        protected $headers;
        protected $token;
        public function __construct($db,$cookie) {
            parent::__construct();
            $database = new Controller();
            $this->db = $database->requireModel("User");
            $this->headers = $cookie;
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
                $result = $this->db->selectByID($user_id);
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