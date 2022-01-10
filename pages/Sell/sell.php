<?php
if (!isset($_SESSION['logged'])) {
    header('location: ' . HOME_URL_PREFIX . '/signin');
}
$sell = new Sell();
if (isset($_GET['id'])) {
    $cleanData = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    if (!$cleanData) {
        header('location: ' . HOME_URL_PREFIX . '/homepage?error');
    }
    $result = $sell->getProduct($cleanData, $_SESSION['id']);
}
$category = new Category();
$categories = $category->getCategories();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $data = array(
        'name' => $_POST['name'],
        'category' => $_POST['category'],
        'images' => $_FILES['images'],
        'price' => $_POST['price'],
        'description' => $_POST['description'],
    );
    if (isset($_GET['id'])) {
        $data += ['id' => $_GET['id']];
    } else {
        $data += ['id' => $_SESSION['id']];
    }
    $args = array(
        'name' => FILTER_SANITIZE_STRING,
        'category' => FILTER_SANITIZE_NUMBER_INT,
        'price' => FILTER_SANITIZE_NUMBER_INT,
        'description' => FILTER_SANITIZE_STRING,
        'id' => FILTER_SANITIZE_NUMBER_INT
    );
    $cleanData = filter_var_array($data, $args);
    $cleanData += ['images' => $data['images']];
    if (!$cleanData) {
        header('location: ' . HOME_URL_PREFIX . '/sell?error');
    }

    $sell = new Sell($cleanData);
    if (isset($_GET['id'])) {
        $sell->sellProductEdit($cleanData, $_GET['id']);
    } else {
        $sell->sellProduct($cleanData);
    }
    header('location: ' . HOME_URL_PREFIX . '/myproducts');
}
?>
<div class="container-fluid color-emerald-50 py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8 mx-auto">
                <?php if (isset($_GET['error'])) {
                    include_once('./includes/error.php');
                } ?>
                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" enctype="multipart/form-data" class="row p-4 border rounded-3 bg-body">
                    <div class="form-logo text-emerald-900 text-center mb-4">
                        <i class="bi bi-cart-fill"></i>
                        <h1 class="display-3 fw-normal">Sell</h1>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-lg mb-3">
                            <input type="text" class="form-control text-emerald-900 border-emerald shadow-none" placeholder="Name" aria-label="name" name="name" value="<?php if(isset($result)) { echo $result[0]['name']; } ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-lg mb-3">
                            <?php
                            if (isset($categories)) { ?>
                                <select class="form-select shadow-none border-emerald" aria-label="Category" name="category" required>
                                    <?php
                                    foreach ($categories as $category) { ?>
                                        <option value="<?php echo $category['id']; ?>" <?php if(isset($result)) { if($result[0]['category_id'] === $category['id']) { echo 'selected'; } } ?>><?php echo $category['category']; ?></option>
                                    <?php
                                    } ?>
                                </select>
                            <?php
                            } ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-lg mb-3">
                            <input type="number" class="form-control text-emerald-900 border-emerald shadow-none" placeholder="Price" aria-label="Price" name="price" value="<?php if(isset($result)) { echo $result[0]['price']; } ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-lg mb-3">
                            <input class="form-control text-emerald-900 border-emerald shadow-none" type="file" aria-label="Images" name="images[]" multiple required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group input-group-lg mb-3">
                            <textarea class="form-control text-emerald-900 border-emerald shadow-none" rows="4" placeholder="Description" aria-label="Description" name="description" required><?php if(isset($result)) { echo $result[0]['description']; } ?></textarea>
                        </div>
                    </div>
                    <div class="input-group input-group-lg mb-3">
                        <button type="submit" class="w-100 btn btn-lg btn-emerald fw-bold shadow-none" name="submit" value="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>