<?php

include_once('routes.php');

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

            <div class="content">
                <div class="container-fluid ">

                    <br><br><br>
                    <div class='row'>
                        <div class='col-md-offset-2 col-md-8'>
                            <div class="carousel slide" data-ride="carousel" id="quote-carousel">

                                <!-- Carousel Slides / Quotes -->
                                <div class="carousel-inner">
                                    <!-- Quote 1 -->
                                    <div class="item active">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card ">
                                                    <div class="card-header ">
                                                        <h4 class="card-title">Email Statistics</h4>
                                                        <p class="card-category">Last Campaign Performance</p>
                                                    </div>
                                                    <div class="card-body ">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card ">
                                                    <div class="card-header ">
                                                        <h4 class="card-title">Email Statistics</h4>
                                                        <p class="card-category">Last Campaign Performance</p>
                                                    </div>
                                                    <div class="card-body ">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card ">
                                                    <div class="card-header ">
                                                        <h4 class="card-title">Email Statistics</h4>
                                                        <p class="card-category">Last Campaign Performance</p>
                                                    </div>
                                                    <div class="card-body ">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Quote 2 -->
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card ">
                                                    <div class="card-header ">
                                                        <h4 class="card-title">Email Statistics</h4>
                                                        <p class="card-category">Last Campaign Performance</p>
                                                    </div>
                                                    <div class="card-body ">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card ">
                                                    <div class="card-header ">
                                                        <h4 class="card-title">Email Statistics</h4>
                                                        <p class="card-category">Last Campaign Performance</p>
                                                    </div>
                                                    <div class="card-body ">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card ">
                                                    <div class="card-header ">
                                                        <h4 class="card-title">Email Statistics</h4>
                                                        <p class="card-category">Last Campaign Performance</p>
                                                    </div>
                                                    <div class="card-body ">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Quote 3 -->
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card ">
                                                    <div class="card-header ">
                                                        <h4 class="card-title">Email Statistics</h4>
                                                        <p class="card-category">Last Campaign Performance</p>
                                                    </div>
                                                    <div class="card-body ">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card ">
                                                    <div class="card-header ">
                                                        <h4 class="card-title">Email Statistics</h4>
                                                        <p class="card-category">Last Campaign Performance</p>
                                                    </div>
                                                    <div class="card-body ">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card ">
                                                    <div class="card-header ">
                                                        <h4 class="card-title">Email Statistics</h4>
                                                        <p class="card-category">Last Campaign Performance</p>
                                                    </div>
                                                    <div class="card-body ">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Carousel Buttons Next/Prev -->
                                <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i
                                        class="fa fa-chevron-left"></i></a>
                                <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i
                                        class="fa fa-chevron-right"></i></a>
                            </div>
                        </div>



                    </div>

                    <!-- Secon carrousel -->

                    <br><br><br>
                    <div class='row'>
                        <div class='col-md-offset-2 col-md-8'>
                            <div class="carousel slide" data-ride="carousel" id="quote-carousel1">

                                <!-- Carousel Slides / Quotes -->
                                <div class="carousel-inner">
                                    <!-- Quote 1 -->
                                    <div class="item active">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card ">
                                                    <div class="card-header ">
                                                        <h4 class="card-title">Email Statistics</h4>
                                                        <p class="card-category">Last Campaign Performance</p>
                                                    </div>
                                                    <div class="card-body ">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card ">
                                                    <div class="card-header ">
                                                        <h4 class="card-title">Email Statistics</h4>
                                                        <p class="card-category">Last Campaign Performance</p>
                                                    </div>
                                                    <div class="card-body ">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card ">
                                                    <div class="card-header ">
                                                        <h4 class="card-title">Email Statistics</h4>
                                                        <p class="card-category">Last Campaign Performance</p>
                                                    </div>
                                                    <div class="card-body ">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Quote 2 -->
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card ">
                                                    <div class="card-header ">
                                                        <h4 class="card-title">Email Statistics</h4>
                                                        <p class="card-category">Last Campaign Performance</p>
                                                    </div>
                                                    <div class="card-body ">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card ">
                                                    <div class="card-header ">
                                                        <h4 class="card-title">Email Statistics</h4>
                                                        <p class="card-category">Last Campaign Performance</p>
                                                    </div>
                                                    <div class="card-body ">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card ">
                                                    <div class="card-header ">
                                                        <h4 class="card-title">Email Statistics</h4>
                                                        <p class="card-category">Last Campaign Performance</p>
                                                    </div>
                                                    <div class="card-body ">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Quote 3 -->
                                    <div class="item">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card ">
                                                    <div class="card-header ">
                                                        <h4 class="card-title">Email Statistics</h4>
                                                        <p class="card-category">Last Campaign Performance</p>
                                                    </div>
                                                    <div class="card-body ">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card ">
                                                    <div class="card-header ">
                                                        <h4 class="card-title">Email Statistics</h4>
                                                        <p class="card-category">Last Campaign Performance</p>
                                                    </div>
                                                    <div class="card-body ">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card ">
                                                    <div class="card-header ">
                                                        <h4 class="card-title">Email Statistics</h4>
                                                        <p class="card-category">Last Campaign Performance</p>
                                                    </div>
                                                    <div class="card-body ">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Carousel Buttons Next/Prev -->
                                <a data-slide="prev" href="#quote-carousel1" class="left carousel-control"><i
                                        class="fa fa-chevron-left"></i></a>
                                <a data-slide="next" href="#quote-carousel1" class="right carousel-control"><i
                                        class="fa fa-chevron-right"></i></a>
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

    <!-- ModalRegister -->
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_FIELDS . "ModalRegister.php";
    ?>
    <!-- ModalRegister -->


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