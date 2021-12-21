<?php
class Homepage extends Database
{
    public function __construct()
    {
    }

    public function getProducts($resultsPerPage, $firstElement)
    {
        $stmt = $this->connect()->prepare('SELECT p.id, p.name, p.price, p.data, i.fileName, u.city FROM product AS p INNER JOIN productimage AS i ON i.id = (SELECT id FROM productimage AS i2 WHERE i2.product_id = p.id LIMIT 1) INNER JOIN user AS u ON p.user_id = u.id ORDER BY p.data DESC LIMIT ?,?;');
        if (!$stmt->execute(array($firstElement, $resultsPerPage))) {
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

    public function getProductsByCategory($categoryId, $resultsPerPage, $firstElement)
    {
        $stmt = $this->connect()->prepare('SELECT p.id, p.name, p.price, p.data, i.fileName, u.city FROM product AS p INNER JOIN productimage AS i ON i.id = (SELECT id FROM productimage AS i2 WHERE i2.product_id = p.id LIMIT 1) INNER JOIN user AS u ON p.user_id = u.id WHERE p.category_id = ? ORDER BY p.data DESC LIMIT ?,?;');
        if (!$stmt->execute(array($categoryId, $firstElement, $resultsPerPage))) {
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

    public function getNumberOfProducts()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM product;');
        if (!$stmt->execute()) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/homepage?error=stmtfailed');
            exit();
        }
        $result = $stmt->rowCount();
        $stmt = null;
        return $result;
    }
}
