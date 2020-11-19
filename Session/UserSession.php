<?php

class UserSession
{

    private static $userSession;


    public function __construct()
    {
        session_start();
    }

    public function setCurrentUser($user)
    {
        $_SESSION['user'] = $user;
    }

    public function getCurrentUser()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        return null;
    }

    public function getRol()
    {
        if (isset($_SESSION['rol'])) {
            return $_SESSION['rol'];
        }
        return null;
    }

    public function setRol($pRol)
    {
        $_SESSION['rol'] = $pRol;
    }

    public function closeSession()
    {
        session_unset();
        session_destroy();
    }

    public function verifySession()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: " . ROOT_DIRECTORY . "/index.php");
        }
    }

    public static function getUserSession()
    {
        if (self::$userSession == null) {
            self::$userSession = new UserSession();
        }

        return self::$userSession;
    }
}