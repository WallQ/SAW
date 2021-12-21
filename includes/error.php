<?php
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'inputs':
            $message = 'Please fill in all the required fields.';
            break;
        case 'firstname':
            $message = 'Please enter a valid first name.';
            break;
        case 'lastname':
            $message = 'Please enter a valid last name.';
            break;
        case 'telephone':
            $message = 'Please enter a valid telephone.';
            break;
        case 'gender':
            $message = 'Please enter a valid gender.';
            break;
        case 'state':
            $message = 'Please enter a valid state.';
            break;
        case 'city':
            $message = 'Please enter a valid city.';
            break;
        case 'zipcode':
            $message = 'Please enter a valid zip code.';
            break;
        case 'email':
            $message = 'Please enter a valid email address.';
            break;
        case 'password':
            $message = 'Please enter a valid password .';
            break;
        case 'match':
            $message = 'The password\'s provided don\'t match.';
            break;
        case 'taken':
            $message = 'The email address provided is already registered.';
            break;
        case 'wrong':
            $message = 'The email address or password provided are incorrect.';
            break;
        case 'upload':
            $message = 'The uploading failed.';
            break;
        case 'file':
            $message = 'The file provided is not valid.';
            break;
        case 'type':
            $message = 'The files type must be .jpeg or .jpg.';
            break;
        case 'size':
            $message = 'The files must not be more than 2 MB.';
            break;
        case 'price':
            $message = 'Please enter a valid price.';
            break;
        case 'notfound':
            $message = 'The email address provided is not registered.';
            break;
        case 'stmtfailed':
            $message = 'Something went wrong.';
            break;
        default:
            $message = 'Something went wrong!';
            break;
    }
?>
    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <strong>Error!</strong> <?php echo ($message); ?>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>