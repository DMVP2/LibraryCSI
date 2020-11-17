<?php


include_once('../../Routes.php');


include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'UserDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_SESSION . 'UserSession.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'User.php');

$c = Connection::getInstance();
$connection = $c->connectBD();

$userSession = UserSession::getUserSession();
$userDriving = new UserDriving($connection);

$user = $userSession->getCurrentUser();
$user->setPassword(md5($_POST['pass1']));
$user->setStatus("Active");

$userDriving->changePassword($user);

header("Location: " . ROOT_DIRECTORY . ROUTE_PRESENTATION . "login.php");