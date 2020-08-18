<?php
require_once __DIR__."/../lib/php-jwt-master/jwt/JWT.php";
require_once __DIR__."/../lib/php-jwt-master/jwt/ExpiredException.php";
require_once __DIR__."/../lib/php-jwt-master/jwt/SignatureInvalidException.php";
require_once __DIR__."/../lib/php-jwt-master/jwt/BeforeValidException.php";



use \Firebase\JWT\JWT;

class JwtHandler
{
    protected   $jwt_secret;
    protected   $token;
    protected   $issuesAt;
    protected   $expire;
    protected   $jwt;

    public function __construct()
    {
        date_default_timezone_set("Asia/Bangkok");
        $this->issuesAt = time();

        // The expire end after 1 hours(3600 seconds)
        $this->expire = $this->issuesAt + 3600;

        $this->jwt_secret = "Long_jwt_secret";

    }
    //Coding the token
    public function _jwt_encode_token($iss, $data){
        $this->token = array(
            //Identify the user
            "iss"=>$iss,
            "auth"=>$iss,

            //Time start the token
            "issueAt"=>$this->issuesAt,

            //Time expire the token
            "expire"=>$this->expire,

            //Data of the token
            "data"=>$data
        );
        $this->jwt = JWT::encode($this->token, $this->jwt_secret);
        return $this->jwt;
    }
    //Error messages of jwt
    protected function _errMess($messages){
        return array(
            "auth"=>"None",
            "messages"=>$messages
        );
    }
    //Decode the token to get data
    public function _jwt_decode_token($jwt_token){
        try {
            $data_decode = JWT::decode($jwt_token, $this->jwt_secret, array('HS256'));
            return array(
                "auth"=>"Yes",
                "data"=>$data_decode
            );
        }
        catch(\Firebase\JWT\ExpiredException $e){
            return $this->_errMess($e->getMessage());
        }
        catch(\Firebase\JWT\SignatureInvalidException $e){
            return $this->_errMess($e->getMessage());
        }
        catch(\Firebase\JWT\BeforeValidException $e){
            return $this->_errMess($e->getMessage());
        }
        catch(\DomainException $e){
            return $this->_errMess($e->getMessage());
        }
        catch(\InvalidArgumentException $e){
            return $this->_errMess($e->getMessage());
        }
        catch(\UnexpectedValueException $e){
            return $this->_errMess($e->getMessage());
        }
    }
}