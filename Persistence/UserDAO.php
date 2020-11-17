<?php

require_once 'DAO.php';

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . "User.php");



/**
 * Represents the DAO of the entity "User"
 */

class UserDAO implements DAO
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
    private function __construct($pConnection)
    {
        $this->connection = $pConnection;
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
        $sql = "INSERT INTO USERS VALUES('" . $pUser->getUserId() . "','" . $pUser->getTypeDocument() . "','" . $pUser->getName() . "','" . $pUser->getLastName() . "','" . $pUser->getMail() . "','" . $pUser->getPhone() . "','" . $pUser->getPassword() . "','" . $pUser->getStatus() . "')";
        pg_query($this->connection, $sql);

        $sql = "INSERT INTO USERS_ROL VALUES('" . $pUser->getUserId() . "'," . $pUser->getRole() . ")";
        pg_query($this->connection, $sql);
    }


    public function search($pCode)
    {
        $sql = "SELECT * FROM USERS WHERE USERS.user_id = " . $pCode;
        $rta = pg_query($this->connection, $sql);

        if (pg_num_rows($rta) > 0) {
            $row = pg_fetch_object($rta);
            $userSearch = new User();

            $userSearch->setId($row->user_id);
            $userSearch->setIdentificationType($row->identification_type);
            $userSearch->setName($row->name);
            $userSearch->setLastName($row->last_name);
            $userSearch->setMail($row->mail);
            $userSearch->setPhone($row->phone);
            $userSearch->setPassword($row->password);
            $userSearch->setStatus($row->status);

            $sql = "SELECT rol_id FROM USERS_ROL where USERS_ROL.user_id = " . $userSearch->getUserId();
            $rta = pg_query($this->connection, $sql);
            $row2 = pg_fetch_object($rta);
            $userSearch->setRole($row2->rol_id);
        } else {
            return null;
        }

        return $userSearch;
    }

    public function searchRol($pCode)
    {
        $sql = "SELECT rol FROM ROL where rol_id = " . $pCode;
        $rta = pg_query($this->connection, $sql);
        $row = pg_fetch_object($rta);
        return $row->rol;
    }

    /**
     * 
     */
    public function update($pElement)
    {
        $sql = "UPDATE - SET";
        pg_query($this->connection, $sql);
    }

    public function changePassword($pUser)
    {
        $sql = "UPDATE USERS SET password='" . $pUser->getPassword() . "',status='" . $pUser->getStatus() . "' WHERE user_id='" . $pUser->getUserId() . "'";
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

    public function delete($pCode)
    {
    }


    public static function getUserDAO($connection)
    {
        if (self::$userDAO == null) {
            self::$userDAO = new UserDAO($connection);
        }

        return self::$userDAO;
    }
}