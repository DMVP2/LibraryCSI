<?php

include_once('../routes.php');

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

        <div class="main-panel" data="index">

            <!-- Navbar -->
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_COMPONENTS . "navbar.php";
            ?>
            <!-- Navbar -->

            <div class="content background-image-login"
                style=" background-image: url('<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . "img/bannerLogin.jpg";  ?>');">
                <div class="container-fluid ">

                    <br><br><br>
                    <div class="row center-block">
                        <div class="col-xs-offset-4 col-xs-4">
                            <div class="card">
                                <br>
                                <div class="header">
                                    <center>
                                        <h3 class="title">Iniciar sesión</h3>
                                    </center>
                                </div>
                                <div class="content">
                                    <br>
                                    <form action="<?php echo ROOT_DIRECTORY . ROUTE_EMPLOYEE . 'indexEmployee.php' ?>">
                                        <div class="row">
                                            <div class="col-md-offset-2 col-xs-8">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label>Usuario</label>
                                                        <input type="text" class="form-control" placeholder="Usuario">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-offset-2 col-xs-8">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label>Contraseña</label>
                                                        <input type="password" class="form-control"
                                                            placeholder="Contraseña">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row ">
                                            <div class="text-center">
                                                <a href="" class="title">¿Olvidaste tu contraseña?</a>
                                            </div>
                                        </div>

                                        <br><br>

                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button class="btn btn-default  btn-wd ">Iniciar sesión</button>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="row ">
                                            <div class="text-center">
                                                <a href="<?php echo ROOT_DIRECTORY . '/index.php' ?>"
                                                    class="title">Regresar</a>
                                            </div>
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
        </div>


        <!-- Footer -->
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_COMPONENTS . "footer.php";
        ?>
        <!-- Footer -->

    </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Reservar documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-employee btn-fill">Hacer reserva</button>
                    <button type="button" class="btn btn-primary btn-fill" data-dismiss="modal">Cerrar</button>

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


</html>