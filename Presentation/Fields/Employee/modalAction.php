<?php

include_once('../../../routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'BookingDriving.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'DocumentDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Booking.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Document.php');


$c = Connection::getInstance();
$connection = $c->connectBD();

$bookingDriving = new BookingDriving($connection);
$documentDriving = new DocumentDriving($connection);

$status = $_REQUEST['status'];

if (strcasecmp($status, 'Retired') == 0) {
    $title = '¿Desea confirmar el ingreso del documento?';
} else if (strcasecmp($status, 'Reserved') == 0) {
    $title = '¿Desea confirmar la entrega del documento?';
} else if (strcasecmp($status, 'Fined') == 0) {
    $title = '¿Desea confirmar el pago de la multa y el ingreso del documento?';
}

$nameClient = $bookingDriving->getNameBookingByDocument($_REQUEST['idBooking']);
$document = $documentDriving->getDocument($_REQUEST['idDocument']);

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $title ?> </h5>
</div>
<div class="modal-body">
    <?php
    echo "<strong>Cliente: </strong>" . $nameClient . "<br>";
    if (strcasecmp($status, 'Retired') == 0 || strcasecmp($status, 'Reserved') == 0) {
        echo "<strong>Documento: </strong>" . $document->getTitle() . "<br>";
        echo "<strong>Código: </strong>" . $document->getCode() . "<br>";
    } else {
        $booking = $bookingDriving->search($_REQUEST['idBooking']);

        $fecha1 = new DateTime($booking->getDateOfCollection());
        $fecha2 = new DateTime();
        $diff = $fecha1->diff($fecha2);
        $daysR = $diff->days - 1;
        $valueFined = $daysR * $bookingDriving->getValueFined();

        echo "<strong>Documento: </strong>" . $document->getTitle() . "<br>";
        echo "<strong>Código: </strong>" . $document->getCode() . "<br>";
        echo "<strong>Inicio de la reserva: </strong>" . $booking->getBookingDate() . "<br>";
        echo "<strong>Fin de la reserva: </strong>" . $booking->getDateOfCollection() . "<br>";
        echo "<strong>Renovaciones: </strong>" . $booking->getRenovations() . "<br>";
        echo "<strong>Días de retardo: </strong>" . $daysR . "<br>";
        echo "<strong>Valor a pagar: </strong>" .  number_format($valueFined) . " COP<br>";
    }
    ?>

</div>
<div class="modal-footer">
    <?php
    if (strcasecmp($status, 'Retired') == 0 || strcasecmp($status, 'Reserved') == 0) {
        echo "<button id='btnConfirmExecute' type='button' class='btn btn-primary btn-fill' onclick=executeAction('" . $status . "'," . $_REQUEST['idBooking'] . ")>Confirmar</button>";
    } else {
        echo "<button id='btnConfirmExecute' type='button' class='btn btn-primary btn-fill' onclick='payPenalty(" . $_REQUEST['idBooking'] . "," . $valueFined . ")'>Confirmar</button>";
    }

    ?>




    <button type="button" class="btn btn-employee btn-fill" data-dismiss="modal">Cerrar</button>

</div>