<?php

include_once('../../../Routes.php');


include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'BookingDriving.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'PenaltyDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');

$c = Connection::getInstance();
$connection = $c->connectBD();

$bookingDriving = new BookingDriving($connection);
$penaltyDriving = new PenaltyDriving($connection);

$bookingDriving->updateStatusBooking($_POST['status'], $_POST['idBooking']);

if (strcasecmp($_POST['status'], 'Fined') == 0) {

    $penaltyDriving->payPenalty($_POST['idBooking'], $_POST['value']);
}

echo json_encode(array('success' => '1'));