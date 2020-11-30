<?php
include_once('../../routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'BookingDriving.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'DocumentDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Booking.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Document.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'User.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_SESSION . 'UserSession.php');

$c = Connection::getInstance();
$connection = $c->connectBD();

$userSession = UserSession::getUserSession();
$userSession->verifySession();
$usSesion = $userSession->getCurrentUser();
$idUser = $usSesion->getUserId();

$bookingDriving = new BookingDriving($connection);
$documentDriving = new DocumentDriving($connection);
$document = $documentDriving->getDocument($_REQUEST['idDocument']);
$authorsNames = $documentDriving->getAuthorsByDocumentId($_REQUEST['idDocument']);
$publisherName = $documentDriving->getPublisherByDocumentId($_REQUEST['idDocument']);
$cityCountry = $documentDriving->getCityCounty($_REQUEST['idDocument']);
$queuesCount = $documentDriving->getQueuesCountByDocumentId($_REQUEST['idDocument']);

//Variable del número de días máximos que puede tener en préstamo un libro un usuario
$numDiasMaxPrestamo = 3;
// Número de renovaciones a reservas que puede realizar una persona 
$numRenovaciones = 3;


$idDoc = $_REQUEST['idDocument'];
$digiFisi = $_REQUEST['digitalFisico'];

$documentoReservadoBool = $documentDriving->stateReservedDocument($idDoc);
$bookingState = $bookingDriving->searchBookingStateByDocumentId($idDoc);
$userIdBookingByDocumnetId = $bookingDriving->getUserIdBooking($idDoc);
$userIdPenaltyBookingByDocumnetId = $bookingDriving->getUserIdPenaltyBooking($idDoc);
$renovationsBookingByDocId = $bookingDriving->getRenovationsBookingByDocId($idDoc);



