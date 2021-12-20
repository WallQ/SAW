<?php
if (!isset($_SESSION['logged'])) {
    header('location: ./signin');
}
