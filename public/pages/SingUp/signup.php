<?php
if (isset($_SESSION['logged'])) {
    header('location: ./homepage');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $data = array(
        'firstName' => $_POST['firstName'],
        'lastName' => $_POST['lastName'],
        'telephone' => $_POST['telephone'],
        'gender' => $_POST['gender'],
        'state' => $_POST['state'],
        'zipCode' => $_POST['zipCode'],
        'city' => $_POST['city'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'verifyPassword' => $_POST['verifyPassword']
    );
    $args = array(
        'firstName' => FILTER_SANITIZE_STRING,
        'lastName' => FILTER_SANITIZE_STRING,
        'telephone' => FILTER_SANITIZE_NUMBER_INT,
        'gender' => FILTER_SANITIZE_NUMBER_INT,
        'state' => FILTER_SANITIZE_NUMBER_INT,
        'zipCode' => FILTER_SANITIZE_STRING,
        'city' => FILTER_SANITIZE_STRING,
        'email' => FILTER_SANITIZE_EMAIL
    );
    $cleanData = filter_var_array($data, $args);
    $cleanData += ['password' => $data['password'], 'verifyPassword' => $data['verifyPassword']];

    $signUp = new SignUp($cleanData);
    $signUp->signupUser();
    header('location: ./signin');
}
?>
<div class="container-fluid bg-body py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 mx-auto">
                <?php if (isset($_GET['error'])) {
                    include_once('./includes/error.php');
                } ?>
                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" class="row p-4 border rounded-3 bg-body">
                    <div class="form-logo text-emerald-900 text-center mb-4">
                        <i class="bi bi-tags-fill"></i>
                        <h1 class="display-3 fw-normal">Sign In</h1>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group input-group-lg mb-3">
                            <input type="text" class="form-control shadow-none border-emerald text-emerald-900" placeholder="First name" aria-label="First name" name="firstName" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-lg mb-3">
                            <input type="text" class="form-control shadow-none border-emerald" placeholder="Last name" aria-label="Last name" name="lastName" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group input-group-lg mb-3">
                            <input type="tel" class="form-control shadow-none border-emerald" placeholder="Telephone" aria-label="Telephone" name="telephone" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-lg mb-3">
                            <select class="form-select shadow-none border-emerald" aria-label="Gender" name="gender" required>
                                <option value="1">Masculine</option>
                                <option value="2">Feminine</option>
                                <option value="3">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-lg mb-3">
                            <select class="form-select shadow-none border-emerald" aria-label="State" name="state" required>
                                <option value="1">Lisboa</option>
                                <option value="2">Porto</option>
                                <option value="3">Setúbal</option>
                                <option value="4">Braga</option>
                                <option value="5">Aveiro</option>
                                <option value="6">Faro</option>
                                <option value="7">Leiria</option>
                                <option value="8">Santarém</option>
                                <option value="9">Coimbra</option>
                                <option value="10">Viseu</option>
                                <option value="11">Madeira</option>
                                <option value="12">Açores</option>
                                <option value="13">Viana do Castelo</option>
                                <option value="14">Vila Real</option>
                                <option value="15">Castelo Branco</option>
                                <option value="16">Évora</option>
                                <option value="17">Beja</option>
                                <option value="18">Guarda</option>
                                <option value="19">Bragança</option>
                                <option value="20">Portalegre</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-lg mb-3">
                            <input type="text" class="form-control shadow-none border-emerald" placeholder="City" aria-label="City" name="city" required>
                            <input type="text" class="form-control shadow-none border-emerald" placeholder="Zip code" aria-label="Zip code" name="zipCode" required>
                        </div>
                    </div>
                    <div class="input-group input-group-lg mb-3">
                        <input type="email" class="form-control shadow-none border-emerald" placeholder="Email" aria-label="Email" name="email" required>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-lg mb-3">
                            <input type="password" class="form-control shadow-none border-emerald" placeholder="Password" aria-label="Password" name="password" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-lg mb-3">
                            <input type="password" class="form-control shadow-none border-emerald" placeholder="Confirm password" aria-label="Confirm password" name="verifyPassword" required>
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