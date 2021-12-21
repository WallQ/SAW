<?php
class Homepage extends Database
{
    public function __construct()
    {
    }

    public function getCategories()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM category;');
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

    public function getProducts()
    {
        $stmt = $this->connect()->prepare('SELECT p.id, p.name, p.price, p.data, i.fileName, u.city FROM product AS p INNER JOIN productimage AS i ON i.id = (SELECT id FROM productimage AS i2 WHERE i2.product_id = p.id LIMIT 1) INNER JOIN user AS u ON p.user_id = u.id;');
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
