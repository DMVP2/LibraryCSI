<?php

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . "UserDAO.php");

class UserDriving
{

    //-----------------------------------
    // Attributes
    //-----------------------------------

    private $connection;
    private static $userDriving;

    //----------------------------------
    // Builder
    //----------------------------------

    public function __construct($pConnection)
    {
        $this->connection = $pConnection;
    }

    //---------------------------------
    // Methods
    //---------------------------------

    public function createUser($pUser)
    {
        $userDAO = UserDAO::getUserDAO($this->connection);
        $userDAO->create($pUser);
    }

    public function searchUserById($pId)
    {
        $userDAO = UserDAO::getUserDAO($this->connection);
        return $userDAO->search($pId);
    }

    public function consultRole($pIdRol)
    {
        $userDAO = UserDAO::getUserDAO($this->connection);
        return $userDAO->searchRol($pIdRol);
    }
}