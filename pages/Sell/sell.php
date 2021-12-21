<?php
if (!isset($_SESSION['logged'])) {
    header('location: ' . HOME_URL_PREFIX . '/signin');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $data = array(
        'name' => $_POST['name'],
        'category' => $_POST['category'],
        'images' => $_FILES['images'],
        'price' => $_POST['price'],
        'description' => $_POST['description'],
        'user' => $_SESSION['id']
    );
    $args = array(
        'name' => FILTER_SANITIZE_STRING,
        'category' => FILTER_SANITIZE_NUMBER_INT,
        'price' => FILTER_SANITIZE_NUMBER_INT,
        'description' => FILTER_SANITIZE_STRING,
        'user' => FILTER_SANITIZE_NUMBER_INT
    );
    $cleanData = filter_var_array($data, $args);
    $cleanData += ['images' => $data['images']];

    $sell = new Sell($cleanData);
    $sell->sellProduct();
    header('location: ' . HOME_URL_PREFIX . '/myproducts');
}
?>
<div class="container-fluid bg-body py-5">
    <div class="container">
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
                    <input type="text" class="form-control text-emerald-900 border-emerald shadow-none" placeholder="Name" aria-label="name" name="name" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-lg mb-3">
                    <select class="form-select shadow-none border-emerald" aria-label="Category" name="category" required>
                        <option value="1">Animals</option>
                        <option value="2">Babys and childrens</option>
                        <option value="3">Cars, motorcycles and boats</option>
                        <option value="4">Cell phones and tablets</option>
                        <option value="5">Equipment and tools</option>
                        <option value="6">Farming</option>
                        <option value="7">Fashion</option>
                        <option value="8">Furniture, house and garden</option>
                        <option value="9">Gaming</option>
                        <option value="10">Jobs</option>
                        <option value="11">Others</option>
                        <option value="12">Properties</option>
                        <option value="13">Services</option>
                        <option value="14">Sports</option>
                        <option value="15">Technology</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-lg mb-3">
                    <input type="number" class="form-control text-emerald-900 border-emerald shadow-none" placeholder="Price" aria-label="Price" name="price" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group input-group-lg mb-3">
                    <input class="form-control text-emerald-900 border-emerald shadow-none" type="file" aria-label="Images" name="images[]" multiple required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="input-group input-group-lg mb-3">
                    <textarea class="form-control text-emerald-900 border-emerald shadow-none" rows="4" placeholder="Description" aria-label="Description" name="description" required></textarea>
                </div>
            </div>
            <div class="input-group input-group-lg mb-3">
                <button type="submit" class="w-100 btn btn-lg btn-emerald fw-bold shadow-none" name="submit" value="submit">Submit</button>
            </div>
        </form>
    </div>
</div>