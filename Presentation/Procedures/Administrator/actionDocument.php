<?php

include_once('../../../Routes.php');


include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'DocumentDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');

$c = Connection::getInstance();
$connection = $c->connectBD();

$documentrDriving = new DocumentDriving($connection);

$idDocument = $_POST['idDocument'];
if ($_POST['action'] == 1) {
    $documentrDriving->activeDocument($idDocument);
} else {
    $documentrDriving->inactiveDocument($idDocument);
}

echo json_encode(array('success' => '1'));