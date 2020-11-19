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
    <strong>Cliente:</strong> <?php echo $nameClient ?> <br>
    <strong>Libro: </strong><?php echo $document->getTitle() ?><br>
    <strong>Código: </strong><?php echo $document->getCode() ?><br>

</div>
<div class="modal-footer">
    <button id='btnConfirmExecute' type="button" class="btn btn-primary btn-fill"
        onclick="executeAction(<?php echo "'" . $status . "'," . $_REQUEST['idBooking']  ?>)">Confirmar</button>
    <button type="button" class="btn btn-employee btn-fill" data-dismiss="modal">Cerrar</button>

</div>