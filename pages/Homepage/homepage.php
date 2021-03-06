<?php
$homepage = new Homepage();
$category = new Category();
$categories = $category->getCategories();
if (isset($_GET['pag'])) {
    $cleanData = filter_var($_GET['pag'], FILTER_SANITIZE_NUMBER_INT);
    if (!$cleanData) {
        header('location: ' . HOME_URL_PREFIX . '/homepage?error');
    }
    $page = $_GET['pag'];
} else {
    $page = 1;
}
$resultsPerPage = 8;
$firstElement = ($page - 1) * $resultsPerPage;
$numberOfProducts = $homepage->getNumberOfProducts();
$numberOfPages = ceil($numberOfProducts / $resultsPerPage);
if (isset($_GET['cat'])) {
    $cleanData = filter_var($_GET['cat'], FILTER_SANITIZE_NUMBER_INT);
    if (!$cleanData) {
        header('location: ' . HOME_URL_PREFIX . '/homepage?error');
    }
    $products = $homepage->getProductsByCategory($cleanData, $resultsPerPage, $firstElement);
} else {
    $products = $homepage->getProducts($resultsPerPage, $firstElement);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $data = array(
        'name' => $_POST['name'],
        'email' => $_POST['email']
    );
    $args = array(
        'name' => FILTER_SANITIZE_STRING,
        'email' => FILTER_SANITIZE_EMAIL
    );
    $cleanData = filter_var_array($data, $args);
    if (!$cleanData) {
        header('location: ' . HOME_URL_PREFIX . '/homepage?error');
    }

    $newsletter = new Newsletter($cleanData);
    $newsletter->subscribe();
    header("Refresh:0");
}
?>
<?php if (isset($_GET['error'])) {
    include_once('./includes/error.php');
} ?>
<div class="container-fluid color-emerald-50 py-5">
    <div class="container">
        <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
            <div class="input-group input-group-lg">
                <input type="text" class="form-control shadow-none border-emerald" placeholder="Search..." name="search" required>
                <button type="submit" class="btn shadow-none bg-white border-emerald" name="submit" value="submit"><i class="bi bi-search"></i></button>
            </div>
        </form>
    </div>
</div>
<div class="container-fluid bg-body py-5">
    <div class="container">
        <h1 class="display-4 fw-bold text-capitalize text-center text-emerald-900">Categories</h1>
        <div class="row mt-5">
            <?php
            if (isset($categories)) {
                foreach ($categories as $category) { ?>
                    <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-2 col-xxl-2">
                        <div class="d-flex flex-row justify-content-center align-content-center">
                            <a href="<?php echo HOME_URL_PREFIX; ?>/homepage?cat=<?php echo $category['id']; ?>" class="text-link text-decoration-none">
                                <div class="d-flex flex-column pb-4">
                                    <img src="./assets/images/categories/<?php echo $category['fileName']; ?>" class="rounded-circle rounded-circle-top color-emerald-100" alt="<?php echo $category['category']; ?>" width="100" height="100" loading="lazy">
                                    <h5 class="text-center mt-2"><?php echo $category['category']; ?></h5>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php
                }
            } else { ?>
                <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-2 col-xxl-2">
                    <div class="d-flex flex-row justify-content-center">
                        <h1 class="display-4 fw-bold text-capitalize text-center text-emerald-900">Categories</h1>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
</div>
<div class="container-fluid color-emerald-50 py-5">
    <div class="container">
        <h1 class="display-4 fw-bold text-capitalize text-center text-emerald-900">Products</h1>
        <div class="row mt-5">
            <?php
            if (isset($products)) {
                foreach ($products as $product) { ?>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3">
                        <div class="card card-body card-h shadow-sm p-3 card-m-tb bg-body rounded justify-content-between">
                            <a href="<?php echo HOME_URL_PREFIX; ?>/product?id=<?php echo $product['id']; ?>" class="text-decoration-none">
                                <img src="./assets/images/uploads/products/<?php echo $product['fileName']; ?>" class="card-img-top card-image-top" alt="<?php echo $product['name']; ?>" width="200" height="200" loading="lazy">
                            </a>
                            <div class="d-flex flex-column justify-content-between mt-3">
                                <a href="<?php echo HOME_URL_PREFIX; ?>/product?id=<?php echo $product['id']; ?>" class="text-body text-decoration-none">
                                    <p class="card-title card-title-truncate h6 text-emerald-900"><?php echo $product['name']; ?></p>
                                </a>
                                <div class="d-flex flex-column">
                                    <small class="text-muted"><?php echo $product['city']; ?> - <?php echo date("j M", strtotime($product['date'])); ?></small>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-emerald-900">$<?php echo number_format($product['price'], 2, '.'); ?></span>
                                        <i class="bi bi-heart text-emerald-900" id="like-<?php echo $product['id']; ?>" onclick="Like(<?php echo $product['id']; ?>)"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else { ?>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                    <h1 class="display-6 text-capitalize text-center text-emerald-900">No products were found matching your selections.</h1>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<div class="container-fluid bg-body py-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="d-flex flex-row justify-content-center">
                    <?php
                    if (isset($products) && !isset($_GET['cat'])) {
                        for ($page = 1; $page <= $numberOfPages; $page++) { ?>
                            <a class="pagination-bar shadow-none" href="<?php echo HOME_URL_PREFIX; ?>/homepage?pag=<?php echo $page; ?>"><?php echo $page; ?></a>
                    <?php
                        }
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid color-emerald-50 py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7 col-xxl-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold text-capitalize text-emerald-900">Newsletter</h1>
                <p class="col-lg-10 fs-4 text-emerald-900">Subscribe to receive email updates on new products announcements, promotions, sales and more...</p>
            </div>
            <div class="col-10 col-sm-10 col-md-10 col-lg-5 col-xl-5 col-xxl-5 mx-auto">
                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" class="p-4 border rounded-3 bg-body">
                    <div class="input-group input-group-lg mb-3">
                        <input type="text" class="form-control shadow-none border-emerald" placeholder="Name" name="name" required>
                    </div>
                    <div class="input-group input-group-lg mb-3">
                        <input type="email" class="form-control shadow-none border-emerald" placeholder="name@example.com" name="email" required>
                    </div>
                    <button type="submit" class="w-100 btn btn-lg btn-emerald fw-bold shadow-none" name="submit" value="submit">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</div>