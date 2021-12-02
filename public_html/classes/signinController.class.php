<?php
    class SignInController extends SignIn {
        private $email;
        private $password;

        public function __construct($data) {
            $this->email = $data['email'];
            $this->password = $data['password'];
        }

        public function signinUser() {
            if($this->isEmpty()) {
                header('location: ../index.php?error=inputs');
                exit();
            }
            if($this->emailInvalid()) {
                header('location: ../index.php?error=email');
                exit();
            }
            if($this->passwordInvalid()) {
                header('location: ../index.php?error=password');
                exit();
            }
            $this->getUser($this->email, $this->password);
        }

        private function isEmpty() {
            $result = false;
            if(empty($this->email) || empty($this->password)) {
                $result = true;
            } else {
                $result = false;
            }
        }
        private function emailInvalid() {
            $result = true;
            if(!filter_var($this->email , FILTER_VALIDATE_EMAIL)) {
                $result = true;
            } else {
                $result = false;
            }
        }
        private function passwordInvalid() {
            $result = true;
            if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[a-zA-Z\d@$!%*?&]{8,}/', $this->password)) {
                $result = true;
            } else {
                $result = false;
            }
        }
    }
?>