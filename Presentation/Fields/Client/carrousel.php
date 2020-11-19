<?php

include_once('../../../routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_SESSION . 'UserSession.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'DocumentDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Document.php');


$c = Connection::getInstance();
$connection = $c->connectBD();

$documentDriving = new DocumentDriving($connection);
$documents = $documentDriving->listDocuments();


$userSession = UserSession::getUserSession();

$rol = $userSession->getRol();

?>

<div class='row'>
    <div class='col-md-12 col-md-offset-1'>
        <div class="carousel slide" data-ride="carousel" id="quote-carousel">

            <!-- Carousel Slides / Quotes -->
            <div class="carousel-inner">
                <!-- Quote 1 -->
                <div class="item active">
                    <div class="row">

                        <?php foreach ($documents as $document) { ?>

                        <div class="col-md-2">
                            <div class="card col-md-12 ">
                                <br>
                                <div class="card-header text-center">
                                    <center><img
                                            src="<?php echo ROOT_DIRECTORY . ROUTE_IMAGES . 'documents/100anos.jpg' ?>"
                                            style="width: 50%; height: auto;"></center>

                                    <br>
                                    <p><?php echo $document->getTitle() ?></p>
                                    <p class="card-category">19/11/2020</p>

                                    <?php
                                        if (strcasecmp($rol, 'client') == 0) {
                                            echo "<input value='Ver más' type='button' class='btn btn-admin btn-fill'>";
                                            echo "<br>";
                                        }
                                        ?>

                                    <br>
                                </div>
                                <div class="card-body ">

                                </div>
                            </div>
                        </div>

                        <?php } ?>

                    </div>
                </div>
            </div>


            <!-- Carousel Buttons Next/Prev -->
            <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i
                    class="fa fa-chevron-left"></i></a>
            <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i
                    class="fa fa-chevron-right"></i></a>
        </div>
    </div>

</div>