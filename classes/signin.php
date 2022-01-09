<?php
class SignIn extends Database
{
    private $firstName;
    private $lastName;
    private $telephone;
    private $gender;
    private $state;
    private $city;
    private $zipCode;
    private $email;
    private $password;
    private $verifyPassword;

    public function __construct($data)
    {
        $this->email = $data['email'];
        $this->password = $data['password'];
    }

    public function signinUser()
    {
        if ($this->isEmpty()) {
            header('location:' . HOME_URL_PREFIX . '/signin?error=inputs');
            exit();
        }
        if ($this->emailInvalid()) {
            header('location:' . HOME_URL_PREFIX . '/signin?error=email');
            exit();
        }
        if ($this->passwordInvalid()) {
            header('location:' . HOME_URL_PREFIX . '/signin?error=password');
            exit();
        }
        $stmt = $this->connect()->prepare('SELECT user.password FROM user WHERE user.email = ?;');
        if (!$stmt->execute(array($this->email))) {
            $stmt = null;
            header('location:' . HOME_URL_PREFIX . '/signin?error=stmtfailed');
            exit();
        }

        if ($stmt->rowCount() === 0) {
            $stmt = null;
            header('location:' . HOME_URL_PREFIX . '/signin?error=notfound');
            exit();
        }
        
        $passwordHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $comparePassword = password_verify($this->password, $passwordHashed[0]['password']);

        if (!$comparePassword) {
            $stmt = null;
            header('location:' . HOME_URL_PREFIX . '/signin?error=wrong');
            exit();
        } else {
            $stmt = $this->connect()->prepare('SELECT * FROM user WHERE user.email = ?;');

            if (!$stmt->execute(array($this->email))) {
                $stmt = null;
                header('location:' . HOME_URL_PREFIX . '/signin?error=stmtfailed');
                exit();
            }

            if ($stmt->rowCount() === 0) {
                $stmt = null;
                header('location:' . HOME_URL_PREFIX . '/signin?error=notfound');
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['id'] = $user[0]['id'];
            $_SESSION['email'] = $user[0]['email'];
            $_SESSION['level'] = $user[0]['level'];
            $_SESSION['logged'] = TRUE;
        }
        $stmt = null;
    }
    private function isEmpty()
    {
        if (
            empty($this->email) ||
            empty($this->password)
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
}
