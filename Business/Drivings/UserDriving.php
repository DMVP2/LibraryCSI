<?php

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . "UserDAO.php");

class UserDriving
{

    //-----------------------------------
    // Attributes
    //-----------------------------------

    private $connection;

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

    public function updateProfile($pUser, $changePass)
    {
        $userDAO = UserDAO::getUserDAO($this->connection);
        $userDAO->updateProfile($pUser, $changePass);
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

    public function changePassword($pUser)
    {
        $userDAO = UserDAO::getUserDAO($this->connection);
        return $userDAO->changePassword($pUser);
    }

    public function listUsersByRol($pRol)
    {
        $userDAO = UserDAO::getUserDAO($this->connection);
        return $userDAO->listUsersRol($pRol);
    }

    public function userValidate($pTypeId, $pId)
    {
        $userDAO = UserDAO::getUserDAO($this->connection);
        return $userDAO->userValidate($pTypeId, $pId);
    }

    public function activeUser($pIdUser)
    {
        $userDAO = UserDAO::getUserDAO($this->connection);
        $userDAO->activeUser($pIdUser);
    }

    public function inactiveUser($pIdUser)
    {
        $userDAO = UserDAO::getUserDAO($this->connection);
        $userDAO->inactiveUser($pIdUser);
    }
}