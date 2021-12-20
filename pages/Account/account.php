<?php
if (!isset($_SESSION['logged'])) {
    header('location: ' . HOME_URL_PREFIX . '/signin');
}
