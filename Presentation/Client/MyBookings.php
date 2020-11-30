<?php

//error_reporting(0);
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1

include_once('../../routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_SESSION . 'UserSession.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'BookingDriving.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'PenaltyDriving.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'DocumentDriving.php');


include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Booking.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Penalty.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Document.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'User.php');

$c = Connection::getInstance();
$connection = $c->connectBD();

$userSession = UserSession::getUserSession();
$userSession->verifySession();

$usSesion = $userSession->getCurrentUser();
$idUser = $usSesion->getUserId();

$penaltygDriving = new PenaltyDriving($connection);
$bookingDriving = new BookingDriving($connection);
$documentDriving = new DocumentDriving($connection);

$bookings = $bookingDriving->listBookingById($idUser);



?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'img/iconApp.png' ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title><?php echo NAME_PROJECT ?></title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href=<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'css/bootstrap.min.css' ?> rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'css/animate.min.css' ?>" rel="stylesheet" />

    <!--  Light Bootstrap Table core CSS    -->
    <link href="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'css/light-bootstrap-dashboard.css?v=1.4.0' ?>" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'css/pe-icon-7-stroke.css' ?>" rel="stylesheet" />

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="<?php echo ROOT_DIRECTORY . ROUTE_PRESENTATION_LIB . "DataTables/datatables.min.css" ?>" />

</head>

