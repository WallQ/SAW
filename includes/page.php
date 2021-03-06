<?php

$page = isset(APP_URL_PARTS[0]) ? APP_URL_PARTS[0] : null;

switch ($page) {
    case 'signup':
        include_once('./pages/SignUp/signup.php');
        break;
    case 'signin':
        include_once('./pages/SignIn/signin.php');
        break;
    case 'signout':
        include_once('./pages/SignOut/signout.php');
        break;
    case 'account':
        include_once('./pages/Account/account.php');
        break;
    case 'myproducts':
        include_once('./pages/MyProducts/myproducts.php');
        break;
    case 'sell':
        include_once('./pages/Sell/sell.php');
        break;
    case 'product':
        include_once('./pages/Product/product.php');
        break;
    case 'forgotpassword':
        include_once('./pages/ForgotPassword/forgotpassword.php');
        break;
    case 'newpassword':
        include_once('./pages/NewPassword/newpassword.php');
        break;
    case 'dashboard':
        include_once('./pages/Dashboard/dashboard.php');
        break;
    default:
        include_once('./pages/Homepage/homepage.php');
        break;
}
