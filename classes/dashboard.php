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
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/dashboard?error=stmtfailed');
            exit();
        }
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll();
        } else {
            $result = NULL;
        }
        $stmt = null;
        return $result;
    }

    public function setStatus($userID)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM user WHERE id = ?;');
        if (!$stmt->execute(array($userID))) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/dashboard?error=stmtfailed');
            exit();
        }
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll();
        } else {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/dashboard?error=notfound');
            exit();
        }
        if ($result[0]['status'] === 'Allowed') {
            $stmt = $this->connect()->prepare('UPDATE user SET status = "Blocked" WHERE id = ? LIMIT 1;');
            if (!$stmt->execute(array($userID))) {
                $stmt = null;
                header('location: ' . HOME_URL_PREFIX . '/dashboard?error=stmtfailed');
                exit();
            }
        } else if ($result[0]['status'] === 'Blocked') {
            $stmt = $this->connect()->prepare('UPDATE user SET status = "Allowed" WHERE id = ? LIMIT 1;');
            if (!$stmt->execute(array($userID))) {
                $stmt = null;
                header('location: ' . HOME_URL_PREFIX . '/dashboard?error=stmtfailed');
                exit();
            }
        }
        $stmt = null;
        return $result;
    }

    public function deleteUser($userID)
    {
        $stmt = $this->connect()->prepare('DELETE FROM user WHERE id = ?;');
        if (!$stmt->execute(array($userID))) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/dashboard?error=stmtfailed');
            exit();
        }
        $stmt = null;
    }
}
?>