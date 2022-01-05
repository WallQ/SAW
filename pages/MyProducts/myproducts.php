<?php
if (!isset($_SESSION['logged'])) {
    header('location: ' . HOME_URL_PREFIX . '/signin');
}
$myProduct = new MyProduct();
$myProducts = $myProduct->getMyProducts($_SESSION['id']);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $cleanData = filter_var($_POST['productId'], FILTER_SANITIZE_NUMBER_INT);
    if (!$cleanData) {
        header('location: ' . HOME_URL_PREFIX . '/homepage?error');
    };
    $myProduct = $myProduct->deleteProducts($cleanData, $_SESSION['id']);
    header("Refresh:0");
}
?>
<?php if (isset($_GET['error'])) {
    include_once('./includes/error.php');
} ?>
<div class="container-fluid color-emerald-50 py-5">
    <div class="container">
        <h1 class="display-4 fw-bold text-capitalize text-center text-emerald-900">Your Products</h1>
        <div class="row mt-5">
            <?php
            if (isset($myProducts)) {
                foreach ($myProducts as $myProduct) { ?>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3">
                        <div class="card card-body card-h-2 shadow-sm p-3 card-m-tb bg-body rounded justify-content-between">
                            <a href="<?php echo HOME_URL_PREFIX; ?>/product?id=<?php echo $myProduct['id']; ?>" class="text-decoration-none">
                                <img src="./assets/images/uploads/products/<?php echo $myProduct['fileName']; ?>" class="card-img-top card-image-top" alt="" width="200" height="200" loading="lazy">
                            </a>
                            <div class="d-flex flex-column justify-content-between mt-3">
                                <a href="<?php echo HOME_URL_PREFIX; ?>/homepage?cat=<?php echo $myProduct['categoryId']; ?>" class="text-body text-decoration-none">
                                    <p class="badge btn-emerald"><?php echo $myProduct['category']; ?></p>
                                </a>
                                <a href="<?php echo HOME_URL_PREFIX; ?>/product?id=<?php echo $myProduct['id']; ?>" class="text-body text-decoration-none">
                                    <p class="card-title card-title-truncate h6 text-emerald-900"><?php echo $myProduct['name']; ?></p>
                                </a>
                                <p class="fw-normal text-emerald-900 card-text-truncate card-description-h"><?php echo $myProduct['description']; ?>
                                <div class="d-flex flex-column">
                                    <small class="text-muted"><?php echo date("j F", strtotime($myProduct['date'])); ?></small>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-emerald-900"><?php echo number_format($myProduct['price'], 2, '.'); ?>$</span>
                                        <div class="d-flex flex-row">
                                            <a href="#" class="btn btn-emerald fw-bold shadow-none me-2"><i class="bi bi-pencil-fill"></i></i></a>
                                            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                                                <input type="hidden" name="productId" value="<?php echo $myProduct['id']; ?>" required>
                                                <button type="submit" class="btn btn-emerald fw-bold shadow-none" name="submit" value="submit"><i class="bi bi-trash-fill"></i></i></a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else { ?>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                    <h1 class="display-6 text-capitalize text-center text-emerald-900">You have no products listed.</h1>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>