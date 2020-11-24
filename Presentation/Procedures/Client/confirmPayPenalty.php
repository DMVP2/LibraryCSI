<?php

$result = $_POST['response_code_pol'];
if ($result == 1) {

    include_once('../../../Routes.php');


    include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'BookingDriving.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'PenaltyDriving.php');

    include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');

    $c = Connection::getInstance();
    $connection = $c->connectBD();

    $bookingDriving = new BookingDriving($connection);
    $penaltyDriving = new PenaltyDriving($connection);

    $idPenalty = $_POST['reference_sale'];
    $value = $_POST['value'];

    $idBooking = $penaltyDriving->payPenaltyByPAYU($idPenalty, $value);

    $bookingDriving->updateStatusBooking('Fined', $idBooking);
}