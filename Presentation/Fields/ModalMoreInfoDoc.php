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
// Número máximo de prestam,os al tiempo
$numMaxPrestamos = 3;


$idDoc = $_REQUEST['idDocument'];
$digiFisi = $_REQUEST['digitalFisico'];

$documentoReservadoBool = $documentDriving->stateReservedDocument($idDoc);
$bookingState = $bookingDriving->searchBookingStateByDocumentId($idDoc);
$bookingDateEnd = $bookingDriving->getDateEndBooking($idDoc);
$userIdBookingByDocumnetId = $bookingDriving->getUserIdBooking($idDoc);
$userIdPenaltyBookingByDocumnetId = $bookingDriving->getUserIdPenaltyBooking($idDoc);
$renovationsBookingByDocId = $bookingDriving->getRenovationsBookingByDocId($idDoc);
$countBookingsByUserId = $bookingDriving->getCountBookingsByUserId($idUser);
$countPenaltysByUserId = $bookingDriving->getCountPenaltysByUserId($idUser);

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
                    <b>Lugar de Publicación: </b><br><?php if(count($cityCountry) > 0){ echo $cityCountry[0];  ?> — <?php echo $cityCountry[1]; }else{echo("Ingrese Ciudad y País");}?>
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
            </div>
        </div>
        <div class="col-md-6 float-right">
            <div class="row-md-12 float-right">

                <?php echo "<img src='" . ROOT_DIRECTORY . ROUTE_IMAGES . "documents/".$idDoc.".jpg" . "' style='width: 95%; height: 90%; margin-top:6%;'>"; ?>
                
                <p class="font-weight-light">
                    <center><i><b> Publicador:</b> <?php echo $publisherName[0]; ?></i></center>
                </p>

                <?php

                //-Cuando el documento es reservado por uno mismo y SÍ se puede renovar
                if ($documentoReservadoBool && $userIdBookingByDocumnetId[0] == $idUser && $renovationsBookingByDocId[0] <= $numRenovaciones && $queuesCount[0] == 0 && $countPenaltysByUserId[0] == 0) {
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
                    //-Cuándo tiene una multa activa de cualquier libro
                } else if ($countPenaltysByUserId[0] > 0 && count($userIdPenaltyBookingByDocumnetId) == 0) {
                ?>
                    <div>
                        <center>
                            <form action="<?php echo ROOT_DIRECTORY . ROUTE_CLIENT . 'MyBookings.php' ?>">

                                <?php
                                $btnIrAReservas =  "<button  type='submit' class='btn btn-danger'> <i type='span' class='fa fa-frown-o' aria-hidden='true'></i> &nbsp;Ver multa</button>";

                                echo $btnIrAReservas;
                                ?>
                                <p class="font-weight-light" style="color:darkred;margin:3%;"> Cuentas con <?php echo $countPenaltysByUserId[0]; ?> libro<?php if ($countPenaltysByUserId[0] > 1) echo ('s') ?> en penalidad activa.
                                    <br><b>Por favor realizar el pago lo más pronto posible.</b></p>
                        </center>
                        </form>
                    </div>
                <?php
                    //- Se ha cumplido el número máximo de renovaciones
                } else if ($documentoReservadoBool && $userIdBookingByDocumnetId[0] == $idUser && $renovationsBookingByDocId[0] > $numRenovaciones && $queuesCount[0] == 0 && $countPenaltysByUserId[0] == 0 && $digiFisi == 'Fisico') {
                ?>
                    <div>
                        <center>
                            <p class="font-weight-light" style="color:#1D62F0;margin:3%;"> Tienes este libro en prestamo, ¡Has cumplido el límite de renovaciones ( <?php echo $numRenovaciones; ?> veces).
                                <br><br> Recuerda reazlizar la devolución en el tiempo establecido</p>
                        </center>
                    </div>
                <?php
                    //Tiene el libro en préstamo y se unieron personas a la cola
                } else if ($documentoReservadoBool && $userIdBookingByDocumnetId[0] == $idUser && $renovationsBookingByDocId[0] <= $numRenovaciones && $queuesCount[0] > 0 && $digiFisi == 'Fisico') {
                ?>
                    <div>
                        <center>
                            <p class="font-weight-light" style="color:#1D62F0;margin:3%;"> Tienes este libro en prestamo, no puedes renovarlo debido a que otros usuarios entraron a la cola de préstamo.
                                <br><br> Recuerda reazlizar la devolución en el tiempo establecido</p>
                        </center>
                    </div>
                    <?php
                    // Para pagar una multa por una reserva de x documento -- hay error en la cuenta de payPal
                } else if ($documentoReservadoBool && count($userIdPenaltyBookingByDocumnetId) > 0 && $digiFisi == 'Fisico') {
                    if ($userIdPenaltyBookingByDocumnetId[0] == $idUser) {
                    ?>
                        <div>
                            <center>
                                <!-- <?php
                                
                                $btnReserva =  "<button  class='btn btn-danger '  onClick=payPenaltyBooking('" . $idDoc . "')>   <i type='span' class='fa fa-money' aria-hidden='true'></i> &nbsp;Pagar Multa Directo</button>";
                                echo $btnReserva;
                                ?> -->
                                 <?php
                                  $fecha1 = new DateTime($bookingDateEnd[0]);
                                  $fecha2 = new DateTime();
                                  $diff = $fecha1->diff($fecha2);
                                  $daysR = $diff->days;
                                  $valueFined = $daysR * $bookingDriving->getValueFined();

                                  $status = 'Multado sin pagar (' . number_format($valueFined) . ' COP)';
                                  $btnAction =
                                      "<form method='POST' action='" . ROOT_DIRECTORY . ROUTE_PROCEDURES . "client/payPenalty.php'>
                                      <input type='hidden' id='valuePenalty' name='valuePenalty' value='" . $valueFined . "' >
                                      <input type='hidden' id='idPenalty' name='idPenalty' value='" . $idDoc . "' >
                                      <input type='hidden' id='mailUser' name='mailUser' value='" . $usSesion->getMail() . "' >

                                      <button  class='btn btn-danger ' type='submit'>   <i type='span' class='fa fa-money' aria-hidden='true'></i> &nbsp;Pagar Multa Directo</button>
                                      </button>
                                  </form>";
                                   echo $btnAction;
                                ?>
                                <p class="font-weight-light" style="color:indianred;margin:3%;"> ¡En este momento estás siendo multado por éste préstamo!, <b>Procede a pagar y entregar el libro lo antes posible.</b></p>
                            </center>
                        </div>
                    <?php
                    }
                    //Para reservar en caso de que el documnento deje hacerlo
                } else if (!$documentoReservadoBool && $countBookingsByUserId[0] < $numMaxPrestamos && $countPenaltysByUserId[0] == 0 && $digiFisi == 'Fisico') {
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
                    //Ingresar a la cola de Primero
                } else if ($documentoReservadoBool && $queuesCount[0] == 0 && $userIdBookingByDocumnetId[0] != $idUser && $digiFisi == 'Fisico') {
                ?>
                    <div>
                        <center>
                            <?php
                            $btnReserva =  "<button  class='btn btn-secondary '  onClick=joinQueue('" . $idDoc . "')>   <i type='span' class='fa fa-share' aria-hidden='true'></i> &nbsp;Ingresar</button>";
                            echo $btnReserva;
                            ?>
                            <p class="font-weight-light" style="color:#154360;margin:3%;"> El libro se encuentra en préstamo, ¡Ingresa a la cola de préstramo de primero!</p>
                        </center>
                    </div>
                <?php
                    // Ingresar a la cola >1
                } else if ($documentoReservadoBool && $queuesCount[0] > 0 && $userIdBookingByDocumnetId[0] != $idUser && $digiFisi == 'Fisico' ) {
                ?>
                    <div>
                        <center>
                            <?php

                            $btnReserva =  "<button  class='btn btn-secondary '  onClick=joinQueue('" . $idDoc . "')>   <i type='span' class='fa fa-share' aria-hidden='true'></i> &nbsp;Ingresar</button>";
                            echo $btnReserva;
                            ?>
                            <p class="font-weight-light" style="color:#154360;margin:3%;"> El libro se encuentra en préstamo, ingresa a la cola en la posición No. <?php ($queuesCount[0] + 1) ?></p>
                        </center>
                    </div>
                <?php
                } else if ($documentoReservadoBool && $bookingState[0] == 'Penalty' && $digiFisi == 'Fisico') {
                ?>
                    <div>
                        <center>
                            <p class="font-weight-light" style="color:#1D62F0;margin:3%;"> Lo sentimos, el libro se encuentra en multa a otro usuario, en cuánto sea devuelto podrás reservarlo</p>
                        </center>
                    </div>
                <?php
                }else if ($digiFisi == 'Digital') {
                    ?>
                        <div>
                        <center>
                            <?php

                            $btnReserva =  "<button  class='btn btn-secondary '  onClick=()  <i type='span' class='fa fa-download' aria-hidden='true'></i> &nbsp;Descargar</button>";
                            echo $btnReserva;
                            ?>
                            <p class="font-weight-light" style="color:#154360;margin:3%;"> Descarga este documento totalmenta gratis</p>
                        </center>
                        </div>
                    <?php
                    } else{echo('');}
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