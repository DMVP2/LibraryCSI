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
        mysqli_set_charset($this->connection, "utf8");
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
        mysqli_query($this->connection, $sql);

        $sql = "INSERT INTO USER_ROL VALUES('" . $pUser->getId() . "'," . $pUser->getRole() . " )";
        mysqli_query($this->connection, $sql);
    }

    /**
     * 
     */
    public function update()
    {
        $sql = "UPDATE - SET";
        mysqli_query($this->connection, $sql);
    }

    /**
     * 
     *
     * @return -[]
     */
    public function list()
    {
        $sql = "SELECT * FROM USER";

        if (!$result = mysqli_query($this->connection, $sql)) die();

        $data = array();

        while ($row = mysqli_fetch_array($result)) {

            $info = new User();

            $info->setId($row['document']);
            $info->setTypeDocument($row['type_document']);
            $info->setName($row['name']);
            $info->setLastName($row['last_name']);
            $info->setEmail($row['mail']);
            $info->setPhone($row['phone']);
            $info->setPassword($row['password']);
            $info->setStatus($row['status']);

            $sql = "SELECT name FROM ROL, USER_ROL where USER_ROL.document = " . $row['document'];
            $nameRol = mysqli_fetch_array($result)[0];

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