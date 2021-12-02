<?php
    class SignUp extends Dbh {
        protected function setUser(
            $studentCode,
            $firstName,
            $lastName,
            $gender,
            $telephone,
            $course,
            $email,
            $password,
            $createdDate
        ) {
            $stmt = $this->connect()->prepare('INSERT INTO user (studentCode,firstName,lastName,gender,telephone,course,email,password,createdDate) VALUES (?,?,?,?,?,?,?,?,?);');

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

            if(!$stmt->execute(array($studentCode,$firstName,$lastName,$gender,$telephone,$course,$email,$hashedPassword,$createdDate))) {
                $stmt = null;
                header('location: ../index.php?error=stmtfailed');
                exit();
            }

            $stmt = null;
        }

        protected function verifyUser($studentCode, $email) {
            $stmt = $this->connect()->prepare('SELECT user.id FROM user WHERE user.studentCode = ? OR user.email = ? LIMIT 1;');

            if(!$stmt->execute(array($studentCode, $email))) {
                $stmt = null;
                header('location: ../index.php?error=stmtfailed');
                exit();
            }

            $result = true;
            if($stmt->rowCount() > 0) {
                $resultCheck = true;
            } else {
                $resultCheck = false;
            }

            return $resultCheck;
        }
    }
?>