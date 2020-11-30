<?php

//error_reporting(0);
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1

include_once('../../routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_SESSION . 'UserSession.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'UserDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'User.php');

$c = Connection::getInstance();
$connection = $c->connectBD();

$userDriving = new UserDriving($connection);

$userSession = UserSession::getUserSession();
$userSession->verifySession();

$us = $userSession->getCurrentUser();

$usSesion = $userDriving->searchUserById($us->getUserId());


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

    <div class="wrapper" style="height: 100%;">

        <div class="main-panel" style="width: 100%; height: 100%; ">

            <!-- Navbar -->
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_COMPONENTS . "navbar.php";
            ?>
            <!-- Navbar -->

            <div class="content" style="padding-top: 110px;">
                <div class="container-fluid ">
                    <div class="row center-block">
                        <div class="col-xs-offset-2 col-xs-8">
                            <div class="card ">
                                <div class="header">
                                    <h4 class="title" style="margin-left: 80px;margin-top: 10px;">Mi perfil</h4>
                                </div>
                                <div class="content col-xs-offset-1 col-xs-postset-1">
                                    <form id="formProfile">
                                        <div class="row ">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Documento</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Número de documento" id="numberDocument"
                                                        name="numberDocument"
                                                        value="<?php echo $usSesion->getTypeDocument() . "    " . $usSesion->getUserId() ?>"
                                                        disabled>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nombres</label>
                                                    <input type="text" class="form-control" placeholder="Nombres"
                                                        id="name" name="name"
                                                        value="<?php echo $usSesion->getName()  ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Apellidos</label>
                                                    <input type="text" class="form-control" placeholder="Apellidos"
                                                        id="lastName" name="lastName"
                                                        value="<?php echo $usSesion->getLastName() ?>">
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Celular</label>
                                                    <input type="text" class="form-control" placeholder="Celular"
                                                        id="phone" name="phone"
                                                        value="<?php echo $usSesion->getPhone() ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Correo</label>
                                                    <input type="text" class="form-control" placeholder="Correo"
                                                        id="mail" name="mail"
                                                        value="<?php echo $usSesion->getMail() ?>">
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nueva contraseña</label>
                                                    <input type="password" class="form-control"
                                                        placeholder="Nueva contraseña" id="password1" name="password1">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Confirmar contraseña</label>
                                                    <input type="password" class="form-control"
                                                        placeholder="Confirmar contraseña" name="password2"
                                                        id="password2">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Contraseña actual</label>
                                                    <input type="password" class="form-control"
                                                        placeholder="Contraseña actual" id="actualPassword"
                                                        name="actualPassword" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <div class="registrationFormAlert text-center" id="CheckPasswordMatch">
                                                </div>
                                            </div>
                                        </div>


                                        <br><br>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <?php echo "<button type='submit' style='width: 25%;'
                                                    class='btn btn-info btn-pull' id='btnSubmit'>Actualizar</button>"  ?>
                                                <br>
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
            <br><br><br><br>

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

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'js/demo.js' ?>"></script>

<!-- DataTables -->
<script type="text/javascript"
    src="<?php echo ROOT_DIRECTORY . ROUTE_PRESENTATION_LIB . "DataTables/datatables.min.js" ?>"></script>

<script type="text/javascript">
$(document).ready(function() {

    $('#formProfile').submit(function(e) {
        $('#btnSubmit').prop('disabled', true);
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '<?php echo ROOT_DIRECTORY . ROUTE_PROCEDURES . "client/updateProfile.php"  ?>',
            data: $(this).serialize(),
            success: function(response) {
                var jsonData = JSON.parse(response);

                if (jsonData.success == "1") {
                    window.location.href =
                        "<?php echo ROOT_DIRECTORY . ROUTE_CLIENT . 'MyProfile.php?code=1' ?>";
                } else {
                    notifications.showNotificationWarning("Contraseña errónea");
                }
                $('#btnSubmit').prop('disabled', false);
            }
        });
    });
});

function validatePasswordMatch() {

    var pass1 = $("#password1").val();
    var pass2 = $("#password2").val();

    if (pass1 != "" || pass2 != "") {

        if (pass1 != pass2) {
            $("#CheckPasswordMatch").css('color', 'red');
            $("#CheckPasswordMatch").html("Las contraseñas no coinciden.");
            $('#btnSubmit').prop('disabled', true);
        } else {
            $("#CheckPasswordMatch").css('color', 'green');
            $("#CheckPasswordMatch").html("Las contraseñas coinciden.");
            $('#btnSubmit').prop('disabled', false);
        }
    } else {
        $("#CheckPasswordMatch").html("");
        $('#btnSubmit').prop('disabled', false);
    }

}

$(document).ready(function() {
    $("#password1").keyup(validatePasswordMatch);
    $("#password2").keyup(validatePasswordMatch);
});

<?php echo (isset($_GET['code']) and $_GET['code'] == 1) ? "notifications.showNotificationInfo('Se han aztualizado los datos con éxito');" : "" ?>
</script>

</html>