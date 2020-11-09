<?php

include_once('../routes.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

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

        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>


    </head>

<body>

    <!-- Navbar -->
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_COMPONENTS . "navbar.php";
    ?>
    <!-- Nabvar -->


    <!-- Sidebar -->
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_COMPONENTS . "sidebar.php";
    ?>
    <!-- Sidebar -->

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