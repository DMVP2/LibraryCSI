<?php


include_once('routes.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edmin</title>
    <link type="text/css" href="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'bootstrap/css/bootstrap.min.css' ?>"
        rel="stylesheet">
    <link type="text/css"
        href="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'bootstrap/css/bootstrap-responsive.min.css' ?>"
        rel="stylesheet">
    <link type="text/css" href="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'css/theme.css' ?>" rel="stylesheet">
    <link type="text/css" href="<?php echo ROOT_DIRECTORY . ROUTE_IMAGES . 'icons/css/font-awesome.css' ?>"
        rel="stylesheet">
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
                    Edmin
                </a>

                <div class="nav-collapse collapse navbar-inverse-collapse">

                    <ul class="nav pull-right">

                        <li><a href="#">
                                Sign Up
                            </a></li>



                        <li><a href="#">
                                Forgot your password?
                            </a></li>
                    </ul>
                </div><!-- /.nav-collapse -->
            </div>
        </div><!-- /navbar-inner -->
    </div><!-- /navbar -->


    <!--/.wrapper-->
    <div class="wrapper">
        <div class="container">
            <img class="img" width="" src="a.jpg" />

            <br><br>
            <div class="align-center">
                <button class="btn btn-large">Iniciar</button>
                <button class="btn btn-large">Registrar</button>
            </div>

            <br><br>

            <div class="btn-box-row row-fluid">
                <a href="#" class="btn-box big span4">
                    <i class="icon-adjust"></i>
                    <b>Bigger</b>
                </a>
                <a href="#" class="btn-box big span4">
                    <i class="icon-briefcase"></i>
                    <b>Bigger</b>
                </a>
                <a href="#" class="btn-box big span4">
                    <i class="icon-gift"></i>
                    <b>Bigger</b>
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