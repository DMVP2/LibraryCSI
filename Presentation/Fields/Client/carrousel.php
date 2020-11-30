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

function recortarNombreLibro($texto, $limite = 30)
{
    $texto = trim($texto);
    $texto = strip_tags($texto);
    $tamano = strlen($texto);
    $resultado = '';
    if ($tamano <= $limite) {
        return $texto;
    } else {
        $texto = substr($texto, 0, $limite);
        $palabras = explode(' ', $texto);
        $resultado = implode(' ', $palabras);
        $resultado .= '...';
    }
    return $resultado;
}

if (empty($_REQUEST['title']) and empty($_REQUEST['category'])) {
    $fisicos = $documentDriving->getTopDocuments("Fisico", 15);
    $virtuales = $documentDriving->getTopDocuments("Virtual", 15);
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

<div class="row" style="margin-top:.5%;margin-bottom:2.5%;">
    <div class="col-md-12 col-md-offset-1">
        <?php
        if ($search == false) {
            echo "<h3>Top Libros Físicos</h3>";
        } else {
            echo "<h3>Resultados de la Búsqueda (Físicos)</h3>";
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
                if (count($fisicos) == 0) {
                    echo "<div class='item active'>";
                    echo "<div class='row'>";
                    echo "<div class='col-md-2''>";
                    echo "<div class='card col-md-12' style='height: 200px;>";
                    echo "<div class='card-header text-center' >";
                    echo "<br><br>";
                    echo "<center><p>No se encontraron resultados</p></center>";
                    echo "<br>";
                    echo "<i class='fa fa-frown-o pull-center' style='font-size: 3.0em; display: inline-block; width: 100%;'></i>";
                    echo "<div class='card-body'></div>";
                    echo "<br><br><br>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                } else {
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

                                if ($documentDriving->stateReservedDocument($fisicos[$aux]->getDocumentId()) == true) {
                                    $iconState = "<i class='fa fa-2x fa-clock-o pull-right' title='Este documento se encuentra reservado' style='color:skyblue;margin-left:-12%'></i>";
                                } else {
                                    $iconState = "";
                                }

                                echo "<div class='col-md-2'>";
                                echo "<div class='card col-md-12'";
                                if (strcasecmp($rol, 'client') == 0) {
                                    echo "style='height: 367px' > ";
                                } else {
                                    echo "style='height: 310px' >";
                                };
                                echo "<br>";
                                echo $iconState;
                                echo "<div class='card-header text-center'>";
                                if ($search == false) {
                                    echo "<b><p class='card-category'>TOP " . ($aux + 1) . "</b></p>";
                                }

                                echo " <center><img src='" . ROOT_DIRECTORY . ROUTE_IMAGES . "documents/100anos.jpg" . "'
                            style='width: 50%; height: auto;'></center>";
                                echo "<br>";
                                echo "<p><b>" . recortarNombreLibro($fisicos[$aux]->getTitle()) . "</b><p>";
                                $authorsNames = $documentDriving->getAuthorsByDocumentId($fisicos[$aux]->getDocumentId());
                                echo "<p style='font-size:13px' class='card-category'>" .  $authorsNames[0] . "</p>";
                                echo "<p style='font-size:13px' class='card-category'> Año: " . substr($fisicos[$aux]->getDateOfPublication(), 0, 4) . "</p>";

                                if (strcasecmp($rol, 'client') == 0) {
                                    /*                                     echo "<input value='Ver más' type='button' class='btn btn-admin btn-fill'>";
                                                                        echo "<br><br>"; */

                                    $digitalFisic = "Fisico";
                                    $btnMoreInfoPdf =  "<button  style='bottom:4%;position:absolute;right:19%' class='btn btn-admin btn-fill'  onClick=updateModalMoreInfo('" . $fisicos[$aux]->getDocumentId() . "','" . $digitalFisic . "')>   <i type='span' class='fa fa-book' aria-hidden='true'></i> Ver más </button>";
                                    echo $btnMoreInfoPdf;
                                    echo "<br>";
                                    echo "<br>";
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
                }

                ?>


            </div>

            <!-- Carousel Buttons Next/Prev -->
            <a data-slide="prev" href="#quote-carousel2" class="left carousel-control"><i class="fa fa-chevron-left" style="color:#F4D03F"></i></a>
            <a data-slide="next" href="#quote-carousel2" class="right carousel-control"><i class="fa fa-chevron-right" style="color:#F4D03F"></i></a>
        </div>
    </div>

</div>

<div class="row" style="margin-top:.5%;margin-bottom:2.5%;">
    <div class="col-md-12 col-md-offset-1">
        <?php

        if ($search == false) {
            echo "<h3>Top Libros Digitales</h3>";
        } else {
            echo "<h3>Resultados de la Búsqueda (Digitales)</h3>";
        }

        ?>

    </div>
</div>

<div class="wrapper" style="height: 100%;">

    <div class="main-panel" data="index" style="max-height:none; height: 100%;">


        <div class='row'>
            <div class='col-md-offset-1 col-md-12'>
                <div class="carousel slide" data-ride="carousel" id="quote-carousel3">
                    <!-- Carousel Slides / Quotes -->
                    <div class="carousel-inner">

                        <?php
                        if (count($virtuales) == 0) {
                            echo "<div class='item active'>";
                            echo "<div class='row'>";
                            echo "<div class='col-md-2''>";
                            echo "<div class='card col-md-12' style='height: 200px;>";
                            echo "<div class='card-header text-center' >";
                            echo "<br><br>";
                            echo "<center><p>No se encontraron resultados</p></center>";
                            echo "<br>";
                            echo "<i class='fa fa-frown-o pull-center' style='font-size: 3.0em; display: inline-block; width: 100%;'></i>";
                            echo "<div class='card-body'></div>";
                            echo "<br><br><br>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        } else {
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
                                        echo "<div class='card col-md-12'";
                                        if (strcasecmp($rol, 'client') == 0) {
                                            echo "style='height: 367px' > ";
                                        } else {
                                            echo "style='height: 310px' >";
                                        };
                                        echo "<br>";
                                        echo "<div class='card-header text-center'>";
                                        if ($search == false) {
                                            echo "<b><p class='card-category'>TOP " . ($aux + 1) . "</b></p>";
                                        }
                                        echo " <center><img src='" . ROOT_DIRECTORY . ROUTE_IMAGES . "documents/100anos.jpg" . "'
                                                   style='width: 50%; height: auto;'></center>";
                                        echo "<br>";
                                        echo "<p><b>" . recortarNombreLibro($fisicos[$aux]->getTitle()) . "</b><p>";
                                        $authorsNames = $documentDriving->getAuthorsByDocumentId($virtuales[$aux]->getDocumentId());
                                        echo "<p style='font-size:13px' class='card-category'>" .  $authorsNames[0] . "</p>";
                                        echo "<p style='font-size:13px' class='card-category'> Año: " . substr($virtuales[$aux]->getDateOfPublication(), 0, 4) . "</p>";

                                        if (strcasecmp($rol, 'client') == 0) {
                                            $digitalFisico = "Digital";
                                            $btnMoreInfoDoc =  "<button  style='bottom:4%;position:absolute;right:19%' class='btn btn-admin btn-fill'  onClick=updateModalMoreInfo('" . $virtuales[$aux]->getDocumentId() . "','" . $digitalFisico . "')>   <i type='span' class='fa fa-tablet' aria-hidden='true'></i> Ver más </button>";
                                            echo $btnMoreInfoDoc;
                                            echo "<br>";
                                            echo "<br>";
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
                        }

                        ?>


                    </div>


                    <!-- Carousel Buttons Next/Prev -->
                    <a data-slide="prev" href="#quote-carousel3" class="left carousel-control"><i class="fa fa-chevron-left" style="color:skyblue"></i></a>
                    <a data-slide="next" href="#quote-carousel3" class="right carousel-control"><i class="fa fa-chevron-right" style="color:skyblue"></i></a>