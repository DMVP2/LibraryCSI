<?php

//error_reporting(0);
include_once('../../routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'AuditDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Audit.php');


$c = Connection::getInstance();
$connection = $c->connectBD();

$auditDriving = new AuditDriving($connection);
$audits = $auditDriving->listAudit();

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

        <!-- Sidebar -->
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_COMPONENTS . "sidebar.php";
        ?>
        <!-- Sidebar -->


        <div class="main-panel">

            <div class="content">
                <div class="container-fluid ">


                    <br><br>
                    <div class="row centerLarge">
                        <div class="col-md-12 ">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Auditoria</h4>
                                </div>
                                <div class="content table-responsive table-full-width">

                                    <table id="tableEmployee" class="table table-hover table-striped">
                                        <thead>
                                            <th>Tabla</th>
                                            <th>Operación</th>
                                            <th>Dato antiguo</th>
                                            <th>Dato nuevo</th>
                                            <th>Ip</th>
                                            <th>Fecha</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($audits as $audit) {

                                                echo "<tr>";

                                                echo "<td>" . $audit->getTable() . "</td>";
                                                echo "<td>" . $audit->getOperation() . "</td>";
                                                echo "<td>" . $audit->getOldData() . "</td>";
                                                echo "<td>" . $audit->getNewData() . "</td>";
                                                echo "<td>" . $audit->getIp() . "</td>";
                                                echo "<td>" . $audit->getDate() . "</td>";

                                                echo "</tr>";
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
    $('#tableEmployee').DataTable();
});
</script>

</html>