<?php
class MyProduct extends Database
{
    public function __construct()
    {
    }

    public function getMyProducts($userID)
    {
        $stmt = $this->connect()->prepare('SELECT p.id, p.name, p.price, p.date, p.description, i.fileName, c.category, c.id as categoryId FROM product AS p INNER JOIN productimage AS i ON i.id = (SELECT id FROM productimage AS i2 WHERE i2.product_id = p.id LIMIT 1) INNER JOIN category AS c ON p.category_id = c.id WHERE p.user_id = ? ORDER BY p.date DESC;');
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

    public function deleteProducts($productID, $userID)
    {
        $stmt = $this->connect()->prepare('SELECT id FROM product WHERE product.id = ? AND product.user_id = ?;');
        if (!$stmt->execute(array($productID, $userID))) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/myproducts?error=stmtfailed');
            exit();
        }
        if ($stmt->rowCount() === 0) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/myproducts?error=stmtfailed');
            exit();
        }
        $stmt = $this->connect()->prepare('SELECT fileName FROM productimage WHERE productimage.product_id = ?;');
        if (!$stmt->execute(array($productID))) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/myproducts?error=stmtfailed');
            exit();
        }
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll();
        } else {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/myproducts?error=stmtfailed');
            exit();
        }
        $stmt = $this->connect()->prepare('DELETE FROM product WHERE product.id = ? AND product.user_id = ?;');
        if (!$stmt->execute(array($productID, $userID))) {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/myproducts?error=stmtfailed');
            exit();
        }
        if ($stmt->rowCount() > 0) {
            foreach ($result as $key => $value) {
                $filePath = './assets/images/uploads/products/' . $value['fileName'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        } else {
            $stmt = null;
            header('location: ' . HOME_URL_PREFIX . '/myproducts?error=stmtfailed');
            exit();
        }
        $this->log('Log','DELETE','Product deleted successfully! ('.$_SESSION['email'].')');
        $stmt = null;
    }
}
