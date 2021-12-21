<?php
class SignUp extends Database
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
        $this->firstName = $data['firstName'];
        $this->lastName = $data['lastName'];
        $this->telephone = $data['telephone'];
        $this->gender = $data['gender'];
        $this->state = $data['state'];
        $this->city = $data['city'];
        $this->zipCode = $data['zipCode'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->verifyPassword = $data['verifyPassword'];
    }

    public function signupUser()
    {
        if ($this->isEmpty()) {
            header('location: ' . HOME_URL_PREFIX . '/signup?error=inputs');
            exit();
        }
        if ($this->firstNameInvalid()) {
            header('location: ' . HOME_URL_PREFIX . '/signup?error=firstname');
            exit();
        }
        if ($this->lastNameInvalid()) {
            header('location: ' . HOME_URL_PREFIX . '/signup?error=lastname');
            exit();
        }
        if ($this->telephoneInvalid()) {
            header('location: ' . HOME_URL_PREFIX . '/signup?error=telephone');
            exit();
        }
        if ($this->genderInvalid()) {
            header('location: ' . HOME_URL_PREFIX . '/signup?error=gender');
            exit();
        }
        if ($this->stateInvalid()) {
            header('location: ' . HOME_URL_PREFIX . '/signup?error=state');
            exit();
        }
        if ($this->cityInvalid()) {
            header('location: ' . HOME_URL_PREFIX . '/signup?error=city');
            exit();
        }
        if ($this->zipCodeInvalid()) {
            header('location: ' . HOME_URL_PREFIX . '/signup?error=zipcode');
            exit();
        }
        if ($this->emailInvalid()) {
            header('location: ' . HOME_URL_PREFIX . '/signup?error=email');
            exit();
        }
        if ($this->passwordInvalid()) {
            header('location: ' . HOME_URL_PREFIX . '/signup?error=password');
            exit();
        }
        if ($this->passwordMismatched()) {
            header('location: ' . HOME_URL_PREFIX . '/signup?error=match');
            exit();
        }
        if ($this->userTaken()) {
            header('location: ' . HOME_URL_PREFIX . '/signup?error=taken');
            exit();
        }
        $stmt = $this->connect()->prepare('INSERT INTO user (firstName, lastName, telephone, city, zipCode, email, password, state_id, gender_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);');
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT, ['cost' => 12]);
        if (!$stmt->execute(array($this->firstName, $this->lastName, $this->telephone, $this->city, $this->zipCode, $this->email, $hashedPassword, $this->state, $this->gender))) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/signup?error=stmtfailed');
            exit();
        }
        $stmt = null;
    }
    private function isEmpty()
    {
        if (
            empty($this->firstName) ||
            empty($this->lastName) ||
            empty($this->telephone) ||
            empty($this->gender) ||
            empty($this->state) ||
            empty($this->city) ||
            empty($this->zipCode) ||
            empty($this->email) ||
            empty($this->password) ||
            empty($this->verifyPassword)
        ) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function firstNameInvalid()
    {
        if (!preg_match('/^[\p{L}]{3,}/ui', $this->firstName)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function lastNameInvalid()
    {
        if (!preg_match('/^[\p{L}]{3,}/ui', $this->lastName)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function telephoneInvalid()
    {
        if (!preg_match('/((255)\d{6})|((91|92|93|96)\d{7})/', $this->telephone)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function genderInvalid()
    {
        if (!preg_match('/[0-9]+/', $this->gender)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function stateInvalid()
    {
        if (!preg_match('/[0-9]+/', $this->state)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function cityInvalid()
    {
        if (!preg_match('/^[\p{L}\p{N}_.-]{3,}/ui', $this->city)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function zipCodeInvalid()
    {
        if (!preg_match('/([0-9]{4})-([0-9]{3})/', $this->zipCode)) {
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
    private function userTaken()
    {
        $stmt = $this->connect()->prepare('SELECT user.id FROM user WHERE  user.telephone = ? OR user.email = ? LIMIT 1;');
        if (!$stmt->execute(array($this->telephone,$this->email))) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/signup?error=stmtfailed');
            exit();
        }
        if ($stmt->rowCount() !== 0) {
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }
}
