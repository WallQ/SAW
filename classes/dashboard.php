<?php
class Dashboard extends Database
{
    public function __construct()
    {
    }

    public function getUsers()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM user ORDER BY createdDate ASC;');
        if (!$stmt->execute()) {
            $this->log('Error','SELECT','Users information returned unsuccessfully! ('.$_SESSION['email'].')');
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/dashboard?error=stmtfailed');
            exit();
        }
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll();
        } else {
            $result = NULL;
        }
        $this->log('Log','SELECT','Users information returned successfully! ('.$_SESSION['email'].')');
        $stmt = null;
        return $result;
    }

    public function getLogs()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM log ORDER BY id ASC;');
        if (!$stmt->execute()) {
            $this->log('Error','SELECT','Logs information returned unsuccessfully! ('.$_SESSION['email'].')');
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/dashboard?error=stmtfailed');
            exit();
        }
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll();
        } else {
            $result = NULL;
        }
        $this->log('Log','SELECT','Logs information returned successfully! ('.$_SESSION['email'].')');
        $stmt = null;
        return $result;
    }

    public function setStatus($userID)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM user WHERE id = ?;');
        if (!$stmt->execute(array($userID))) {
            $this->log('Error','SELECT','Users information returned unsuccessfully! ('.$_SESSION['email'].')');
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/dashboard?error=stmtfailed');
            exit();
        }
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll();
        } else {
            $this->log('Error','SELECT','Users information returned unsuccessfully! ('.$_SESSION['email'].')');
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/dashboard?error=notfound');
            exit();
        }
        if ($result[0]['status'] === 'Allowed') {
            $stmt = $this->connect()->prepare('UPDATE user SET status = "Blocked" WHERE id = ? LIMIT 1;');
            if (!$stmt->execute(array($userID))) {
                $this->log('Error','SELECT','User status updated unsuccessfully! ('.$_SESSION['email'].')');
                $stmt = null;
                header('location: ' . HOME_URL_PREFIX . '/dashboard?error=stmtfailed');
                exit();
            }
        } else if ($result[0]['status'] === 'Blocked') {
            $stmt = $this->connect()->prepare('UPDATE user SET status = "Allowed" WHERE id = ? LIMIT 1;');
            if (!$stmt->execute(array($userID))) {
                $this->log('Error','SELECT','User status updated unsuccessfully! ('.$_SESSION['email'].')');
                $stmt = null;
                header('location: ' . HOME_URL_PREFIX . '/dashboard?error=stmtfailed');
                exit();
            }
        }
        $this->log('Log','UPDATE','User status updated successfully! ('.$_SESSION['email'].')');
        $stmt = null;
        return $result;
    }

    public function deleteUser($userID)
    {
        $stmt = $this->connect()->prepare('DELETE FROM user WHERE id = ?;');
        if (!$stmt->execute(array($userID))) {
            $this->log('Error','DELETE','User deleted successfully! ('.$_SESSION['email'].')');
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/dashboard?error=stmtfailed');
            exit();
        }
        $this->log('Log','DELETE','User deleted successfully! ('.$_SESSION['email'].')');
        $stmt = null;
    }

    public function deleteLog($logID)
    {
        $stmt = $this->connect()->prepare('DELETE FROM log WHERE id = ?;');
        if (!$stmt->execute(array($logID))) {
            $this->log('Error','DELETE','Log deleted successfully! ('.$_SESSION['email'].')');
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/dashboard?error=stmtfailed');
            exit();
        }
        $this->log('Log','DELETE','Log deleted successfully! ('.$_SESSION['email'].')');
        $stmt = null;
    }
}
?>