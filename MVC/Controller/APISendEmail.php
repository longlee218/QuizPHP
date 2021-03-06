<?php
require_once __DIR__."/../lib/PHPMailer-master/src/PHPMailer.php";
require_once __DIR__."/../lib/PHPMailer-master/src/SMTP.php";
require_once __DIR__."/../lib/PHPMailer-master/src/Exception.php";
require_once __DIR__."/../config/api.php";
require_once __DIR__."/../core/controllers.php";

class APISendEmail extends Controller {
//    private function messages($success, $status, $messages){
//        return [
//            "success"=>$success,
//            "status"=>$status,
//            "messages"=>$messages
//        ];
//    }
    public function sendEmailResetPassword(){
        $dataReturn = [];
        if ($_SERVER['REQUEST_METHOD'] != "POST"){
            $dataReturn = $this->messages(false, 405, "Not allow this method");
        }else{
            $data = json_decode(file_get_contents("php://input"));
            if (!isset($data->email) || empty(trim($data->email))){
                $dataReturn = $this->messages(false, 400, "You must fill your email");
            }else{
                $user =  $this->requireModel("User");
                $email = $data->email;
                $result = $user->selectUser($email);
                $row =  $result->fetch_assoc();
                $username = $row['username'];
                if ($user->checkEmail($email)){
                    if($this->sendEmail($email, "RESET YOUR PASSWORD", "Please click this link to reset your password: http://localhost/QuizSys/reset_password?usr=$username")){
                        $dataReturn = $this->messages(true, 200, "Success");
                    }else{
                        $dataReturn = $this->messages(false, 500, "Something wrong, please check again!");
                    }
                }else{
                    $dataReturn = $this->messages(false, 400, "Don't have this email");
                }
            }
        }
        echo json_encode($dataReturn);
    }
    public function sendEmailActivateAccount(){
        return true;
    }
    public function sendEmail($to_email, $subject, $body)
    {
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP();

        $mail->CharSet="UTF-8";
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPDebug = 0;
        $mail->Port = 465 ; //465 or 587

        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->IsHTML(true);

        //Authentication
        $mail->Username = "longlehoang2013@gmail.com";
        $mail->Password = "ssbslpjphtjfxxfa";

        //Set Params
        $mail->SetFrom("longlehoang2013@gmail.com");
        $mail->AddAddress($to_email);
        $mail->Subject = $subject;
        $mail->Body = $body;


        try {
            $mail->Send();
            return true;
        } catch (\PHPMailer\PHPMailer\Exception $e) {
            return false;
        }
    }
}
