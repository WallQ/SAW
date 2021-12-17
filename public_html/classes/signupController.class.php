<?php
class SignUpController extends SignUp
{
    private $firstName;
    private $lastName;
    private $gender;
    private $telephone;
    private $location;
    private $email;
    private $password;
    private $verifyPassword;
    private $level;
    private $status;
    private $createdDate;

    public function __construct($data)
    {
        $this->firstName = $data['firstName'];
        $this->lastName = $data['lastName'];
        $this->gender = $data['gender'];
        $this->telephone = $data['telephone'];
        $this->location = $data['location'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->verifyPassword = $data['verifyPassword'];
        $this->createdDate = date('Y-m-d H:i:s');
    }

    public function signupUser()
    {
        if ($this->isEmpty()) {
            header('location: ../includes/signup.inc.php?error=inputs');
            exit();
        }
        if ($this->firstNameInvalid()) {
            header('location: ../includes/signup.inc.php?error=firstname');
            exit();
        }
        if ($this->lastNameInvalid()) {
            header('location: ../includes/signup.inc.php?error=lastname');
            exit();
        }
        if ($this->genderInvalid()) {
            header('location: ../includes/signup.inc.php?error=gender');
            exit();
        }
        if ($this->telephoneInvalid()) {
            header('location: ../includes/signup.inc.php?error=telephone');
            exit();
        }
        if ($this->locationInvalid()) {
            header('location: ../includes/signup.inc.php?error=location');
            exit();
        }
        if ($this->emailInvalid()) {
            header('location: ../includes/signup.inc.php?error=email');
            exit();
        }
        if ($this->passwordInvalid()) {
            header('location: ../includes/signup.inc.php?error=password');
            exit();
        }
        if ($this->passwordMismatched()) {
            header('location: ../includes/signup.inc.php?error=match');
            exit();
        }
        if ($this->userTaken()) {
            header('location: ../includes/signup.inc.php?error=taken');
            exit();
        }
        $this->setUser(
            $this->firstName,
            $this->lastName,
            $this->gender,
            $this->telephone,
            $this->location,
            $this->email,
            $this->password,
            $this->createdDate
        );
    }

    private function isEmpty()
    {
        $result = true;
        if (
            empty($this->firstName) ||
            empty($this->lastName) ||
            empty($this->gender) ||
            empty($this->telephone) ||
            empty($this->location) ||
            empty($this->email) ||
            empty($this->password) ||
            empty($this->verifyPassword) ||
            empty($this->createdDate)
        ) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function firstNameInvalid()
    {
        $result = true;
        if (!preg_match('/^[\p{L}]{3,}/ui', $this->firstName)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function lastNameInvalid()
    {
        $result = true;
        if (!preg_match('/^[\p{L}]{3,}/ui', $this->lastName)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function genderInvalid()
    {
        $result = true;
        if (!preg_match('/^([M,F,O]){1}/', $this->gender)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function telephoneInvalid()
    {
        $result = true;
        if (!preg_match('/((255)\d{6})|((91|92|93|96)\d{7})/', $this->telephone)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function locationInvalid()
    {
        $result = true;
        if (!preg_match('/^[\p{L}\p{N}_.-]{3,}/ui', $this->location)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function emailInvalid()
    {
        $result = true;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function passwordInvalid()
    {
        $result = true;
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[a-zA-Z\d@$!%*?&]{8,}/', $this->password)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function passwordMismatched()
    {
        $result = true;
        if ($this->password !== $this->verifyPassword) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function userTaken()
    {
        $result = true;
        if ($this->verifyUser($this->email)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}
