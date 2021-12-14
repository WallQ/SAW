<?php
    class SignIn extends Dbh {
        protected function getUser($email, $password) {
            $stmt = $this->connect()->prepare('SELECT user.password FROM user WHERE user.email = ?;');

            if(!$stmt->execute(array($email))) {
                $stmt = null;
                header('location: ../includes/signin.inc.php?error=stmtfailed');
                exit();
            }

            if($stmt->rowCount() === 0) {
                $stmt = null;
                header('location: ../includes/signin.inc.php?error=notfound');
                exit();
            }

            $passwordHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $comparePassword = password_verify($password, $passwordHashed[0]['password']);

            if(!$comparePassword) {
                $stmt = null;
                header('location: ../includes/signin.inc.php?error=wrong');
                exit();
            } elseif($comparePassword) {
                $stmt = $this->connect()->prepare('SELECT * FROM user WHERE user.email = ?;');

                if(!$stmt->execute(array($email))) {
                    $stmt = null;
                    header('location: ../includes/signin.inc.php?error=stmtfailed');
                    exit();
                }

                if($stmt->rowCount() === 0) {
                    $stmt = null;
                    header('location: ../includes/signin.inc.php?error=notfound');
                    exit();
                }

                $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

                session_start();
                $_SESSION['id'] = $user[0]['id'];
                $_SESSION['studentCode'] = $user[0]['studentCode'];
                $_SESSION['email'] = $user[0]['email'];
                if(isset($_POST["remember"])) {
                    setcookie ("email",$email,time()+ 1800);
                    setcookie ("password",base64_encode($password),time()+ 1800);
                } else {
                    setcookie("email","");
                    setcookie("password","");
                }
            }

            $stmt = null;
        }
    }
?>