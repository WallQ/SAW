<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $data = array(
        'email' => $_POST['email'],
        'password' => $_POST['password']
    );
    $args = array('email' => FILTER_SANITIZE_EMAIL);
    $cleanData = filter_var_array($data, $args);
    $cleanData += ['password' => $data['password']];

    include_once '../config/config.php';
    include_once '../classes/dbh.class.php';
    include_once '../classes/signin.class.php';
    include_once '../classes/signinController.class.php';
    $signin = new SignInController($cleanData);
    $signin->signinUser();
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
        <h1 class="display-1 text-center">Sing In</h1>
        <?php
        include_once('./error.inc.php');
        ?>
        <form method="POST" action="<?php $_SERVER["PHP_SELF"] ?>">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp" placeholder="Enter password" minlength="8" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[a-zA-Z\d@$!%*?&]{8,}" autocomplete="current-password" required>
                <small id="passwordHelp" class="form-text text-muted">Must be at least 8 characters and have at least 1 uppercase, 1 lowercase, 1 number and 1 symbol.</small>
            </div>
            <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>