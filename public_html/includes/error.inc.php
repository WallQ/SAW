<?php
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'inputs':
            $message = 'Please fill in all the required fields.';
            break;

        case 'studentcode':
            $message = 'Please enter a valid student code.';
            break;

        case 'firstname':
            $message = 'Please enter a valid first name.';
            break;

        case 'lastname':
            $message = 'Please enter a valid last name.';
            break;

        case 'gender':
            $message = 'Please enter a valid gender.';
            break;

        case 'telephone':
            $message = 'Please enter a valid telephone.';
            break;

        case 'course':
            $message = 'Please enter a valid course.';
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
            $message = 'The student code or email address provided is already registered.';
            break;

        case 'wrong':
            $message = 'The email address or password provided are incorrect.';
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
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> <?php echo ($message); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
}
?>