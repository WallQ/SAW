<?php
class Sell extends Database
{

    public function __construct()
    {
    }

    public function sellProduct($data)
    {
        if ($this->isEmpty($data)) {
            header('location:' . HOME_URL_PREFIX . '/sell?error=inputs');
            exit();
        }
        if ($this->isUploadInvalid($data['images'])) {
            header('location:' . HOME_URL_PREFIX . '/sell?error=upload');
            exit();
        }
        if ($this->fileInvalid($data['images'])) {
            header('location:' . HOME_URL_PREFIX . '/sell?error=file');
            exit();
        }
        if ($this->typeInvalid($data['images'])) {
            header('location:' . HOME_URL_PREFIX . '/sell?error=type');
            exit();
        }
        if ($this->sizeInvalid($data['images'])) {
            header('location:' . HOME_URL_PREFIX . '/sell?error=size');
            exit();
        }
        if ($this->priceInvalid($data['price'])) {
            header('location:' . HOME_URL_PREFIX . '/sell?error=price');
            exit();
        }
        $stmt = $this->connect()->prepare('INSERT INTO product (name, price, description, category_id, user_id) VALUES (?, ?, ?, ?, ?);');
        if (!$stmt->execute(array($data['name'], $data['price'], $data['description'], $data['category'], $data['id']))) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/sell?error=stmtfailed');
            exit();
        }
        $stmt = null;
        $productId = $this->connect()->lastInsertId();
        foreach ($data['images']['tmp_name'] as $key => $value) {
            $fileName = $data['images']['name'][$key];
            $fileNameTemp = $data['images']['tmp_name'][$key];
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            $finalFileName = uniqid(rand(), true) . '.' . $extension;
            $path = './assets/images/uploads/products/' . $finalFileName;
            if (!move_uploaded_file($fileNameTemp, $path)) {
                $stmt = null;
                header('location: ' . HOME_URL_PREFIX . '/sell?error=stmtfailed');
                exit();
            }
            $stmt = $this->connect()->prepare('INSERT INTO productimage (fileName, product_id) VALUES (?, ?);');
            if (!$stmt->execute(array($finalFileName, $productId))) {
                $stmt = null;
                header('location: ' . HOME_URL_PREFIX . '/sell?error=stmtfailed');
                exit();
            }
        }
        $stmt = null;
    }
    public function sellProductEdit($data, $productID)
    {
        if ($this->isEmpty($data)) {
            header('location:' . HOME_URL_PREFIX . '/sell?error=inputs');
            exit();
        }
        if ($this->isUploadInvalid($data['images'])) {
            header('location:' . HOME_URL_PREFIX . '/sell?error=upload');
            exit();
        }
        if ($this->fileInvalid($data['images'])) {
            header('location:' . HOME_URL_PREFIX . '/sell?error=file');
            exit();
        }
        if ($this->typeInvalid($data['images'])) {
            header('location:' . HOME_URL_PREFIX . '/sell?error=type');
            exit();
        }
        if ($this->sizeInvalid($data['images'])) {
            header('location:' . HOME_URL_PREFIX . '/sell?error=size');
            exit();
        }
        if ($this->priceInvalid($data['price'])) {
            header('location:' . HOME_URL_PREFIX . '/sell?error=price');
            exit();
        }
        $stmt = $this->connect()->prepare('UPDATE product SET name = ?, price = ?, date = ?, description = ?, category_id = ? WHERE id = ?;');
        if (!$stmt->execute(array($data['name'], $data['price'], date('Y-m-d H:i:s'), $data['description'], $data['category'], $productID))) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/sell?error=stmtfailed');
            exit();
        }
        $stmt = null;
        foreach ($data['images']['tmp_name'] as $key => $value) {
            $fileName = $data['images']['name'][$key];
            $fileNameTemp = $data['images']['tmp_name'][$key];
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            $finalFileName = uniqid(rand(), true) . '.' . $extension;
            $path = './assets/images/uploads/products/' . $finalFileName;
            if (!move_uploaded_file($fileNameTemp, $path)) {
                $stmt = null;
                header('location: ' . HOME_URL_PREFIX . '/sell?error=stmtfailed');
                exit();
            }
            $stmt = $this->connect()->prepare('INSERT INTO productimage (fileName, product_id) VALUES (?, ?);');
            if (!$stmt->execute(array($finalFileName, $productID))) {
                $stmt = null;
                header('location: ' . HOME_URL_PREFIX . '/sell?error=stmtfailed');
                exit();
            }
        }
        $stmt = null;
    }
    public function getProduct($productID, $userID)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM product WHERE id = ? AND user_id = ?;');
        if (!$stmt->execute(array($productID, $userID))) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/sell?error=stmtfailed');
            exit();
        }
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll();
        } else {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/myproducts?error=stmtfailed');
            exit();
        }
        $stmt = null;
        return $result;
    }
    private function isEmpty($data)
    {
        if (
            empty($data['name']) ||
            empty($data['category']) ||
            empty($data['images']) ||
            empty($data['price']) ||
            empty($data['description']) ||
            empty($data['id'])
        ) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function isUploadInvalid($files)
    {
        foreach ($files['tmp_name'] as $key => $value) {
            if (!file_exists($files['tmp_name'][$key]) || !is_uploaded_file($files['tmp_name'][$key])) {
                $result = true;
                break;
            } else {
                $result = false;
            }
        }
        return $result;
    }
    private function fileInvalid($files)
    {
        foreach ($files['tmp_name'] as $key => $value) {
            $fileError = $files['error'][$key];
            if ($fileError !== 0) {
                $result = true;
                break;
            } else {
                $result = false;
            }
        }
        return $result;
    }
    private function typeInvalid($files)
    {
        $extensions = array('jpeg', 'jpg');
        foreach ($files['tmp_name'] as $key => $value) {
            $fileName = $files['name'][$key];
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            if (!in_array($extension, $extensions)) {
                $result = true;
                break;
            } else {
                $result = false;
            }
        }
        return $result;
    }
    private function sizeInvalid($files)
    {
        foreach ($files['tmp_name'] as $key => $value) {
            $fileSize = $files['size'][$key];
            if ($fileSize > 2097152) {
                $result = true;
                break;
            } else {
                $result = false;
            }
        }
        return $result;
    }
    private function priceInvalid($price)
    {
        if (!preg_match('/[0-9]+/', $price)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}
