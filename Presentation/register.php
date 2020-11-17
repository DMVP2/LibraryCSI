<?php

include_once('../routes.php');

$typeUser = $_GET['u'];

if ($typeUser == 1) {
    $nameUser = " estandar";
    $typeBtn = "primary";
} else {
    $nameUser = " publicador";
    $typeBtn = "danger";
}


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
                    <div class="row center-block">
                        <div class="col-xs-offset-3 col-xs-7">
                            <div class="card ">
                                <div class="header ">
                                    <center>
                                        <br>
                                        <h3 class="title">Registro <?php echo $nameUser ?></h3>
                                    </center>
                                </div>
                                <div class="content col-xs-offset-1 col-xs-postset-1">
                                    <form id="formRegister">
                                        <?php if ($typeUser == 1) { ?>
                                        <div class="row ">

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Tipo de documento</label>
                                                    <select name="typeDocument" id="typeDocument" class="form-control">
                                                        <option value="C.C.">C.C.</option>
                                                        <option value="C.E.">C.E.</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Número de documento</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Número de documento" id="numberDocument"
                                                        name="numberDocument">
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Correo</label>
                                                    <input type="text" class="form-control" placeholder="Correo"
                                                        id="mail" name="mail">
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
                                                    <label>Celular</label>
                                                    <input type="text" class="form-control" placeholder="Celular"
                                                        id="phone" name="phone">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Contraseña</label>
                                                    <input type="password" class="form-control" placeholder="Contraseña"
                                                        id="password1" name="password1">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Confirmar contraseña</label>
                                                    <input type="password" class="form-control"
                                                        placeholder="Confirmar contraseña" name="password2"
                                                        id="password2">
                                                </div>
                                            </div>
                                        </div>

                                        <?php } else { ?>

                                        aaaa

                                        <?php }  ?>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <?php echo "<button type='submit' style='width: 25%;'
                                                    class='btn btn-" . $typeBtn . " btn-pull' id='btnSubmit'>Registrarme</button>"  ?>
                                                <br>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-12 text-center">
                                                <br>
                                                <a href="<?php echo ROOT_DIRECTORY . '/index.php' ?>"
                                                    class="title text-info">Regresar</a>
                                                <br><br>
                                            </div>
                                        </div>
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

<script type="text/javascript">
$(document).ready(function() {
    $('#formRegister').submit(function(e) {
        $('#btnSubmit').prop('disabled', true);
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '<?php echo ROOT_DIRECTORY . ROUTE_PROCEDURES . "registerUser.php" ?>',
            data: $(this).serialize(),
            success: function(response) {
                var jsonData = JSON.parse(response);

                console.log(jsonData);

                console.log(jsonData.success);

                if (jsonData.success == "1") {
                    $("#formRegister")[0].reset();
                    notifications.showNotificationInfo("Se ha registrado con exito");

                } else {
                    notifications.showNotificationWarning("Ha ocurrido un error");
                }
                $('#btnSubmit').prop('disabled', false);
            }
        });
    });
});
</script>

</html>