<?php
    class SignUp extends Dbh {
        protected function setUser(
            $firstName,
            $lastName,
            $gender,
            $telephone,
            $location,
            $email,
            $password,
            $createdDate
        ) {
            $stmt = $this->connect()->prepare('INSERT INTO user (studentCode,firstName,lastName,gender,telephone,course,email,password,createdDate) VALUES (?,?,?,?,?,?,?,?,?);');

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

            if(!$stmt->execute(array($firstName,$lastName,$gender,$telephone,$location,$email,$hashedPassword,$createdDate))) {
                $stmt = null;
                header('location: ../includes/signup.inc.php?error=stmtfailed');
                exit();
            }

            $stmt = null;
        }

        protected function verifyUser($email) {
            $stmt = $this->connect()->prepare('SELECT user.id FROM user WHERE user.email = ? LIMIT 1;');

            if(!$stmt->execute(array($email))) {
                $stmt = null;
                header('location: ../includes/signup.inc.php?error=stmtfailed');
                exit();
            }

            $result = true;
            if($stmt->rowCount() !== 0) {
                $result = true;
            } else {
                $result = false;
            }

            return $result;
        }
    }
?>