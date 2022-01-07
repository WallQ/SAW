<?php
class Account extends Database
{
    public function __construct()
    {
    }

    public function getUser($userID, $userEmail)
    {
        $stmt = $this->connect()->prepare('SELECT firstName, lastName, telephone, city, zipCode, imagePath, state_id, gender_id FROM user WHERE id = ? AND email = ? LIMIT 1;');
        if (!$stmt->execute(array($userID, $userEmail))) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/homepage?error=stmtfailed');
            exit();
        }
        if ($stmt->rowCount() === 0) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/signin?error');
            exit();
        } else {
            $result = $stmt->fetchAll();
        }

        $stmt = null;
        return $result;
    }
}
