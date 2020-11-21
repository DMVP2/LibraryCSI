<?php

include_once('../../../routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_SESSION . 'UserSession.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'DocumentDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Document.php');


$c = Connection::getInstance();
$connection = $c->connectBD();

$documentDriving = new DocumentDriving($connection);

$userSession = UserSession::getUserSession();
$rol = $userSession->getRol();

if (empty($_REQUEST['title']) and empty($_REQUEST['category'])) {
    $fisicos = $documentDriving->getTopDocuments("Fisico");
    $virtuales = $documentDriving->getTopDocuments("Virtual");
    $search = false;
} else {
    $search = true;

    if (!empty($_REQUEST['title']) and !empty($_REQUEST['category'])) {
        //Search by title and category
        $fisicos = $documentDriving->searchDocumentByFilter("Fisico", $_REQUEST['title'], $_REQUEST['category']);
        $virtuales = $documentDriving->searchDocumentByFilter("Virtual", $_REQUEST['title'], $_REQUEST['category']);
    } else if (!empty($_REQUEST['title'])) {
        //Search by title
        $fisicos = $documentDriving->searchDocumentByFilter("Fisico", $_REQUEST['title'], "");
        $virtuales = $documentDriving->searchDocumentByFilter("Virtual", $_REQUEST['title'], "");
    } else if (!empty($_REQUEST['category'])) {
        //Search by category
        $fisicos = $documentDriving->searchDocumentByFilter("Fisico", "", $_REQUEST['category']);
        $virtuales = $documentDriving->searchDocumentByFilter("Virtual", "", $_REQUEST['category']);
    }
}



?>
<div class="row" style="margin-top: 10px;">
    <div class="col-md-12 col-md-offset-1">
        <?php
        if ($search == false) {
            echo "<h3>Top libros físicos</h3>";
        } else {
            echo "<h3>Resultados de la búsqueda (físicos)</h3>";
        }
        ?>
    </div>
</div>

<div class='row'>
    <div class='col-md-offset-1 col-md-12'>
        <div class="carousel slide" data-ride="carousel" id="quote-carousel2">
            <!-- Carousel Slides / Quotes -->
            <div class="carousel-inner">

                <?php


                $aux = 0;
                $num = ceil(count($fisicos) / 5);
                for ($i = 0; $i < $num; $i++) {
                    if ($i == 0) {
                        echo "<div class='item active'>";
                    } else {
                        echo "<div class='item'>";
                    }
                    echo "<div class='row'>";


                    for ($j = 0; $j < 5; $j++) {
                        if (isset($fisicos[$aux])) {
                            echo "<div class='col-md-2'>";
                            echo "<div class='card col-md-12'>";
                            echo "<br>";
                            echo "<div class='card-header text-center'>";

                            echo " <center><img src='" . ROOT_DIRECTORY . ROUTE_IMAGES . "documents/100anos.jpg" . "'
                            style='width: 50%; height: auto;'></center>";
                            echo "<br>";
                            echo "<p>" . $fisicos[$aux]->getTitle() . "<p>";
                            echo "<p class='card-category'>" . $fisicos[$aux]->getDateOfPublication() . "</p>";

                            if (strcasecmp($rol, 'client') == 0) {
                                echo "<input value='Ver más' type='button' class='btn btn-admin btn-fill'>";
                                echo "<br><br>";
                            }
                            if ($search == false) {
                                echo "<p class='card-category'>Top: " . ($aux + 1) . "</p>";
                            }


                            echo "</div>";

                            echo "<div class='card-body'></div>";

                            echo "</div>";
                            echo "</div>";
                        } else {
                            echo "<div class='col-md-2'>";

                            echo "</div>";
                        }



                        $aux = $aux + 1;
                    }

                    echo "</div>";
                    echo "</div>";
                }


                ?>


            </div>

            <!-- Carousel Buttons Next/Prev -->
            <a data-slide="prev" href="#quote-carousel2" class="left carousel-control"><i
                    class="fa fa-chevron-left"></i></a>
            <a data-slide="next" href="#quote-carousel2" class="right carousel-control"><i
                    class="fa fa-chevron-right"></i></a>
        </div>
    </div>

</div>

<div class="row" style="margin-top: 10px;">
    <div class="col-md-12 col-md-offset-1">
        <?php

        if ($search == false) {
            echo "<h3>Top libros digitales</h3>";
        } else {
            echo "<h3>Resultados de la búsqueda (digitales)</h3>";
        }

        ?>

    </div>
</div>

<div class='row'>
    <div class='col-md-offset-1 col-md-12'>
        <div class="carousel slide" data-ride="carousel" id="quote-carousel3">
            <!-- Carousel Slides / Quotes -->
            <div class="carousel-inner">

                <?php
                $aux = 0;
                $num = ceil(count($virtuales) / 5);
                for ($i = 0; $i < $num; $i++) {
                    if ($i == 0) {
                        echo "<div class='item active'>";
                    } else {
                        echo "<div class='item'>";
                    }
                    echo "<div class='row'>";


                    for ($j = 0; $j < 5; $j++) {
                        if (isset($virtuales[$aux])) {
                            echo "<div class='col-md-2'>";
                            echo "<div class='card col-md-12'>";
                            echo "<br>";
                            echo "<div class='card-header text-center'>";

                            echo " <center><img src='" . ROOT_DIRECTORY . ROUTE_IMAGES . "documents/100anos.jpg" . "'
                            style='width: 50%; height: auto;'></center>";
                            echo "<br>";
                            echo "<p>" . $virtuales[$aux]->getTitle() . "<p>";
                            echo "<p class='card-category'>" . $virtuales[$aux]->getDateOfPublication() . "</p>";

                            if (strcasecmp($rol, 'client') == 0) {
                                echo "<input value='Ver más' type='button' class='btn btn-admin btn-fill'>";
                                echo "<br><br>";
                            }
                            if ($search == false) {
                                echo "<p class='card-category'>Top: " . ($aux + 1) . "</p>";
                            }
                            echo "</div>";

                            echo "<div class='card-body'></div>";

                            echo "</div>";
                            echo "</div>";
                        } else {
                            echo "<div class='col-md-2'>";

                            echo "</div>";
                        }



                        $aux = $aux + 1;
                    }

                    echo "</div>";
                    echo "</div>";
                }
                ?>


            </div>

            <!-- Carousel Buttons Next/Prev -->
            <a data-slide="prev" href="#quote-carousel3" class="left carousel-control"><i
                    class="fa fa-chevron-left"></i></a>
            <a data-slide="next" href="#quote-carousel3" class="right carousel-control"><i
                    class="fa fa-chevron-right"></i></a>
        </div>
    </div>

</div>