<body>

    <div class="wrapper">

        <div class="main-panel" style="width: 100%; height: 94%;">

            <!-- Navbar -->
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_COMPONENTS . "navbar.php";
            ?>
            <!-- Navbar -->

            <div class="content">
                <div class="container-fluid ">

                    <br><br>
                    <div class="row centerLarge">
                        <div class="col-md-12 ">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Mis reservas</h4>
                                </div>
                                <div class="content table-responsive table-full-width">

                                    <table id="tableBookings" class="table table-hover table-striped">
                                        <thead>
                                            <th>Titulo</th>
                                            <th>Inicio</th>
                                            <th>Recogida</th>
                                            <th>Entrega</th>
                                            <th>Renovaciones</th>
                                            <th>Estado</th>
                                            <th>Acción</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($bookings != -1) {
                                                foreach ($bookings as $book) {

                                                    $titleDocument = $documentDriving->getTitleDocumentById($book->getIdDocument());
                                                    $idPenalty = $penaltygDriving->bookingIsPenalty($book->getId());
                                                    $status = $book->getBookingStatus();
                                                    $btnAction = "";

                                                    if ($idPenalty != null) {

                                                        $penalty = $penaltygDriving->searchPenaltyById($idPenalty);
                                                        $statusPenalty = $penalty->getStatus();
                                                        if (strcasecmp($statusPenalty, 'Paid') == 0) {
                                                            $status = 'Multa pagada';
                                                        } else {
                                                            $fecha1 = new DateTime($book->getDateOfCollection());
                                                            $fecha2 = new DateTime();
                                                            $diff = $fecha1->diff($fecha2);
                                                            $daysR = $diff->days;
                                                            $valueFined = $daysR * $bookingDriving->getValueFined();

                                                            $status = 'Multado sin pagar (' . number_format($valueFined) . ' COP)';
                                                            $btnAction =
                                                                "<form method='POST' action='" . ROOT_DIRECTORY . ROUTE_PROCEDURES . "client/payPenalty.php'>
                                                                <input type='hidden' id='valuePenalty' name='valuePenalty' value='" . $valueFined . "' >
                                                                <input type='hidden' id='idPenalty' name='idPenalty' value='" . $idPenalty . "' >
                                                                <input type='hidden' id='mailUser' name='mailUser' value='" . $usSesion->getMail() . "' >
    
                                                                <button type='submit' class='btn btn-admin btn-fill'> <i type='span' class='fa fa-money'></i>
                                                                </button>
                                                            </form>";
                                                        }
                                                    } else {
                                                        if (strcasecmp($status, 'Completed') == 0) {
                                                            $status = 'Finalizado';
                                                        } else if (strcasecmp($status, 'Reserved') == 0) {
                                                            $status = 'En Reserva';
                                                        } else if (strcasecmp($status, 'Retired') == 0) {
                                                            $status = 'En Préstamo';
                                                        } else if (strcasecmp($status, 'Penalty') == 0) {
                                                            $status = '<p style="color:red">Multado</p>';
                                                        } else if (strcasecmp($status, 'Canceled') == 0) {
                                                            $status = 'Multa Pagada';
                                                        }
                                                    }

                                                    echo "<tr>";
                                                    echo "<td>" . $titleDocument . "</td>";
                                                    echo "<td>" . $book->getBookingDate() . "</td>";
                                                    echo "<td>" . $book->getDeliveryDate() . "</td>";
                                                    echo "<td>" . $book->getDateOfCollection() . "</td>";
                                                    echo "<td>" . $book->getRenovations() . "</td>";

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
                </div>
            </div>


            <!-- Footer -->
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_COMPONENTS . "footer.php";
            ?>
            <!-- Footer -->

        </div>
    </div>

</body>
<!-- BookingInfo -->
<div class="modal fade" id="modalBookingInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="margin-top:15%">
            <div id="modalBookingInfoContent">

                <div class="modal-content">

                    <div class="modal-header" id="topTileModal">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <b>
                            <h3 style="margin: 1.5%;" class="modal-title" id="exampleModalLongTitle">
                                <center>Se ha realizado su reserva</center>

                            </h3>
                        </b>
                    </div>

                    <div style="margin: 2%;" class="row-md-12">
                        <p>- Apartir del momento cuenta con 3 días para retirar su libro y disfrutarlo.
                            <br><br>- Podrá renovarlo dos veces en caso de que ningún usuario entre a la cola de reserva. <br><br>
                            <b style="color:darkred">- De no realizar la devolución en el tiempo dado, se cobrarán 2.500$ COP por día.</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ModalBookingInfo -->

<!-- RenovateBookingInfo -->
<div class="modal fade" id="modalRenovateBookingInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="margin-top:15%">
            <div id="modalBookingInfoContent">

                <div class="modal-content">

                    <div class="modal-header" id="topTileModal">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <b>
                            <h3 style="margin: 1.5%;" class="modal-title" id="exampleModalLongTitle">
                                <center>Se ha realizado la renovación de su documento</center>

                            </h3>
                        </b>
                    </div>

                    <div style="margin: 2%;" class="row-md-12">
                        <p>- Apartir del momento cuenta con 3 días para seguir disfrutando de su libro. <br>
                            <b style="color:darkred">- De no realizar la devolución en el tiempo dado, se cobrarán 2.500$  por día.</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- RenovateModalBookingInfo -->




<!--   Core JS Files   -->
<script src="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'js/jquery.3.2.1.min.js' ?>" type="text/javascript">
</script>
<script src="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'js/bootstrap.min.js' ?>" type="text/javascript">
</script>

<!--  Charts Plugin -->
<script src="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'js/chartist.min.js' ?>"></script>

<!--  Notifications Plugin    -->
<script src="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'js/bootstrap-notify.js' ?>"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'js/light-bootstrap-dashboard.js?v=1.4.0' ?>"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'js/demo.js' ?>"></script>

<!-- DataTables -->
<script type="text/javascript" src="<?php echo ROOT_DIRECTORY . ROUTE_PRESENTATION_LIB . "DataTables/datatables.min.js" ?>"></script>

<script>
    $(document).ready(function() {
        $('#tableBookings').DataTable();
    });
</script>


<?php
if (isset($_GET['cod'])) {
    $cod = $_GET['cod'];
    if ($cod == 1) {

?> <script>
            $("#modalBookingInfo").modal('show');
        </script>
<?php
    }
}
?>

<?php
if (isset($_GET['cod'])) {
    $cod = $_GET['cod'];
    if ($cod == 2) {

?> <script>
            $("#modalRenovateBookingInfo").modal('show');
        </script>
<?php
    }
}
?>

</html>