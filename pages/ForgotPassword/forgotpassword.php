<?php
if (isset($_SESSION['logged'])) {
    header('location: ' . HOME_URL_PREFIX . '/homepage');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $cleanData = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (!$cleanData) {
        header('location: ' . HOME_URL_PREFIX . '/homepage?error');
    }
    $forgotPassword = new ForgotPassword($cleanData);
    $forgotPassword->requestRecover();
}
?>
<div class="container-fluid color-emerald-50 py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 mx-auto">
                <?php if (isset($_GET['error'])) {
                    include_once('./includes/error.php');
                }
                ?>
                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" class="row p-4 border rounded-3 bg-body">
                    <div class="form-logo text-emerald-900 text-center mb-4">
                        <i class="bi bi-tags-fill"></i>
                        <h1 class="display-3 fw-normal">Forgot Password</h1>
                    </div>
                    <div class="col-12">
                        <div class="input-group input-group-lg mb-3">
                            <input type="email" class="form-control shadow-none border-emerald" placeholder="Email" name="email" required>
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