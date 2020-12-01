<?php

include_once('routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_SESSION . 'UserSession.php');

$userSession = UserSession::getUserSession();
$rol = $userSession->getRol();
?>
<!DOCTYPE html>
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

</head>

<body>

    <div class="wrapper" style="height: 100%;width: 100%;margin-top: 6%;">

        <div class="main-panel" data="index" style="max-height:none; height: 100%;">

            <!-- Navbar -->
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_COMPONENTS . "navbar.php";
            ?>
            <!-- Navbar -->

            <div class="content">
                <div class="container-fluid ">

                    <?php if (strcasecmp($rol, 'client') == 0 || strcasecmp($rol, 'publisher') == 0) { ?>

                        <div class="row">
                            <div class="col-md-1 col-md-offset-1">
                                <h4 style="margin: 0; margin-top: 8px;">Buscar:</h4>
                            </div>
                            <div class="col-md-4">
                                <input type=" text" class="form-control" placeholder="Titulo del documento" id="titleDocument" name="titleDocument">
                            </div>
                            <div class="col-md-2">
                                <select name="category" id="category" class="form-control">
                                    <option value="" selected style="color:gray">Categoría</option>
                                    <option value="Niños">Niños</option>
                                    <option value="Adultos">Adultos</option>
                                </select>

                            </div>
                        </div>
                </div>
                <br>

            <?php } ?>



            <div id="carrousel"></div>
            <br>



            </div>
        </div>


        <!-- Footer -->
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_COMPONENTS . "footer.php";
        ?>
        <!-- Footer -->
    </div>
    <div>
        <!-- ModalRegister -->
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_FIELDS . "ModalRegister.php";
        ?>
    </div>
    <div>
        <!-- ModalRegister -->
        <!-- MyModalSubirDoc -->
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_FIELDS . "MyModalSubirDoc.php";
        ?>
    </div>
    <!-- MyModalSubirDoc -->


    <!-- ModalMoreInfoDoc include $_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_FIELDS . "ModalMoreInfoDoc.php";   ?> -->
    <!-- ModalMoreInfoDoc -->
    <div class="modal fade" id="modalMoreInfoDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="margin-top:5%">
                <div id="modalMoreInfoDocContent">

                </div>
            </div>
        </div>
    </div>
    <!-- ModalMoreInfoDoc -->
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

<script type="text/javascript">
    $(document).ready(function() {

        $.fn.rechargeData = function() {
            $('#carrousel').load(
                "<?php echo ROOT_DIRECTORY . ROUTE_FIELDS . "Client/carrousel.php" ?>", {
                    'title': $('#titleDocument').val(),
                    'category': $('#category').val()
                });
        }

        $("#titleDocument").on('keyup', function() {
            $.fn.rechargeData();
        });

        $("#category").change(function() {
            $.fn.rechargeData();
        });

        $.fn.rechargeData();
    });
    /*Función para mostrar el modal de la información detallada del documento, tiene como parámetro el ID del Doc */
    function updateModalMoreInfo(pIdDocument, pDigitalFisico) {
        $('#modalMoreInfoDocContent').load("<?php echo ROOT_DIRECTORY . ROUTE_FIELDS . "ModalMoreInfoDoc.php" ?>", {
            'idDocument': pIdDocument,
            'digitalFisico': pDigitalFisico,
        });
        $("#modalMoreInfoDoc").modal('show');
    }
    /*Función para ir a la ruta del procedimiento --bookingDocument-- por POST, en caso de que sea correcto envía a MyBookings el cod=1 mediante GET*/
    function bookingDocumentCarrusel(pIdDocument) {
        $.ajax({
            type: "POST",
            url: '<?php echo ROOT_DIRECTORY . ROUTE_PROCEDURES . "Client/bookingDocument.php" ?>',
            data: 'idDocument=' + pIdDocument,
            success: function(response) {
                var jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    window.location.href = "<?php echo ROOT_DIRECTORY . ROUTE_CLIENT . 'MyBookings.php?cod=1'  ?>"; //enviar a reserva
                } else {
                    notifications.showNotificationWarning("Ha ocurrido un error");
                }
            }
        });
    }
    /*Función para ir a la ruta del procedimiento --renovateBooking-- por POST, en caso de que sea correcto envía a MyBookings el cod=2 mediante GET*/
    function renovateBooking(pIdDocument, pDiasRenovacion) {
        $.ajax({
            type: "POST",
            url: '<?php echo ROOT_DIRECTORY . ROUTE_PROCEDURES . "Client/renovateBooking.php" ?>',
            data: 'idDocument=' + pIdDocument + '&diasRenovacion=' + pDiasRenovacion,
            success: function(response) {
                var jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    window.location.href = "<?php echo ROOT_DIRECTORY . ROUTE_CLIENT . 'MyBookings.php?cod=2'  ?>"; //enviar a reserva
                } else {
                    notifications.showNotificationWarning("Ha ocurrido un error");
                }
            }
        });
    }
    /*Función para ir a la ruta del procedimiento --payPenalty-- por POST, en caso de que sea correcto envía a MyBookings el cod=3 mediante GET*/
    function payPenaltyBooking(pIdDocument) {
        $.ajax({
            type: "POST",
            url: '<?php echo ROOT_DIRECTORY . ROUTE_PROCEDURES . "Client/payPenaltyBooking.php" ?>',
            data: 'idDocument=' + pIdDocument,
            success: function(response) {
                var jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    window.location.href = "<?php echo ROOT_DIRECTORY . ROUTE_CLIENT . 'MyBookings.php?cod=3'  ?>"; //enviar a reserva
                } else {
                    notifications.showNotificationWarning("Ha ocurrido un error");
                }
            }
        });
    }
    /*Función para ir a la ruta del procedimiento --joinQueue-- por POST, en caso de que sea correcto envía a MyBookings el cod=3 mediante GET*/
    function joinQueue(pIdDocument) {
        $.ajax({
            type: "POST",
            url: '<?php echo ROOT_DIRECTORY . ROUTE_PROCEDURES . "Client/joinQueue.php" ?>',
            data: 'idDocument=' + pIdDocument,
            success: function(response) {
                var jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    window.location.href = "<?php echo ROOT_DIRECTORY . ROUTE_CLIENT . 'MyBookings.php?cod=4' ?>"; //enviar a reserva
                } else {
                    notifications.showNotificationWarning("Ha ocurrido un error");
                }
            }

        });
    }
</script>

</html>