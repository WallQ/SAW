<?php
class ForgotPassword extends Database
{
    private $email;

    public function __construct($data)
    {
        $this->email = $data;
    }

    public function requestRecover()
    {
        if ($this->isEmpty()) {
            header('location: ' . HOME_URL_PREFIX . '/forgotpassword?error=inputs');
            exit();
        }
        if ($this->emailInvalid()) {
            header('location: ' . HOME_URL_PREFIX . '/forgotpassword?error=email');
            exit();
        }
        $stmt = $this->connect()->prepare('SELECT firstName, lastName FROM user WHERE email = ? LIMIT 1;');
        if (!$stmt->execute(array($this->email))) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/forgotpassword?error=stmtfailed');
            exit();
        }
        if ($stmt->rowCount() === 0) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/forgotpassword?error=notfound');
            exit();
        } else {
            $result = $stmt->fetchAll();
        }

        $stmt = $this->connect()->prepare('DELETE FROM forgotpassword WHERE email = ?;');
        if (!$stmt->execute(array($this->email))) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/forgotpassword?error=stmtfailed');
            exit();
        }

        $token = random_bytes(32);
        $hashedToken = password_hash($token, PASSWORD_DEFAULT, ['cost' => 12]);
        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/SAW/newpassword?email=' . $this->email . '&token=' . bin2hex($token);
        $date = date('Y-m-d H:i:s', strtotime("+15 minutes"));
        $stmt = $this->connect()->prepare('INSERT INTO forgotpassword(email,token,date) VALUES (?,?,?);');
        if (!$stmt->execute(array($this->email, $hashedToken,$date))) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/forgotpassword?error=stmtfailed');
            exit();
        }
        require_once('./libs/PHPMailer/PHPMailerAutoload.php');

        $mail = new PHPMailer(true);
        try {
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'andresergiopwa2021@gmail.com';
            $mail->Password = 'estgpwa2021';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('andresergiopwa2021@gmail.com', 'Recover password');
            $mail->addAddress($this->email);
            $mail->isHTML(true);
            $mail->Subject = 'Recover password';
            $body = '<!DOCTYPE html><html lang="en-US"><head> <title>SAW</title> <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/> <meta name="author" content="André & Sérgio"/> <meta name="description" content="This is an evaluation project for the unit SAW."/> <meta http-equiv="X-UA-Compatible" content="IE=edge"/> <meta name="viewport" content="width=device-width, initial-scale=1"/> <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> <style>.color-emerald-50{background-color: #ecfdf5;}.text-emerald-900{color: #064e3b;}.btn-emerald{color: #ffffff !important; border-color: #ffffff !important; background-color: #064e3b !important;}.btn-emerald:hover{color: #064e3b !important; border-color: #064e3b !important; background-color: #d1fae5 !important;}</style></head><body class="d-flex align-items-center"> <div class="container-fluid color-emerald-50"> <div class="container w-50"> <div class="vh-100 d-flex flex-row justify-content-center align-items-center"> <div class="d-flex flex-column"> <div class="card"> <div class="card-body text-center text-emerald-900"> <i class="bi bi-tags-fill" style="font-size: 5rem !important;"></i> <h1>Recover Password</h1> <hr> <p>Hello ' . $result[0]['firstName'] . ' ' . $result[0]['lastName'] . ', we\'re sending you this email because we received a request to reset the password for your account. Click on the button bellow to create a new password.</p><a href="' . $url . '" target="_blank" class="w-50 btn btn-lg btn-emerald fw-bold shadow-none">Recover</a> </div></div></div></div></div></div><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script></body></html>';
            $mail->Body = strval($body);
            $mail->send();
        } catch (Exception $e) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/forgotpassword?error=stmtfailed');
            exit();
        }
        $stmt = null;
    }
    private function isEmpty()
    {
        if (
            empty($this->email)
        ) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function emailInvalid()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}
