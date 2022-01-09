<?php
class Newsletter extends Database
{
    private $name;
    private $email;

    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
    }

    public function subscribe()
    {
        if ($this->isEmpty()) {
            header('location: ' . HOME_URL_PREFIX . '/homepage?error=inputs');
            exit();
        }
        if ($this->firstNameInvalid()) {
            header('location: ' . HOME_URL_PREFIX . '/homepage?error=firstname');
            exit();
        }
        if ($this->emailInvalid()) {
            header('location: ' . HOME_URL_PREFIX . '/homepage?error=email');
            exit();
        }
        $stmt = $this->connect()->prepare('SELECT * FROM newsletter WHERE email = ?;');
        if (!$stmt->execute(array($this->email))) {
            $stmt = null;
            header('location:' . HOME_URL_PREFIX . '/homepage?error=stmtfailed');
            exit();
        }

        if ($stmt->rowCount() === 0) {
            $stmt = $this->connect()->prepare('INSERT INTO newsletter (name, email) VALUES (?, ?);');
            if (!$stmt->execute(array($this->name,$this->email))) {
                $stmt = null;
                header('location: ' . HOME_URL_PREFIX . '/homepage?error=stmtfailed');
                exit();
            }
        }


        $stmt = null;
    }

    private function isEmpty()
    {
        if (
            empty($this->name) ||
            empty($this->email)
        ) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function firstNameInvalid()
    {
        if (!preg_match('/^[\p{L}]{3,}/ui', $this->name)) {
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
