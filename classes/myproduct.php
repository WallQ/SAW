<?php
class MyProduct extends Database
{
    public function __construct()
    {
    }

    public function getMyProducts($userID)
    {
        $stmt = $this->connect()->prepare('SELECT p.id, p.name, p.price, p.data, p.description, i.fileName, c.category, c.id as categoryId FROM product AS p INNER JOIN productimage AS i ON i.id = (SELECT id FROM productimage AS i2 WHERE i2.product_id = p.id LIMIT 1) INNER JOIN category AS c ON p.category_id = c.id WHERE p.user_id = ? ORDER BY p.data DESC;');
        if (!$stmt->execute(array($userID))) {
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
