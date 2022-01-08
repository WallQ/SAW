<?php
if (!isset($_GET['id'])) {
    header('location: ' . HOME_URL_PREFIX . '/homepage');
}
$cleanData = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
if (!$cleanData) {
    header('location: ' . HOME_URL_PREFIX . '/homepage?error');
}
$product = new Product();
$result = $product->getProduct($cleanData);
if (!isset($result)) {
    header('location: ' . HOME_URL_PREFIX . '/homepage?error');
}
?>
<div class="container-fluid color-emerald-50 py-5">
    <div class="container">
        <h1 class="display-4 fw-bold text-capitalize text-center text-emerald-900">Your Products</h1>
        <div class="row mt-2 gx-5 gy-5">
            <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9 col-xxl-9">
                <div id="carouselProduct" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                            foreach ($result[0]['path'] as $key => $image) { 
                                print_r($key);
                        ?>
                            <div class="carousel-item carousel-s <?php if($key === 0) echo ('active') ?>" data-bs-interval="30000">
                                <a href="./assets/images/uploads/products/<?php echo $image['fileName'];?>" data-lightbox="product" data-title="<?php echo $result[0]['name']?>"><img src="./assets/images/uploads/products/<?php echo $image['fileName'];?>" style="object-fit: cover;" class="d-block w-100" alt="Product Image" loading="lazy"></a>
                            </div>
                        <?php
                            }
                        ?>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselProduct" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselProduct" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 col-xxl-3">
                <div class="d-flex flex-column bg-white px-4 py-4">
                    <div class="flex-column">
                        <h3 class="fw-bold text-emerald-900">Seller</h3>
                        <hr>
                    </div>
                    <div class="flex-column mt-4">
                        <div class="d-inline-flex">
                            <img src="./assets/images/uploads/users/<?php echo $result[0]['imagePath']?>" class="rounded-circle" alt="Avatar" width="80" height="80">
                            <div>
                                <h4 class="fw-bold text-emerald-900 ms-4 mb-0 card-text-truncate"><?php echo ($result[0]['firstName'].' '.$result[0]['lastName'] ); ?></h4>
                                <p class="fw-normal text-emerald-900 ms-4 card-text-truncate">User of SAW since <?php echo date("j F Y", strtotime($result[0]['createdDate'])); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-column mt-1">
                        <?php
                            if (!isset($_SESSION['logged'])) {
                        ?>
                            <a href="<?php echo HOME_URL_PREFIX;?>/signin" class="btn btn-emerald fw-bold shadow-none w-100" disabled name="contact" value="contact"><i class="bi bi-telephone-fill me-2"></i>Contact</a>
                        <?php
                            } else {
                        ?>
                            <a href="tel:+351<?php echo $result[0]['telephone']?>" class="btn btn-emerald fw-bold shadow-none w-100" name="contact" value="contact"><i class="bi bi-telephone-fill me-2"></i>Contact</a>
                        <?php 
                            }
                        ?>
                    </div>
                    <div class="flex-column mt-4">
                        <h3 class="fw-bold text-emerald-900">Location</h3>
                        <hr>
                    </div>
                    <div class="flex-column mt-4">
                        <div class="align-self-end">
                            <iframe width="100%" height="150" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo $result[0]['city']?>&amp;key=AIzaSyA2W8VuMFPLKxR88upABeDzZZkKnU7svV8"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9 col-xxl-9">
                <div class="d-flex flex-column bg-white px-4 py-4">
                    <div class="d-flex flex-row justify-content-between align-items-center">
                        <p class="fw-normal text-emerald-900 card-text-truncate mb-0">Published on <?php echo date("j F Y", strtotime($result[0]['date'])); ?></p>
                        <i class="bi bi-heart text-emerald-900" id="like-1" onclick="Like(1)"></i>
                    </div>
                    <div class="flex-column">
                        <h3 class="text-emerald-900"><?php echo $result[0]['name']?></h3>
                    </div>
                    <div class="flex-column mt-2">
                        <h1 class="fw-bold text-emerald-900">$<?php echo number_format($result[0]['price'], 2, '.'); ?></h1>
                    </div>
                    <div class="flex-column mt-2">
                        <h4 class="fw-bold text-emerald-900">Description</h4>
                    </div>
                    <div class="flex-column mt-2">
                        <p class="text-emerald-900"><?php echo $result[0]['description']?></p>
                    </div>
                    <div class="flex-column mt-2">
                        <hr>
                    </div>
                    <div class="d-flex flex-row justify-content-between align-items-center">
                        <small class="text-muted">ID: <?php echo $result[0]['id']?></small>
                        <small class="text-muted"><i class="bi bi-flag text-emerald-900"></i> <u>Report</u></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>