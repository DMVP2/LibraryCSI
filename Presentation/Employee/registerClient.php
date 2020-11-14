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
                    <br><br><br>
                    <div class="row ">
                        <div class="col-md-8 col-md-offset-2 ">
                            <div class="card">
                                <div class="header margin-top-2">
                                    <h4 class="title">Nuevo cliente</h4>
                                </div>
                                <div class="content">
                                    <form id="formClient"
                                        action="<?php echo ROOT_DIRECTORY . ROUTE_PROCEDURES . "employee/registerClient.php"  ?>">
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
                                                    <input type="text" class="form-control" id="numberDocument"
                                                        name="numberDocument" placeholder="Número de documento">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nombres</label>
                                                    <input type="text" class="form-control" placeholder="Nombres"
                                                        id="name" name="name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Apellidos</label>
                                                    <input type="text" class="form-control" placeholder="Apellidos"
                                                        id="lastName" name="lastName">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Correo</label>
                                                    <input type="text" class="form-control" placeholder="Correo"
                                                        id="mail" name="mail">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Celular</label>
                                                    <input type="text" class="form-control" placeholder="Celular"
                                                        id="phone" name="phone">
                                                </div>
                                            </div>
                                        </div>

                                        <br>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button type="submit" class="btn btn-employee btn-fill">Registrar
                                                    cliente</button>
                                            </div>
                                        </div>

                                        <div class=" clearfix">
                                        </div>
                                        <br>

                                    </form>



                                    <div class="clearfix"></div>

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


<script type="text/javascript">
$(document).ready(function() {
    $('#formClient').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '<?php echo ROOT_DIRECTORY . ROUTE_PROCEDURES . "employee/registerClient.php"  ?>',
            data: $(this).serialize(),
            success: function(response) {
                var jsonData = JSON.parse(response);

                console.log(jsonData.success);

                if (jsonData.success == "1") {
                    $("#formClient")[0].reset();
                    notifications.showNotificationInfo("Se ha registrado con exito");

                } else {
                    notifications.showNotificationWarning("Ha ocurrido un error");
                }
            }
        });
    });
});
</script>

</html>