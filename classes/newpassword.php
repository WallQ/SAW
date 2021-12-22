<?php
class NewPassword extends Database
{
    private $email;
    private $token;
    private $password;
    private $verifyPassword;

    public function __construct($data)
    {
        $this->email = $data['email'];
        $this->token = $data['token'];
        $this->password = $data['password'];
        $this->verifyPassword = $data['verifyPassword'];
    }

    public function requestNewPassword()
    {
        if ($this->isEmpty()) {
            header('location: ' . HOME_URL_PREFIX . '/forgotpassword');
            exit();
        }
        if ($this->emailInvalid()) {
            header('location: ' . HOME_URL_PREFIX . '/forgotpassword');
            exit();
        }
        if ($this->passwordInvalid()) {
            header('location: ' . HOME_URL_PREFIX . '/newpassword?email=' . $this->email . '&token=' . $this->token . '&error=password');
            exit();
        }
        if ($this->passwordMismatched()) {
            header('location: ' . HOME_URL_PREFIX . '/newpassword?email=' . $this->email . '&token=' . $this->token . '&error=match');
            exit();
        }
        $date = date('Y-m-d H:i:s');
        $stmt = $this->connect()->prepare('SELECT * FROM forgotpassword WHERE email = ? AND date >= ?;');
        if (!$stmt->execute(array($this->email, $date))) {
            $stmt = null;
            header('location:' . HOME_URL_PREFIX . '/newpassword?email=' . $this->email . '&token=' . $this->token . '&error=stmtfailed');
            exit();
        }
        if ($stmt->rowCount() === 0) {
            $stmt = null;
            header('location:' . HOME_URL_PREFIX . '/newpassword?email=' . $this->email . '&token=' . $this->token . '&error=request1');
            exit();
        } else {
            $result = $stmt->fetchAll();
        }
        $tokenBin = hex2bin($this->token);
        $tokenCheck = password_verify($tokenBin, $result[0]['token']);
        if (!$tokenCheck) {
            $stmt = null;
            header('location:' . HOME_URL_PREFIX . '/newpassword?email=' . $this->email . '&token=' . $this->token . '&error=request2');
            exit();
        }
        $stmt = $this->connect()->prepare('SELECT * FROM user WHERE email = ? LIMIT 1;');
        if (!$stmt->execute(array($this->email))) {
            $stmt = null;
            header('location:' . HOME_URL_PREFIX . '/newpassword?email=' . $this->email . '&token=' . $this->token . '&error=stmtfailed');
            exit();
        }
        if ($stmt->rowCount() === 0) {
            $stmt = null;
            header('location:' . HOME_URL_PREFIX . '/newpassword?email=' . $this->email . '&token=' . $this->token . '&error=notfound');
            exit();
        } else {
            $result = $stmt->fetchAll();
        }
        $stmt = $this->connect()->prepare('UPDATE user SET password = ? WHERE email = ?;');
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT, ['cost' => 12]);
        if (!$stmt->execute(array($hashedPassword, $this->email))) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/newpassword?email=' . $this->email . '&token=' . $this->token . '&error=stmtfailed');
            exit();
        }
        $stmt = null;
    }

    private function isEmpty()
    {
        if (
            empty($this->email) ||
            empty($this->token) ||
            empty($this->password) ||
            empty($this->verifyPassword)
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
    private function passwordInvalid()
    {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[a-zA-Z\d@$!%*?&]{8,}/', $this->password)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function passwordMismatched()
    {
        if ($this->password !== $this->verifyPassword) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}
