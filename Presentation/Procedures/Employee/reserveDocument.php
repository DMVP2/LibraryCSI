<?php

include_once('../../../Routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'DocumentDriving.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'BookingDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Document.php');


$c = Connection::getInstance();
$connection = $c->connectBD();

$documentDriving = new DocumentDriving($connection);
$bookingDriving = new BookingDriving($connection);


if (isset($_POST['action'])) {

    $codeDocument = $_POST['code'];
    $documentsCode = $documentDriving->searchByCode($codeDocument, "Fisico");

    if ($documentsCode == null) {
        echo json_encode(array('success' => "No existe", 'code' => -1));
    } else {

        $found = false;

        foreach ($documentsCode as $document) {
            $nowStatus = $documentDriving->stateReservedDocument($document->getDocumentId());

            if ($nowStatus == false) {
                echo json_encode(array('success' => $document->getTitle(), 'code' => $document->getDocumentId()));
                $found = true;
                break;
            }
        }

        if ($found == false) {
            echo json_encode(array('success' => "No hay copias disponibles", 'code' => -2));
        }
    }
} else {
    $idDocument = $_POST['idDocumentReserve'];
    $userDocument = $_POST['idClientReserve'];

    $bookingDriving->reserveDocument($userDocument, $idDocument, 'Retired');

    echo json_encode(array('success' => 1));
}