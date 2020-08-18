<?php
require("./MVC/lib/PHPMailer-master/src/PHPMailer.php");
require("./MVC/lib/PHPMailer-master/src/SMTP.php");
require("./MVC/lib/PHPMailer-master/src/Exception.php");
require "./MVC/config/api.php";

class APISendEmail extends Controller {
    private function messages($success, $status, $messages){
        return [
            "success"=>$success,
            "status"=>$status,
            "messages"=>$messages
        ];
    }
    public function sendEmailResetPassword(){
        $dataReturn = [];
        $data = json_decode(file_get_contents("php://input"));
        if ($_SERVER['REQUEST_METHOD'] != "POST"){
            $dataReturn = $this->messages(0, 404, "Not allow this method");
        }else{
            if (!isset($data->email) || empty(trim($data->email))){
                $dataReturn = $this->messages(0, 400, "You must fill your email");
            }else{
                $user =  $this->requireModel("User");
                $email = $data->email;
                if (!$user->checkEmail($email)){
                    if($this->sendEmail($email, "RESET YOUR PASSWORD", "Please click this link to reset your password: http://localhost:85/QuizSys/APISendEmail/resetPassword/$email")){
                        $dataReturn = $this->messages(1, 200, "Success");
                    }else{
                        $dataReturn = $this->messages(0, 500, "Something wrong, please check again!");
                    }
                }else{
                    $dataReturn = $this->messages(0, 400, "Don't have this email");
                }
            }
            echo json_encode($dataReturn);
        }
    }
    public function resetPassword($email){
        $dataReturn = [];
        $data = json_decode(file_get_contents("php://input"));
        if (empty(trim($data->password)) || empty(trim($data->password_confirm)) || !isset($data->password) || !isset($data->password_confirm)){
            $dataReturn = $this->messages(0, 400, "Please fill all these fields");
        }elseif ($data->password != $data->password_confirm){
            $dataReturn = $this->messages(0, 400, "Your password is not same");
        }else{
            $user_model = $this->requireModel("User");
            if($user_model->resetPassword($data->password_confirm, $email)){
                $dataReturn = $this->messages(1, 200, "Your password have been update, please check again!");
            }else{
                $dataReturn = $this->messages(0, 400, "Something wrong, please try again!");
            }
        }
        echo json_encode($dataReturn);
    }

    public function sendEmail($to_email, $subject, $body)
    {
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP();

        $mail->CharSet="UTF-8";
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPDebug = 1;
        $mail->Port = 465 ; //465 or 587

        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->IsHTML(true);

        //Authentication
        $mail->Username = "longlehoang2013@gmail.com";
        $mail->Password = "vanmieuNTT218";

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
