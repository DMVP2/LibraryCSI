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
        $server = "bookbosque.postgres.database.azure.com";
        $user = "bookbosque@bookbosque";
        $pass = "UEBbook1234";
        $bd = "book_bosque";
        $port = "5432";

        /*$server = "localhost";
        $user = "postgres";
        $pass = "1234";
        $bd = "Book";
        $port = "5432";*/

        $con = "host=$server port=$port dbname=$bd user=$user password=$pass";
        $connection = pg_connect($con);
        return $connection;
    }

    public function disconnectBD($connection)
    {
        $close = pg_close($connection)
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