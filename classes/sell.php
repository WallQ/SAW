<?php
class Sell extends Database
{
    private $name;
    private $category;
    private $files;
    private $price;
    private $description;
    private $user;

    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->category = $data['category'];
        $this->files = $data['images'];
        $this->price = $data['price'];
        $this->description = $data['description'];
        $this->user = $data['user'];
    }

    public function sellProduct()
    {
        if ($this->isEmpty()) {
            header('location:' . HOME_URL_PREFIX . '/sell?error=inputs');
            exit();
        }
        if ($this->isUploadInvalid()) {
            header('location:' . HOME_URL_PREFIX . '/sell?error=upload');
            exit();
        }
        if ($this->fileInvalid()) {
            header('location:' . HOME_URL_PREFIX . '/sell?error=file');
            exit();
        }
        if ($this->typeInvalid()) {
            header('location:' . HOME_URL_PREFIX . '/sell?error=type');
            exit();
        }
        if ($this->sizeInvalid()) {
            header('location:' . HOME_URL_PREFIX . '/sell?error=size');
            exit();
        }
        if ($this->priceInvalid()) {
            header('location:' . HOME_URL_PREFIX . '/sell?error=price');
            exit();
        }
        $stmt = $this->connect()->prepare('INSERT INTO product (name, price, description, category_id, user_id) VALUES (?, ?, ?, ?, ?);');
        if (!$stmt->execute(array($this->name, $this->price, $this->description, $this->category, $this->user))) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/sell?error=stmtfailed');
            exit();
        }
        $stmt = null;
        $productId = $this->connect()->lastInsertId();
        foreach ($this->files['tmp_name'] as $key => $value) {
            $fileName = $this->files['name'][$key];
            $fileNameTemp = $this->files['tmp_name'][$key];
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
    private function isEmpty()
    {
        if (
            empty($this->name) ||
            empty($this->category) ||
            empty($this->files) ||
            empty($this->price) ||
            empty($this->description) ||
            empty($this->user)
        ) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    private function isUploadInvalid()
    {
        foreach ($this->files['tmp_name'] as $key => $value) {
            if (!file_exists($this->files['tmp_name'][$key]) || !is_uploaded_file($this->files['tmp_name'][$key])) {
                $result = true;
                break;
            } else {
                $result = false;
            }
        }
        return $result;
    }
    private function fileInvalid()
    {
        foreach ($this->files['tmp_name'] as $key => $value) {
            $fileError = $this->files['error'][$key];
            if ($fileError !== 0) {
                $result = true;
                break;
            } else {
                $result = false;
            }
        }
        return $result;
    }
    private function typeInvalid()
    {
        $extensions = array('jpeg', 'jpg');
        foreach ($this->files['tmp_name'] as $key => $value) {
            $fileName = $this->files['name'][$key];
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
    private function sizeInvalid()
    {
        foreach ($this->files['tmp_name'] as $key => $value) {
            $fileSize = $this->files['size'][$key];
            if ($fileSize > 2097152) {
                $result = true;
                break;
            } else {
                $result = false;
            }
        }
        return $result;
    }
    private function priceInvalid()
    {
        if (!preg_match('/[0-9]+/', $this->price)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}
