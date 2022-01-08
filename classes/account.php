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

    public function updateUser($data)
    {
        if($data['image']['size'] === 0) {
            $stmt = $this->connect()->prepare('UPDATE user SET firstName = ?, lastName = ?, telephone = ?, gender_id = ?, state_id = ?, city = ?, zipCode = ? WHERE id = ?;');
            if (!$stmt->execute(array($data['firstName'],$data['lastName'],$data['telephone'],$data['gender'],$data['state'],$data['city'],$data['zipCode'],$data['id']))) {
                $stmt = null;
                header('location: ' . HOME_URL_PREFIX . '/account?error=stmtfailed');
                exit();
            }
        } else {
            $fileName = $data['image']['name'];
            $fileNameTemp = $data['image']['tmp_name'];
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            $finalFileName = uniqid(rand(), true) . '.' . $extension;
            $path = './assets/images/uploads/users/' . $finalFileName;
            if (!move_uploaded_file($fileNameTemp, $path)) {
                $stmt = null;
                header('location: ' . HOME_URL_PREFIX . '/account?error=stmtfailed');
                exit();
            }
            $stmt = $this->connect()->prepare('UPDATE user SET firstName = ?, lastName = ?, telephone = ?, gender_id = ?, state_id = ?, city = ?, zipCode = ?, imagePath = ? WHERE id = ?;');
            if (!$stmt->execute(array($data['firstName'],$data['lastName'],$data['telephone'],$data['gender'],$data['state'],$data['city'],$data['zipCode'],$finalFileName,$data['id']))) {
                $stmt = null;
                header('location: ' . HOME_URL_PREFIX . '/account?error=stmtfailed');
                exit();
            }
        }
        $stmt = null;
    }
}
