<?php
class State extends Database
{
    public function __construct()
    {
    }

    public function getStates()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM state;');
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
