<?php

require_once 'DAO.php';

include_once("../Business/Entities/User.php");



/**
 * Represents the DAO of the entity "User"
 */

class UserDAO extends DAO
{

    //----------------------------------
    // Attributes
    //----------------------------------

    private $connection;

    private static $userDAO;

    //----------------------------------
    // Builder
    //----------------------------------

    /**
     * 
     */
    private function _construct($connection)
    {
        $this->connection = $connection;
        pg_set_client_encoding($this->connection, "utf8");
    }

    //----------------------------------
    // Methods
    //----------------------------------

    /**
     * 
     */
    public function create($pUser)
    {
        $sql = "INSERT INTO USER VALUES('" . $pUser->getId() . "','" . $pUser->getTypeDocument() . "','" . $pUser->getName() . "','" . $pUser->getLastName() . "','" . $pUser->getMail() . "','" . $pUser->getPhone() . "','" . $pUser->getPassword() . "','" . $pUser->getStatus() . "')";
        pg_query($this->connection, $sql);

        $sql = "INSERT INTO USER_ROL VALUES('" . $pUser->getId() . "'," . $pUser->getRole() . " )";
        pg_query($this->connection, $sql);
    }

    /**
     * 
     */
    public function update()
    {
        $sql = "UPDATE - SET";
        pg_query($this->connection, $sql);
    }

    /**
     * 
     *
     * @return -[]
     */
    public function list()
    {
        $sql = "SELECT * FROM USER";

        if (!$result = pg_query($this->connection, $sql)) die();

        $data = array();

        while ($row = pg_fetch_array($result)) {

            $info = new User();

            $info->setId($row['document']);
            $info->setIdentificationType($row['type_document']);
            $info->setName($row['name']);
            $info->setLastName($row['last_name']);
            $info->setMail($row['mail']);
            $info->setPhone($row['phone']);
            $info->setPassword($row['password']);
            $info->setStatus($row['status']);

            $sql = "SELECT name FROM ROL, USER_ROL where USER_ROL.document = " . $row['document'];
            $nameRol = pg_fetch_array($result)[0];

            $info->setRole($nameRol);

            $data[] = $info;
        }

        return $data;
    }

    public static function getUserDAO($connection)
    {
        if (self::$userDAO == null) {
            self::$userDAO = new UserDAO($connection);
        }

        return self::$userDAO;
    }
}