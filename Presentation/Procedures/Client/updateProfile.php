<?php


include_once('../../../Routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_SESSION . 'UserSession.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'UserDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'User.php');


$c = Connection::getInstance();
$connection = $c->connectBD();

$userDriving = new UserDriving($connection);

$userSession = UserSession::getUserSession();
$us = $userSession->getCurrentUser();
$updateUser = $userDriving->searchUserById($us->getUserId());

$actualPass = $_POST['actualPassword'];

if (strcasecmp(md5($actualPass), $updateUser->getPassword()) == 0) {
    $name = $_POST['name'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];
    $mail = $_POST['mail'];

    $updateUser->setName($name);
    $updateUser->setLastName($lastName);
    $updateUser->setPhone($phone);
    $updateUser->setMail($mail);

    if ($_POST['password2'] != "") {
        $updateUser->setPassword(md5($_POST['password2']));
        $userDriving->updateProfile($updateUser, 1);
    } else {
        $userDriving->updateProfile($updateUser, 0);
    }
    echo json_encode(array('success' => 1));

    $userSession->setCurrentUser($updateUser);
} else {
    echo json_encode(array('success' => -1));
}