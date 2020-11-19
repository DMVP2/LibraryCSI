<?php

include_once('../../../routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'BookingDriving.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'DocumentDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Booking.php');


$c = Connection::getInstance();
$connection = $c->connectBD();

$bookingDriving = new BookingDriving($connection);
$documentDriving = new DocumentDriving($connection);

$idUser = $_REQUEST['idUser'];
$books = $bookingDriving->searchBookingActivesByUserId($idUser);

?>

<br>
<div class="row centerLarge">
    <div class="col-md-12 ">
        <div class="card">
            <div class="header">
                <h5 class="title">Reservas</h5>
            </div>
            <div class="content table-responsive table-full-width">

                <table class="table table-hover table-striped">
                    <thead>
                        <th>Titulo</th>
                        <th>Fecha de reserva</th>
                        <th>Fecha de recogida</th>
                        <th>Fecha de entrega</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        <?php

                        if ($books == -1) {
                            echo "<tr><td colspan='6'><center>No se encontrarón datos.</center></td></tr>";
                        } else {
                            foreach ($books as $book) {

                                $status = $book->getBookingStatus();

                                if (strcasecmp($status, 'Reserved') == 0) {
                                    $btnAction = " <button class='btn btn-admin btn-fill' onClick=updateModal('" . $status . "'," . $book->getId() . "," . $book->getIdDocument() . ")>
                                                        <i type='span' class='fa fa-check' aria-hidden='true'></i>
                                                    </button>";
                                    $status = "Reservado";
                                } else if (strcasecmp($status, 'Retired') == 0) {

                                    $btnAction = "<button class='btn btn-primary btn-fill' onClick=updateModal('" . $status . "'," . $book->getId() . "," . $book->getIdDocument() . ")>
                                                    <i type='span' class='fa fa fa-sign-in' aria-hidden='true'></i>
                                                  </button>";
                                    $status = "Retirado";
                                }

                                $title = $documentDriving->getTitleDocumentById($book->getIdDocument());

                                echo "<tr>";
                                echo "<td>" . $title . "</td>";
                                echo "<td>" . $book->getBookingDate() . "</td>";
                                echo "<td>" . $book->getDeliveryDate() . "</td>";
                                echo "<td>" . $book->getDateOfCollection() . "</td>";
                                echo "<td>" . $status . "</td>";

                                echo "<td>" . $btnAction . "</td>";

                                echo "</tr>";
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>