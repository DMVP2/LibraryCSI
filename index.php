<?php


include_once('routes.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Bosque</title>
    <link type="text/css" href="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'bootstrap/css/bootstrap.min.css' ?>"
        rel="stylesheet">
    <link type="text/css"
        href="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'bootstrap/css/bootstrap-responsive.min.css' ?>"
        rel="stylesheet">
    <link type="text/css" href="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'css/theme.css' ?>" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
        rel='stylesheet'>
</head>

<body>

    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <i class="icon-reorder shaded"></i>
                </a>

                <a class="brand" href="index.html">
                    Book Bosque
                </a>

                <div class="nav-collapse collapse navbar-inverse-collapse">

                    <ul class="nav pull-right">

                        <li><a href="#">
                                Registrarse
                            </a></li>
                    </ul>
                </div><!-- /.nav-collapse -->
            </div>
        </div><!-- /navbar-inner -->
    </div><!-- /navbar -->


    <!--/.wrapper-->
    <div class="wrapper">
        <div class="container">
            <div style="background: url(a.jpg) no-repeat fixed center; ">
                <div class="container">
                    <div class="row" ">
                        <div class=" module module-login span4 offset4">
                        <form class="form-vertical" action="./presentation/template.php">
                            <div class="module-head">
                                <h3>Iniciar sesión</h3>
                            </div>
                            <div class="module-body">
                                <div class="control-group">
                                    <div class="controls row-fluid">
                                        <input class="span12" type="text" id="inputEmail" placeholder="Usuario">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls row-fluid">
                                        <input class="span12" type="password" id="inputPassword"
                                            placeholder="Contraseña">
                                    </div>
                                </div>
                            </div>
                            <div class="module-foot">
                                <div class="control-group">
                                    <div class="controls clearfix align-center">
                                        <button type="submit" class="btn btn-primary ">Iniciar
                                            sesión</button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <br>
            </div>
        </div>

        <br><br>
        <div class="align-center">
            <button class="btn btn-large">¿No te has registrado?<br>Registrate</button>
        </div>

        <br><br>

        <div class="btn-box-row row-fluid">
            <a href="#" class="btn-box big span4">
                <i class="fa fa-book"></i>
                <b>Libros</b>
            </a>
            <a href="#" class="btn-box big span4">
                <i class="fa fa-file-pdf-o"></i>
                <b>PDF</b>
            </a>
            <a href="#" class="btn-box big span4">
                <i class="fa fa-handshake-o"></i>
                <b>Reservas</b>
            </a>
        </div>
    </div>
    </div>
    <!--/.wrapper-->

    <!-- Footer -->
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_COMPONENTS . "footer.php";
    ?>
    <!-- Footer -->

    <script src="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'scripts/jquery-1.9.1.min.js' ?>" type="text/javascript">
    </script>
    <script src="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'scripts/jquery-ui-1.10.1.custom.min.js' ?>"
        type="text/javascript"></script>
    <script src="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'bootstrap/js/bootstrap.min.js' ?>" type="text/javascript">
    </script>
</body>