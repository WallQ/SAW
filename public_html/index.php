<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="author" content="André Pinto & Sérgio Félix" />
    <meta name="description" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="./assets/styles/main.css" />
    <link rel="stylesheet" href="./assets/icons/bootstrap-icons.css" />
    <link rel="stylesheet" href="./assets/styles/vendor/bootstrap.min.css" />
    <title>SAW</title>
</head>

<body>
    <?php require_once('./components/navbar/navbar.php'); ?>
    <div class="container-fluid color-emerald-50 py-5">
        <div class="container">
            <form action="#" method="POST">
                <label class="visually-hidden" for="searchbox">Username</label>
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control shadow-none border border-dark" id="searchbox" name="search" placeholder="Search...">
                    <button type="submit" class="btn input-group-text shadow-none bg-white border border-dark" id="submit" name="submit" value="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="container-fluid bg-body py-3">
        <div class="container">
            <h1 class="display-2 text-center pb-3">Categories</h1>
            <div class="row">
                <?php for ($i = 0; $i < 12; $i++) {
                    //foreach ($products as $product) { 
                ?>
                    <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-2 col-xxl-2">
                        <div class="d-flex flex-row justify-content-center">
                            <div class="d-flex flex-column pb-4">
                                <img src="./assets/images/products/car.jpg" class="rounded-circle rounded-circle-top" alt="..." width="100" height="100">
                                <h5 class="text-center mt-2">Heading</h5>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="container-fluid color-emerald-50 py-3">
        <div class="container">
            <div class="row">
                <?php for ($i = 0; $i < 16; $i++) {
                    //foreach ($products as $product) { 
                ?>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3">
                        <div class="card card-h shadow-sm p-3 card-m-tb bg-body rounded justify-content-between">
                            <a href="#" class="text-decoration-none">
                                <img src="./assets/images/products/car.jpg" class="card-img-top card-image-top" alt="...">
                            </a>
                            <div class="d-flex flex-column justify-content-between mt-3">
                                <a href="#" class="text-body text-decoration-none">
                                    <p class="card-title card-title-truncate h6">DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD</p>
                                </a>
                                <div class="d-flex flex-column">
                                    <small class="text-muted">Felgueiras - <?php echo date("j M", strtotime('2021-12-15 12:12:12')) ?></small>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">10$</span>
                                        <i class="bi bi-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-body py-3">
        <div class="container">
            <div class="row align-items-center py-3">
                <div class="col-lg-7 text-center text-lg-start">
                    <h1 class="display-4 fw-bold lh-1 mb-3 text-capitalize">Newsletter</h1>
                    <p class="col-lg-10 fs-4">Subscribe to receive email updates on new products announcements, promotions, sales and more...</p>
                </div>
                <div class="col-md-10 mx-auto col-lg-5">
                    <form class="p-4 p-md-5 border rounded-3 bg-light">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingName" placeholder="Name">
                            <label for="floatingName">Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingEmail" placeholder="name@example.com">
                            <label for="floatingEmail">Email</label>
                        </div>
                        <button class="w-100 btn btn-lg btn-primary" type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('./components/footer/footer.php'); ?>
    <script src="./assets/scripts/vendor/bootstrap.bundle.min.js"></script>
</body>

</html>