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
            $this->log('Error','SELECT','User information returned unsuccessfully! ('.$_SESSION['email'].')');
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/homepage?error=stmtfailed');
            exit();
        }
        if ($stmt->rowCount() === 0) {
            $this->log('Error','SELECT','User information returned unsuccessfully! ('.$_SESSION['email'].')');
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/signin?error');
            exit();
        } else {
            $result = $stmt->fetchAll();
        }
        $this->log('Log','SELECT','User information returned successfully! ('.$_SESSION['email'].')');
        $stmt = null;
        return $result;
    }

    public function updateUser($data)
    {
        if ($this->isEmpty($data)) {
            header('location: ' . HOME_URL_PREFIX . '/account?error=inputs');
            exit();
        }
        if ($this->firstNameInvalid($data['firstName'])) {
            header('location: ' . HOME_URL_PREFIX . '/account?error=firstname');
            exit();
        }
        if ($this->lastNameInvalid($data['lastName'])) {
            header('location: ' . HOME_URL_PREFIX . '/account?error=lastname');
            exit();
        }
        if ($this->telephoneInvalid($data['telephone'])) {
            header('location: ' . HOME_URL_PREFIX . '/account?error=telephone');
            exit();
        }
        if ($this->genderInvalid($data['gender'])) {
            header('location: ' . HOME_URL_PREFIX . '/account?error=gender');
            exit();
        }
        if ($this->stateInvalid($data['state'])) {
            header('location: ' . HOME_URL_PREFIX . '/account?error=state');
            exit();
        }
        if ($this->cityInvalid($data['city'])) {
            header('location: ' . HOME_URL_PREFIX . '/account?error=city');
            exit();
        }
        if ($this->zipCodeInvalid($data['zipCode'])) {
            header('location: ' . HOME_URL_PREFIX . '/account?error=zipcode');
            exit();
        }
        if ($data['image']['size'] === 0) {
            $stmt = $this->connect()->prepare('UPDATE user SET firstName = ?, lastName = ?, telephone = ?, gender_id = ?, state_id = ?, city = ?, zipCode = ? WHERE id = ?;');
            if (!$stmt->execute(array($data['firstName'], $data['lastName'], $data['telephone'], $data['gender'], $data['state'], $data['city'], $data['zipCode'], $data['id']))) {
                $this->log('Error','SELECT','User information updated unsuccessfully! ('.$_SESSION['email'].')');
                $stmt = null;
                header('location: ' . HOME_URL_PREFIX . '/account?error=stmtfailed');
                exit();
            }
        } else {
            if ($this->isUploadInvalid($data['image'])) {
                header('location:' . HOME_URL_PREFIX . '/account?error=upload');
                exit();
            }
            if ($this->fileInvalid($data['image'])) {
                header('location:' . HOME_URL_PREFIX . '/account?error=file');
                exit();
            }
            if ($this->typeInvalid($data['image'])) {
                header('location:' . HOME_URL_PREFIX . '/account?error=type');
                exit();
            }
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
            $stmt = $this->connect()->prepare('SELECT imagePath FROM user WHERE id = ?;');
            if (!$stmt->execute(array($data['id']))) {
                $this->log('Error','SELECT','User information updated unsuccessfully! ('.$_SESSION['email'].')');
                $stmt = null;
                header('location: ' . HOME_URL_PREFIX . '/account?error=stmtfailed');
                exit();
            }
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetchAll();
            } else {
                $this->log('Error','SELECT','User information updated unsuccessfully! ('.$_SESSION['email'].')');
                $stmt = null;
                header('location: ' . HOME_URL_PREFIX . '/account?error=stmtfailed');
                exit();
            }
            $filePath = './assets/images/uploads/users/' . $result[0]['imagePath'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $stmt = $this->connect()->prepare('UPDATE user SET firstName = ?, lastName = ?, telephone = ?, gender_id = ?, state_id = ?, city = ?, zipCode = ?, imagePath = ? WHERE id = ?;');
            if (!$stmt->execute(array($data['firstName'], $data['lastName'], $data['telephone'], $data['gender'], $data['state'], $data['city'], $data['zipCode'], $finalFileName, $data['id']))) {
                $this->log('Error','SELECT','User information updated unsuccessfully! ('.$_SESSION['email'].')');
                $stmt = null;
                header('location: ' . HOME_URL_PREFIX . '/account?error=stmtfailed');
                exit();
            }
        }
        $this->log('Log','UPDATE','User updated successfully! ('.$_SESSION['email'].')');
        $stmt = null;
    }

    private function isEmpty($data)
    {
        if (
            empty($data['firstName']) ||
            empty($data['lastName']) ||
            empty($data['telephone']) ||
            empty($data['gender']) ||
            empty($data['state']) ||
            empty($data['city']) ||
            empty($data['zipCode']) ||
            empty($data['image']) ||
            empty($data['id'])
        ) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function firstNameInvalid($firstName)
    {
        if (!preg_match('/^[\p{L}]{3,}/ui', $firstName)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function lastNameInvalid($lastName)
    {
        if (!preg_match('/^[\p{L}]{3,}/ui', $lastName)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function telephoneInvalid($telephone)
    {
        if (!preg_match('/((255)\d{6})|((91|92|93|96)\d{7})/', $telephone)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function genderInvalid($gender)
    {
        if (!preg_match('/[0-9]+/', $gender)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function stateInvalid($state)
    {
        if (!preg_match('/[0-9]+/', $state)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function cityInvalid($city)
    {
        if (!preg_match('/^[\p{L}\p{N}_.-]{3,}/ui', $city)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function zipCodeInvalid($zipCode)
    {
        if (!preg_match('/([0-9]{4})-([0-9]{3})/', $zipCode)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function isUploadInvalid($data)
    {
        if (!file_exists($data['tmp_name']) || !is_uploaded_file($data['tmp_name'])) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function fileInvalid($data)
    {
        $fileError = $data['error'];
        if ($fileError !== 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function typeInvalid($data)
    {
        $extensions = array('jpeg', 'jpg');
        $fileName = $data['name'];
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        if (!in_array($extension, $extensions)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}
