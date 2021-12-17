<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php echo $this->getConfig("APP_TITLE"); ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?php echo HOME_URL_PREFIX; ?>/assets/images/icons/favicon.png" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo HOME_URL_PREFIX; ?>/assets/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo HOME_URL_PREFIX; ?>/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo HOME_URL_PREFIX; ?>/assets/fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo HOME_URL_PREFIX; ?>/assets/fonts/linearicons-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo HOME_URL_PREFIX; ?>/assets/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo HOME_URL_PREFIX; ?>/assets/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo HOME_URL_PREFIX; ?>/assets/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo HOME_URL_PREFIX; ?>/assets/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo HOME_URL_PREFIX; ?>/assets/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo HOME_URL_PREFIX; ?>/assets/vendor/slick/slick.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo HOME_URL_PREFIX; ?>/assets/vendor/MagnificPopup/magnific-popup.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo HOME_URL_PREFIX; ?>/assets/vendor/perfect-scrollbar/perfect-scrollbar.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo HOME_URL_PREFIX; ?>/assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo HOME_URL_PREFIX; ?>/assets/css/main.css">
	<!--===============================================================================================-->
</head>

<body class="animsition">

	<?php

	include_once("template_parts/header.php");
	include_once("template_parts/page_content.php");
	include_once("template_parts/footer.php");

	?>
</body>

</html>