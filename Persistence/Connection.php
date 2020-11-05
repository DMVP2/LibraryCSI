<?php

/**
 * Class making the connection to the database
 */

class Connection
{

    //----------------------------------
    // Attributes
    //----------------------------------

    private static $instance;

    //----------------------------------
    // Methods
    //----------------------------------

    /**
     * Connect to the database
     * @return Object $connection
     */
    public function connectBD()
    {
        $server = "";
        $user = "";
        $pass = "";
        $bd = "";
        $port = "3306";

        $connection = mysqli_connect($server, $user, $pass, $bd, $port)
            or die("An unexpected error occurred in the database connection");

        return $connection;
    }

    public function disconnectBD($connection)
    {
        $close = mysqli_close($connection)
            or die("An unexpected error occurred in the database disconnect");
        return $close;
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Connection();
        }

        return self::$instance;
    }
}