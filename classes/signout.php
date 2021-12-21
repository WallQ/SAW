<?php

class SignOut
{

    public function __construct()
    {
    }

    public function signoutUser()
    {
        session_destroy();
        header('location: ' . HOME_URL_PREFIX . '/homepage');
    }
}
