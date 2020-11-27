<?php
include_once('../../routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'BookingDriving.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'DocumentDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Booking.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Document.php');


$c = Connection::getInstance();
$connection = $c->connectBD();

$bookingDriving = new BookingDriving($connection);
$documentDriving = new DocumentDriving($connection);
$document = $documentDriving->getDocument($_REQUEST['idDocument']);
$authorsNames = $documentDriving->getAuthorsByDocumentId($_REQUEST['idDocument']);
$publisherName = $documentDriving->getPublisherByDocumentId($_REQUEST['idDocument']);
$cityCountry = $documentDriving->getCityCounty($_REQUEST['idDocument']);
$queuesCount = $documentDriving->getQueuesCountByDocumentId($_REQUEST['idDocument']);

//Variable del número de días máximos que puede tener en préstamo un libro un usuario
$numDiasMaxPrestamo = 3;

$idDoc = $_REQUEST['idDocument'];
$digiFisi = $_REQUEST['digitalFisico'];



?>
<div class="modal-content">

    <div class="modal-header" id="topTileModal">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <b><h3 class="modal-title" id="exampleModalLongTitle">
            <center> <?php echo $document->getTitle(); ?> — <?php echo $authorsNames[0]; ?></center>

        </h3></b>
    </div>

    <div class="row-md-12">
        <div class="col-md-6 float-left">
            <h5>
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
                    <b>Fecha: </b><?php echo $document ->getDateOfPublication();  ?><b style="font-size:xx-small;"> (AAAA-MM-DD)</b>
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
             
                <?php if($queuesCount[0] > 0){ ?>
                <p class="font-weight-light" style="color:darkcyan ;">
                    <b> ¡Este libro se encuentra en préstamo!  </b>                       <br>
                    El número de lectores en cola es <b><?php echo $queuesCount[0];?> </b>, tardará al rededor de <b><?php echo ( $queuesCount[0] * $numDiasMaxPrestamo ); ?> días.</b>
                </p>
                <?php } 
                else{
                    ?>
                     <p class="font-weight-light" style="color:darkcyan ;">
                    <b> ¡Este libro se encuentra en préstamo!  </b>                       <br>
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


            </div>
        </div>

    </div>
    <div class="modal-footer">

    </div>
</div>
<style>
#topTileModal{
    background-image: 
    linear-gradient(
      rgba(0, 0, 0, 0.09),
      rgba(0, 0, 0, 0.04)
    ),
     url('<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . "img/fondoNavBarFooterEncabezado.png";  ?>');
   -webkit-background-size: cover;
   -moz-background-size: cover;
   -o-background-size: cover;
   background-size: cover;
   height: 100%;
   width: 100% ;
   text-align: center; 
}
</style>