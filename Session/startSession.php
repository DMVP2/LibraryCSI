<?php

include_once('../Routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'UserDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_SESSION . 'UserSession.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'User.php');


$c = Connection::getInstance();
$connection = $c->connectBD();

$userSession = UserSession::getUserSession();
$userDriving = new UserDriving($connection);

$user = $_POST['user'];
$consultUser = $userDriving->searchUserById($user);

if (isset($consultUser) and strcasecmp($consultUser->getPassword(), md5($_POST['password'])) == 0) {
    $userSession->setCurrentUser($consultUser);
    $rol = $userDriving->consultRole($consultUser->getRole());

    if (strcasecmp($consultUser->getStatus(), 'Inactive') == 0) {
        header("Location: " . ROOT_DIRECTORY . ROUTE_PRESENTATION . 'changePassword.php');
    } else {
        if (strcasecmp($rol, "Client") == 0 || strcasecmp($rol, "Publisher") == 0) {
            $userSession->setRol("Client");
            header("Location: " . ROOT_DIRECTORY);
        } else if (strcasecmp($rol, "Employee") == 0) {
            $userSession->setRol("Employee");
            header("Location: " . ROOT_DIRECTORY . ROUTE_EMPLOYEE . "indexEmployee.php");
        } else if (strcasecmp($rol, "Admin") == 0) {
            $userSession->setRol("Admin");
            header("Location: " . ROOT_DIRECTORY . ROUTE_ADMINISTRATOR . "indexAdministrator.php");
        } else if (strcasecmp($rol, "Owner") == 0) {
            $userSession->setRol("Owner");
            header("Location: " . ROOT_DIRECTORY . ROUTE_ADMINISTRATOR . "indexAdministrator.php");
        }
    }
} else {
    header("Location: " . ROOT_DIRECTORY . ROUTE_PRESENTATION . "login.php?code=1");
}