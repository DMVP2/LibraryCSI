<?php

include_once('../routes.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Name library</title>
        <link type="text/css" href="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'bootstrap/css/bootstrap.min.css' ?>"
            rel="stylesheet">
        <link type="text/css"
            href="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'bootstrap/css/bootstrap-responsive.min.css' ?>"
            rel="stylesheet">
        <link type="text/css" href="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'css/theme.css' ?>" rel="stylesheet">

        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>


    </head>

<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <i class="icon-reorder shaded"></i></a><a class="brand" href="index.html">Name library </a>
                <div class="nav-collapse collapse navbar-inverse-collapse">

                    <ul class="nav pull-right">
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Mi cuenta
                                <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Your Profile</a></li>
                                <li><a href="#">Edit Profile</a></li>
                                <li><a href="#">Account Settings</a></li>
                                <li class="divider"></li>
                                <li><a href="../index.php">Logout</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <!-- /.nav-collapse -->
            </div>
        </div>
        <!-- /navbar-inner -->
    </div>
    <!-- /navbar -->
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="span3">
                    <div class="sidebar">
                        <ul class="widget widget-menu unstyled">
                            <li class="active"><a href="index.html"><i class="menu-icon icon-dashboard"></i>Dashboard
                                </a></li>
                            <li><a href="activity.html"><i class="menu-icon icon-bullhorn"></i>News Feed </a>
                            </li>
                            <li><a href="message.html"><i class="menu-icon icon-inbox"></i>Inbox </a></li>
                            <li><a href="task.html"><i class="menu-icon icon-tasks"></i>Tasks </a></li>
                        </ul>
                        <!--/.widget-nav-->


                        <ul class="widget widget-menu unstyled">
                            <li><a href="ui-button-icon.html"><i class="menu-icon icon-bold"></i> Buttons </a></li>
                            <li><a href="ui-typography.html"><i class="menu-icon icon-book"></i>Typography </a></li>
                            <li><a href="form.html"><i class="menu-icon icon-paste"></i>Forms </a></li>
                            <li><a href="table.html"><i class="menu-icon icon-table"></i>Tables </a></li>
                            <li><a href="charts.html"><i class="menu-icon icon-bar-chart"></i>Charts </a></li>
                        </ul>

                    </div>
                    <!--/.sidebar-->
                </div>
                <!--/.span3-->
                <div class="span9">
                    <div class="content">
                        <!--/#btn-controls-->


                        <!--/.module-->
                    </div>
                    <!--/.content-->
                </div>
                <!--/.span9-->
            </div>
        </div>


        <!--/.container-->
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
    <script src="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'scripts/flot/jquery.flot.js' ?>" type="text/javascript">
    </script>
    <script src="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'scripts/flot/jquery.flot.resize.js' ?>"
        type="text/javascript"></script>
    <script src="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'scripts/datatables/jquery.dataTables.js' ?>"
        type="text/javascript"></script>
    <script src="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'scripts/common.js' ?>" type="text/javascript"></script>

</body>