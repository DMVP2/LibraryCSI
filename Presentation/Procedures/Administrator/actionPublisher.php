<?php

include_once('../../../Routes.php');


include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'PublisherDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');

$c = Connection::getInstance();
$connection = $c->connectBD();

$publisherDriving = new PublisherDriving($connection);

$idPublisher = $_POST['idPublisher'];
if ($_POST['action'] == 1) {
    $publisherDriving->activePublisher($idPublisher);
} else {
    $publisherDriving->inactivePublisher($idPublisher);
}

echo json_encode(array('success' => '1'));