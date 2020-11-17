<?php

include_once('../routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'UserDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'User.php');


$c = Connection::getInstance();
$connection = $c->connectBD();

$userDriving = new UserDriving($connection);
$empleados = $userDriving->listUsersByRol(3);


foreach ($empleados as $empleado) {

    print_r($empleado);
    echo "<br><br><br>";
}