<?php

include_once('../../../Routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'UserDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');

$c = Connection::getInstance();
$connection = $c->connectBD();

$userDriving = new UserDriving($connection);

$idUser = $_POST['idUser'];
if ($_POST['action'] == 1) {
    $userDriving->activeUser($idUser);
} else {
    $userDriving->inactiveUser($idUser);
}

echo json_encode(array('success' => '1'));