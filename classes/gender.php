<?php
class Gender extends Database
{
    public function __construct()
    {
    }

    public function getGenders()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM gender ORDER BY gender ASC;');
        if (!$stmt->execute()) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/homepage?error=stmtfailed');
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
}
