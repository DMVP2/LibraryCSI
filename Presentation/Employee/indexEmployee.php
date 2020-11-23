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
                        <div class="col-md-8 col-md-offset-2 ">
                            <div class="card">
                                <div class="header">
                                </div>
                                <div class="content">
                                    <form id='formClient'>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label>&nbsp;</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Tipo de documento</label>
                                                    <select name="typeDocument" id="typeDocument" class="form-control">
                                                        <option value="C.C.">C.C.</option>
                                                        <option value="C.E.">C.E.</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label>Número de documento</label>
                                                    <input type="number" class="form-control" id="numberDocument"
                                                        name="numberDocument" placeholder="Número de documento">
                                                </div>
                                            </div>
                                        </div>
                                    </form>




                                    <div class="clearfix"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tableClientBooking">
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


    <!-- Modal Reserva-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="margin-top:40%">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLongTitle">Reservar documento</h5>
                </div>
                <div class="modal-body">
                    <form id="formDoReserve">
                        <div class="row">
                            <div class="col-md-4" style="padding-top: 10px;">
                                Código del documento:
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="codeDocumentReserve"
                                    name="codeDocumentReserve" placeholder="Código del documento" autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4" style="padding-top: 10px;">
                                Nombre del documento:
                            </div>
                            <div class="col-md-8" style="padding-top: 10px;">
                                <label id="titleReserve" name="titleReserve"></label>
                            </div>
                        </div>
                        <input id="idDocumentReserve" name="idDocumentReserve" value="" type="hidden">
                        <input id="idClientReserve" name="idClientReserve" value="" type="hidden">

                </div>
                <div class="modal-footer">
                    <button id="btnReserveDocument" type="submit" class="btn btn-primary btn-fill">Hacer
                        reserva</button>
                    <button type="button" class="btn btn-employee btn-fill" data-dismiss="modal">Cerrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Accion-->
    <div class="modal fade" id="modalAction" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="margin-top:40%">
                <div id="modalActionContent">

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

<script type="text/javascript">
$(document).ready(function() {

    $.fn.rechargeData = function() {
        $('#tableClientBooking').load(
            "<?php echo ROOT_DIRECTORY . ROUTE_FIELDS . "Employee/tableBooking.php" ?>", {
                'typeId': $('#typeDocument').val(),
                'idUser': $('#numberDocument').val()
            });
    }

    $.fn.rechargeDataReserveModal = function() {
        $.ajax({
            type: "POST",
            url: '<?php echo ROOT_DIRECTORY . ROUTE_PROCEDURES . "employee/reserveDocument.php"  ?>',
            data: 'action=1&' + 'code=' + $('#codeDocumentReserve').val(),
            success: function(response) {
                var jsonData = JSON.parse(response);
                $('#titleReserve').html(jsonData.success);

                if (jsonData.code == "-1" || jsonData.code == "-2") {
                    $('#btnReserveDocument').prop('disabled', true);
                    $('#idDocumentReserve').val(-1);
                    $('#idClientReserve').val(-1);


                } else {
                    $('#btnReserveDocument').prop('disabled', false);
                    $('#idDocumentReserve').val(jsonData.code);
                    $('#idClientReserve').val($('#numberDocument').val());

                }
            }
        });
    }

    $("#numberDocument").on('keyup', function() {
        $.fn.rechargeData();
    });

    $("#codeDocumentReserve").on('keyup', function() {
        $.fn.rechargeDataReserveModal();
    });

    $('#formClient').submit(function(e) {
        e.preventDefault();
    });

    $.fn.rechargeData();


    $('#formDoReserve').submit(function(e) {
        $('#btnReserveDocument').prop('disabled', true);
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '<?php echo ROOT_DIRECTORY . ROUTE_PROCEDURES . "employee/reserveDocument.php"  ?>',
            data: $(this).serialize(),
            success: function(response) {
                var jsonData = JSON.parse(response);

                if (jsonData.success == "1") {
                    $("#exampleModalCenter").modal('hide');
                    notifications.showNotificationInfo(
                        "Se ha realizado la reserva con éxito");
                    $.fn.rechargeData();
                } else {
                    notifications.showNotificationWarning("Ha ocurrido un error");
                }
                $('#btnReserveDocument').prop('disabled', false);
            }
        });
    });
});

function updateModal(pStatus, pIdBooking, pIdDocument) {
    $('#modalActionContent').load("<?php echo ROOT_DIRECTORY . ROUTE_FIELDS . "Employee/modalAction.php" ?>", {
        'status': pStatus,
        'idBooking': pIdBooking,
        'idDocument': pIdDocument
    });
    $("#modalAction").modal('show');
}

function executeAction(pStatus, pIdBooking) {

    $('#btnConfirmExecute').prop('disabled', true);
    $.ajax({
        type: "POST",
        url: '<?php echo ROOT_DIRECTORY . ROUTE_PROCEDURES . "employee/executeAction.php"  ?>',
        data: 'status=' + pStatus + '&idBooking=' + pIdBooking,
        success: function(response) {
            var jsonData = JSON.parse(response);

            if (jsonData.success == "1") {
                $("#modalAction").modal('hide');
                notifications.showNotificationInfo("Se ha realizado la operación con éxito");
                $.fn.rechargeData();
            } else {
                notifications.showNotificationWarning("Ha ocurrido un error");
            }
            $('#btnConfirmExecute').prop('disabled', false);
        }
    });
}

function payPenalty(pIdBooking, pValue) {

    $('#btnConfirmExecute').prop('disabled', true);
    $.ajax({
        type: "POST",
        url: '<?php echo ROOT_DIRECTORY . ROUTE_PROCEDURES . "employee/executeAction.php"  ?>',
        data: 'status=Fined&idBooking=' + pIdBooking + '&value=' + pValue,
        success: function(response) {
            var jsonData = JSON.parse(response);

            if (jsonData.success == "1") {
                $("#modalAction").modal('hide');
                notifications.showNotificationInfo("Se ha cancelado la multa con éxito");
                $.fn.rechargeData();
            } else {
                notifications.showNotificationWarning("Ha ocurrido un error");
            }
            $('#btnConfirmExecute').prop('disabled', false);
        }
    });
}


function clearDoReserve() {
    $("#formDoReserve")[0].reset();
    $('#titleReserve').html("-----");
    $('#btnReserveDocument').prop('disabled', true);
}
</script>


</html>