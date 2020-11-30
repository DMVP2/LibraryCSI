<?php

//error_reporting(0);
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


                    <br>
                    <div class="row centerLarge">
                        <div class="col-md-12 ">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Administradores</h4>
                                    <button data-toggle='modal' data-target='#exampleModalCenter'
                                        class="btn btn-red btn-fill pull-right" style="margin-bottom: 40px;">
                                        <i type='span' class='fa fa-user' style='color: white'></i> Agregar
                                        administrador
                                    </button>
                                </div>
                                <div class="content table-responsive table-full-width">

                                    <div id="divTable"></div>



                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>




        </div>
    </div>

    <!-- Modal admin-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="margin-top:20%">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar administrador</h5>
                </div>
                <div class="modal-body">
                    <div class="content">
                        <form id="formAdmin">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipo de documento</label>
                                        <select name="typeDocument" id="typeDocument" class="form-control">
                                            <option value="C.C.">C.C.</option>
                                            <option value="C.E.">C.E.</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Número de documento</label>
                                        <input type="number" class="form-control" id="numberDocument"
                                            name="numberDocument" placeholder="Número de documento" required>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombres</label>
                                        <input type="text" class="form-control" placeholder="Nombres" id="name"
                                            name="name" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Apellidos</label>
                                        <input type="text" class="form-control" placeholder="Apellidos" id="lastName"
                                            name="lastName" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Correo</label>
                                        <input type="text" class="form-control" placeholder="Correo" id="mail"
                                            name="mail"
                                            pattern="^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Celular</label>
                                        <input type="number" class="form-control" placeholder="Celular" id="phone"
                                            name="phone" required>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-red btn-fill" id="btnSubmit">Agregar
                                        administrador</button>
                                </div>
                            </div>

                            <div class=" clearfix">
                            </div>
                            <br>

                        </form>
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
    $.fn.rechargeData = function() {
        $('#divTable').load(
            "<?php echo ROOT_DIRECTORY . ROUTE_FIELDS . "Administrator/tableAdministrators.php" ?>");
    }

    $.fn.rechargeData();

    $('#formAdmin').submit(function(e) {
        $('#btnSubmit').prop('disabled', true);
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '<?php echo ROOT_DIRECTORY . ROUTE_PROCEDURES . "administrator/registerAdministrator.php"  ?>',
            data: $(this).serialize(),
            success: function(response) {
                var jsonData = JSON.parse(response);

                if (jsonData.success == "1") {
                    $("#formAdmin")[0].reset();
                    $("#exampleModalCenter").modal('hide');
                    $.fn.rechargeData();
                    notifications.showNotificationInfo("Se ha registrado con éxito");

                } else {
                    notifications.showNotificationWarning("Ha ocurrido un error");
                }
                $('#btnSubmit').prop('disabled', false);
            }
        });
    });
});

function executeAction(pAction, pIdUser) {

    $.ajax({
        type: "POST",
        url: '<?php echo ROOT_DIRECTORY . ROUTE_PROCEDURES . "Administrator/actionUser.php"  ?>',
        data: 'action=' + pAction + '&idUser=' + pIdUser,
        success: function(response) {
            var jsonData = JSON.parse(response);

            if (jsonData.success == "1") {
                notifications.showNotificationInfo("Se ha realizado la operación con éxito");
                $.fn.rechargeData();
            } else {
                notifications.showNotificationWarning("Ha ocurrido un error");
            }
        }
    });
}
</script>


</html>