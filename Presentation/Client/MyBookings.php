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
    <link href="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'css/light-bootstrap-dashboard.css?v=1.4.0' ?>"
        rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'css/pe-icon-7-stroke.css' ?>" rel="stylesheet" />

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css"
        href="<?php echo ROOT_DIRECTORY . ROUTE_PRESENTATION_LIB . "DataTables/datatables.min.css" ?>" />

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
                                                        } else {
                                                            $status = 'Retirado';
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
<script type="text/javascript"
    src="<?php echo ROOT_DIRECTORY . ROUTE_PRESENTATION_LIB . "DataTables/datatables.min.js" ?>"></script>

<script>
$(document).ready(function() {
    $('#tableBookings').DataTable();
});
</script>

</html>