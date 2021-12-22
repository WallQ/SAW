<?php
if (isset($_SESSION['logged'])) {
    header('location: ' . HOME_URL_PREFIX . '/homepage');
}
if (!isset($_GET['email']) && !isset($_GET['token'])) {
    header('location: ' . HOME_URL_PREFIX . '/forgotpassword');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $data = array(
        'email' => $_GET['email'],
        'token' => $_GET['token'],
        'password' => $_POST['password'],
        'verifyPassword' => $_POST['verifyPassword']
    );
    $args = array(
        'email' => FILTER_SANITIZE_EMAIL,
        'token' => FILTER_SANITIZE_STRING
    );
    $cleanData = filter_var_array($data, $args);
    $cleanData += ['password' => $data['password'], 'verifyPassword' => $data['verifyPassword']];
    if (!$cleanData) {
        header('location: ' . HOME_URL_PREFIX . '/forgotpassword?error');
    }
    $newPassword = new NewPassword($cleanData);
    $newPassword->requestNewPassword();
    header('location: ' . HOME_URL_PREFIX . '/signin');
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
                        <h1 class="display-3 fw-normal">New Password</h1>
                    </div>
                    <div class="col-12">
                        <div class="input-group input-group-lg mb-3">
                            <input type="password" class="form-control shadow-none border-emerald" placeholder="Password" name="password" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group input-group-lg mb-3">
                            <input type="password" class="form-control shadow-none border-emerald" placeholder="Confirm Password" name="verifyPassword" required>
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