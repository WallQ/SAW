<?php
class Product extends Database
{
    public function __construct()
    {
    }

    public function getProduct($productID)
    {
        $stmt = $this->connect()->prepare('SELECT p.id, p.name, p.price, p.date, p.description, u.firstName, u.lastName, u.telephone, u.city, u.imagePath, u.createdDate FROM product AS p INNER JOIN user AS u ON p.user_id = u.id WHERE p.id = ?');
        if (!$stmt->execute(array($productID))) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/homepage?error=stmtfailed');
            exit();
        }
        if ($stmt->rowCount() === 0) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/homepage?error');
            exit();
        } else {
            $result = $stmt->fetchAll();
        }

        $stmt = $this->connect()->prepare('SELECT fileName FROM productimage WHERE product_id = ?;');
        if (!$stmt->execute(array($productID))) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/homepage?error=stmtfailed');
            exit();
        }
        if ($stmt->rowCount() > 0) {
            $result2 = $stmt->fetchAll();
        } else {
            $stmt = null;
            header('location:' . HOME_URL_PREFIX . '/homepage?error');
            exit();
        }

        $result[0] += ['path' => $result2];

        $stmt = null;
        return $result;
    }
}
