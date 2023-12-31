<?php
session_start();

class SessionHelper
{
    public static function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    public static function isAdmin()
    {
        return isset($_SESSION['user_idrole']) && $_SESSION['user_idrole'] === 1;
    }

    public static function isMod()
    {
        return isset($_SESSION['user_idrole']) && $_SESSION['user_idrole'] === 2;
    }

    public static function isLoggedInCustom()
    {
        return isset($_SESSION['customer_id']);
    }
}
