<?php
if (isset($_SESSION['logged'])) {
    header('location: ./homepage');
}
include_once('./includes/crypto.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $data = array(
        'email' => $_POST['email'],
        'password' => $_POST['password']
    );
    $args = array(
        'email' => FILTER_SANITIZE_EMAIL
    );
    $cleanData = filter_var_array($data, $args);
    $cleanData += ['password' => $data['password']];

    $signIn = new SignIn($cleanData);
    $signIn->signinUser();
    if (isset($_POST['rememberMe'])) {
        setcookie('email', encryptData($_POST['email']), time() + 3600 * 24 * 30);
        setcookie('password', encryptData($_POST['password']), time() + 3600 * 24 * 30);
    } else {
        setcookie('email', '');
        setcookie('password', '');
    }
    header('location: ./account');
}
?>
<div class="container-fluid bg-body py-5">
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
                        <h1 class="display-3 fw-normal">Sign In</h1>
                    </div>
                    <div class="col-12">
                        <div class="input-group input-group-lg mb-3">
                            <input type="email" class="form-control shadow-none border-emerald" placeholder="Email" name="email" required value="<?php if (isset($_COOKIE['email'])) {
                                                                                                                                                        echo decryptData($_COOKIE['email']);
                                                                                                                                                    } ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group input-group-lg mb-3">
                            <input type="password" class="form-control shadow-none border-emerald" placeholder="Password" name="password" required value="<?php if (isset($_COOKIE['password'])) {
                                                                                                                                                                echo decryptData($_COOKIE['password']);
                                                                                                                                                            } ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group input-group-lg mb-3">
                            <input type="checkbox" class="form-check-input shadow-none" id="rememberMe" name="rememberMe" value="rememberMe" checked>&nbsp;Remember me
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