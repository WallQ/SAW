<?php
session_destroy();
header('location: ' . HOME_URL_PREFIX . '/homepage');
