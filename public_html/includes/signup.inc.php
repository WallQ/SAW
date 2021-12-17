<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $data = array(
        'firstName' => $_POST['first-name'],
        'lastName' => $_POST['last-name'],
        'gender' => $_POST['gender'],
        'telephone' => $_POST['telephone'],
        'location' => $_POST['location'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'verifyPassword' => $_POST['verify-password']
    );
    $args = array(
        'firstName' => FILTER_SANITIZE_STRING,
        'lastName' => FILTER_SANITIZE_STRING,
        'gender' => FILTER_SANITIZE_STRING,
        'telephone' => FILTER_SANITIZE_NUMBER_INT,
        'location' => FILTER_SANITIZE_STRING,
        'email' => FILTER_SANITIZE_EMAIL
    );
    $cleanData = filter_var_array($data, $args);
    $cleanData += ['password' => $data['password'], 'verifyPassword' => $data['verifyPassword']];

    include_once '../config/config.php';
    include_once '../classes/dbh.class.php';
    include_once '../classes/signup.class.php';
    include_once '../classes/signupController.class.php';
    $signup = new SignUpController($cleanData);
    $signup->signupUser();
    header('location: ../index.php?error=none');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SAW</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../index.php">SAW</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="./signup.inc.php">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./signin.inc.php">Sign In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./signout.inc.php">Sign Out</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container p-3">
        <h1 class="display-1 text-center">Sing Up</h1>
        <?php
        include_once('./error.inc.php');
        ?>
        <form method="POST" action="<?php $_SERVER["PHP_SELF"] ?>">
            <div class="form-group form-row">
                <div class="col">
                    <label for="first-name">First name</label>
                    <input type="text" class="form-control" id="first-name" name="first-name" placeholder="Enter first name" minlength="3" pattern="^[a-zA-Z\u00C0-\u00FF]{3,}" autocomplete="cc-given-name" required>
                </div>
                <div class="col">
                    <label for="last-name">Last name</label>
                    <input type="text" class="form-control" id="last-name" name="last-name" placeholder="Enter last name" minlength="3" pattern="^[a-zA-Z\u00C0-\u00FF]{3,}" autocomplete="cc-family-name" required>
                </div>
            </div>
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                </div>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gender1" value="M" checked>
                        <label class="form-check-label" for="gender1">
                            Masculine
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gender2" value="F">
                        <label class="form-check-label" for="gender2">
                            Feminine
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gender3" value="O">
                        <label class="form-check-label" for="gender4">
                            Other
                        </label>
                    </div>
                </div>
            </fieldset>
            <div class="form-group form-row">
                <div class="col">
                    <label for="telephone">Telephone</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Enter telephone" minlength="9" maxlength="9" pattern="((255)\d{6})|((91|92|93|96)\d{7})" autocomplete="tel" required>
                </div>
                <div class="col">
                    <label for="course">Course</label>
                    <input type="text" class="form-control" id="course" name="course" placeholder="Enter course" minlength="3" maxlength="4" pattern="^(LEI|SIRC|DWDM|CRSI){1}" required>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" autocomplete="email" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group form-row">
                <div class="col">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp" placeholder="Enter password" minlength="8" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[a-zA-Z\d@$!%*?&]{8,}" autocomplete="new-password" required>
                    <small id="passwordHelp" class="form-text text-muted">At 8 characters being at least 1 uppercase, 1 lowercase, 1 number and 1 symbol.</small>
                </div>
                <div class="col">
                    <label for="verify-password">Verify Password</label>
                    <input type="password" class="form-control" id="verify-password" name="verify-password" placeholder="Re-enter password" minlength="8" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[a-zA-Z\d@$!%*?&]{8,}" autocomplete="new-password" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="submit" name="submit" value="submit">Submit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>