?>
<div class="modal-content">

    <div class="modal-header" id="topTileModal">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <b>
            <h3 class="modal-title" id="exampleModalLongTitle">
                <center> <?php echo $document->getTitle(); ?> — <?php echo $authorsNames[0]; ?></center>

            </h3>
        </b>
    </div>

    <div class="row-md-12">
        <div class="col-md-6 float-left">
            <h5 style="margin-top:7%;">
                <center><b>
                        <?php if ($digiFisi == 'Digital') {
                            echo 'Datos del Documento';
                        } else {
                            echo 'Datos del Libro';
                        } ?></b> </center>
            </h5>
            <div class="row-md-12 float-left ">


                <p class="font-weight-light">
                    <?php if ($digiFisi == 'Digital') {
                        echo '<b>DOI:</b> ';
                        echo $document->getCode();
                    } else {
                        echo '<b>ISBN: </b>';
                        echo $document->getCode();
                    } ?> </p>
                <p class="font-weight-light">
                    <b>Editorial:</b> <?php echo $document->getEditorial(); ?>
                </p>
                <p class="font-weight-light">
                    <b>Idioma:</b> <?php echo $document->getLanguage(); ?>
                </p>
                <p class="font-weight-light">
                    <b> No. Páginas:</b> <?php echo $document->getNumOfPages(); ?>
                </p>
                <p class="font-weight-light">
                    <b>Lugar de Publicación: </b><br><?php echo $cityCountry[0];  ?> — <?php echo $cityCountry[1];  ?>
                </p>
                <p class="font-weight-light">
                    <b>Fecha: </b><?php echo $document->getDateOfPublication();  ?><b style="font-size:xx-small;"> (AAAA-MM-DD)</b>
                </p>
                <p>
                    <?php
                    $cantidad = count($authorsNames);
                    if ($cantidad > 1) {
                        echo '<b>Autores: </b><br><ul>';
                        foreach ($authorsNames as &$name) {
                            echo '<li>' . $name . '</li>';
                        }
                        echo '</ul>';
                    } else {
                        echo '<b>Autor: </b>' . $authorsNames[0];
                    } ?>
                </p>
                <p class="font-weight-light">
                    <b> Descripción:</b> <?php echo $document->getDescription(); ?>
                </p>

                <?php if ($queuesCount[0] > 0) { ?>
                    <p class="font-weight-light" style="color:darkcyan ;">
                        <b> ¡Este libro se encuentra en préstamo! </b> <br>
                        El número de lectores en cola es <b><?php echo $queuesCount[0]; ?> </b>, tardará máximo <b><?php echo (($queuesCount[0] + 1) * $numDiasMaxPrestamo); ?> días.</b>
                    </p>
                <?php } else if ($documentoReservadoBool && $userIdBookingByDocumnetId[0] != $idUser) {
                ?><p class="font-weight-light" style="color:darkcyan ;">
                        <b> ¡Este libro se encuentra en préstamo! </b> <br>
                        Nadie ha ingresado a la cola, se el primero en hacerlo para acceder al libro en <b>máximo 3 días. </b>
                    </p>
                <?php
                }
                ?>


            </div>
        </div>
        <div class="col-md-6 float-right">
            <div class="row-md-12 float-right">

                <?php echo "<img src='" . ROOT_DIRECTORY . ROUTE_IMAGES . "documents/100anos.jpg" . "' style='width: 95%; height: 90%; margin-top:6%;'>"; ?>
                <p class="font-weight-light">
                    <center><i><b> Publicador:</b> <?php echo $publisherName[0]; ?></i></center>
                </p>
                <?php
                echo ($renovationsBookingByDocId[0]);
                //Para cuando el documento es reservado por uno mismo y SÍ se puede renovar
                if ($documentoReservadoBool && $userIdBookingByDocumnetId[0] == $idUser && $renovationsBookingByDocId[0] <= $numRenovaciones && $queuesCount[0] == 0) {
                ?>
                    <div>
                        <center>
                            <?php
                            $btnRenovarReserva =  "<button  class='btn btn-success '  onClick='renovateBooking(" . $idDoc . ", " . $numRenovaciones . ")'>   <i type='span' class='fa fa-recycle' aria-hidden='true'></i> &nbsp;Renovar</button>";
                            echo $btnRenovarReserva;
                            ?>
                            <p class="font-weight-light" style="color:#87cb16;margin:3%;"> ¡Tienes el libro en préstamo! ¿Deseas renovar la reserva?</p>
                        </center>
                    </div>
                <?php
                    // Cuándo se tiene un libro y otro usuario ingresa  a la cola
                } else if ($documentoReservadoBool && $userIdBookingByDocumnetId[0] == $idUser && $renovationsBookingByDocId[0] <= $numRenovaciones && $queuesCount[0] > 0) {
                ?>
                    <div>
                        <center>
                            <p class="font-weight-light" style="color:#1D62F0;margin:3%;"> Tienes este libro en prestamo, no puedes renovarlo debido a que otros usuarios entraron a la cola de préstamo.
                                <br><br> Recuerda reazlizar la devolución en el tiempo establecido</p>
                        </center>
                    </div>
                    <?php
                    // Para pagar una multa por una reserva con multa en curso
                } else if ($documentoReservadoBool && count($userIdPenaltyBookingByDocumnetId) > 0) {
                    if ($userIdPenaltyBookingByDocumnetId[0] == $idUser) {
                    ?>
                        <div>
                            <center>
                                <?php
                                $btnReserva =  "<button  class='btn btn-danger '  onClick=payPenalty('" . $idDoc . "')>   <i type='span' class='fa fa-suitcase' aria-hidden='true'></i> &nbsp;Pagar</button>";
                                echo $btnReserva;
                                ?>
                                <p class="font-weight-light" style="color:#1D62F0;margin:3%;"> Se ha vencido el tiempo de préstamo, en este momento estás siendo multado. Procede a pagar y entregar el documento lo antes posible.</p>
                            </center>
                        </div>
                    <?php
                    }
                } else if (!$documentoReservadoBool) {
                    ?>

                    <div>
                        <center>
                            <?php

                            $btnReserva =  "<button  class='btn btn-primary '  onClick=bookingDocumentCarrusel('" . $idDoc . "')>   <i type='span' class='fa fa-suitcase' aria-hidden='true'></i> &nbsp;Reservar</button>";
                            echo $btnReserva;
                            ?>
                            <p class="font-weight-light" style="color:#1D62F0;margin:3%;"> ¡El libro se encuentra disponible para reservar!</p>
                        </center>
                    </div>
                <?php
                } else if ($documentoReservadoBool && $queuesCount[0] == 0) {
                ?>
                    <div>
                        <center>
                            <?php
                            $btnReserva =  "<button  class='btn btn-secondary '  onClick=joinQueue('" . $idDoc . "')>   <i type='span' class='fa fa-suitcase' aria-hidden='true'></i> &nbsp;Ingresar</button>";
                            echo $btnReserva;
                            ?>
                            <p class="font-weight-light" style="color:#1D62F0;margin:3%;"> El libro se encuentra en préstamo, ¡Ingresa a la cola de préstramo de primero!</p>
                        </center>
                    </div>
                <?php
                } else if ($documentoReservadoBool && $queuesCount[0] > 0) {
                ?>
                    <div>
                        <center>
                            <?php

                            $btnReserva =  "<button  class='btn btn-secondary '  onClick=joinQueue('" . $idDoc . "')>   <i type='span' class='fa fa-suitcase' aria-hidden='true'></i> &nbsp;Ingresar</button>";
                            echo $btnReserva;
                            ?>
                            <p class="font-weight-light" style="color:#1D62F0;margin:3%;"> El libro se encuentra en préstamo, ingresa a la cola en la posición No. <?php ($queuesCount[0] + 1) ?></p>
                        </center>
                    </div>
                <?php
                } else if ($documentoReservadoBool && $bookingState[0] == 'Penalty') {
                ?>
                    <div>
                        <center>
                            <p class="font-weight-light" style="color:#1D62F0;margin:3%;"> El libro se encuentra en multado, en cuánto sea devuelto podrás reservarlo</p>
                        </center>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>

    </div>
    <div class="modal-footer">

    </div>
</div>
<style>
    #topTileModal {
        background-image:
            linear-gradient(rgba(0, 0, 0, 0.09),
                rgba(0, 0, 0, 0.04)),
            url('<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . "img/fondoNavBarFooterEncabezado.png";  ?>');
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        height: 100%;
        width: 100%;
        text-align: center;
    }
</style>