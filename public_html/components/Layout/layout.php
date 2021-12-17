<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $this->getConfig("APP_TITLE"); ?></title>
    <meta name="author" content="<?php echo $this->getConfig("APP_AUTHOR"); ?>" />
    <meta name="description" content="<?php echo $this->getConfig("APP_DESCRIPTION"); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/svg" href="<?php echo HOME_URL_PREFIX; ?>/assets/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="<?php echo HOME_URL_PREFIX; ?>/assets/styles/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo HOME_URL_PREFIX; ?>/assets/icons/bootstrap-icons.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo HOME_URL_PREFIX; ?>/assets/styles/vendor/bootstrap.min.css" />
</head>

<body>
    <?php
    include_once('../navbar/navbar.php');
    include_once('../../includes/pageContent.php');
    include_once('../footer/footer.php');
    ?>
    <script src="<?php echo HOME_URL_PREFIX; ?>/assets/scripts/vendor/bootstrap.bundle.min.js"></script>
</body>

</html>