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

    if (strcasecmp($rol, "Client") == 0) {
        header("Location: " . ROOT_DIRECTORY);
    } else if (strcasecmp($rol, "Employee")) {
        header("Location: " . ROOT_DIRECTORY . ROUTE_EMPLOYEE . "indexEmployee.php");
    } else if (strcasecmp($rol, "Admin")) {
        header("Location: " . ROOT_DIRECTORY . ROUTE_ADMINISTRATOR . "indexAdmin.php");
    }
} else {
    echo "paila";
}