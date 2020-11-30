<?php

include_once('../../routes.php');


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

                    <div class="row centerLarge margin-top-1">
                        <div class="col-md-12 ">
                            <div class="card">
                                <div class="header">
                                </div>
                                <div class="content">

                                    <div class="row">
                                        <div class="col-md-1 col-md-offset-1">
                                            <h4 style=" margin-top: 8px;">Reporte:</h4>
                                        </div>
                                        <div class="col-md-1">
                                        </div>
                                        <div class="col-md-4">
                                            <select name="typeReport" id="typeReport" class="form-control">
                                                <option value="" selected style="color:gray">Seleccione un reporte
                                                </option>
                                                <option value="1">Dinero obtenido por multas en el año</option>
                                                <option value="2">Reservas realizadas en el año</option>
                                                <option value="3">Descargar realziadas en el año</option>

                                            </select>
                                        </div>
                                    </div>
                                    <br>



                                </div>
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

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

    $("#typeReport").change(function() {

        tReport = $('#typeReport').val();

        if (tReport == 1) {
            window.location.href =
                <?php echo "'" .  ROOT_DIRECTORY . ROUTE_ADMINISTRATOR . "report/reportMoneyPenaltysPerYear.php?year=2020" . "';" ?>
        } else if (tReport == 2) {

            window.location.href =
                <?php echo "'" .  ROOT_DIRECTORY . ROUTE_ADMINISTRATOR . "report/reportBookingsPerYear.php?year=2020" . "';" ?>
        } else if (tReport == 3) {
            window.location.href =
                <?php echo "'" .  ROOT_DIRECTORY . ROUTE_ADMINISTRATOR . "report/reportDownloadPerYear.php?year=2020" . "';" ?>

        }
    });
});
</script>




</html>