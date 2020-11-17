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

        <div class="main-panel" data="index" style="height: 100%;">

            <div class="content background-image-login"
                style=" background-image: url('<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . "img/bannerLogin.jpg";  ?>');">
                <div class="container-fluid ">

                    <br><br><br><br><br><br>
                    <div class="row center-block">
                        <div class="col-xs-offset-4 col-xs-4">
                            <div class="card">
                                <br>
                                <div class="header">
                                    <center>
                                        <h3 class="title">Cambio de contraseña</h3>
                                    </center>
                                </div>
                                <div class="content">
                                    <br>
                                    <form method="POST"
                                        action="<?php echo ROOT_DIRECTORY . ROUTE_PROCEDURES . 'changePassword.php' ?>">
                                        <div class="row">
                                            <div class="col-md-offset-2 col-xs-8">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label>Contraseña</label>
                                                        <input type="password" class="form-control"
                                                            placeholder="Contraseña" id="pass1" name="pass1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-offset-2 col-xs-8">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label>Confirmar contraseña</label>
                                                        <input type="password" class="form-control"
                                                            placeholder="Confirmar contraseña" id="pass2" name="pass2">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br>
                                        <div class="row">
                                            <div class="col-md-offset-2 col-xs-8">
                                                <div class="registrationFormAlert text-center" id="CheckPasswordMatch">
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button id="btnChange" class="btn btn-primary btn-wd" disabled>Cambiar
                                                    contraseña</button>
                                            </div>
                                        </div>


                                        <br><br>

                                    </form>

                                    <div class="clearfix"></div>

                                </div>
                            </div>
                        </div>
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

<script>
function validatePasswordMatch() {

    var pass1 = $("#pass1").val();
    var pass2 = $("#pass2").val();

    if (pass1 == "" || pass2 == "") {
        $("#CheckPasswordMatch").css('color', 'red');
        $("#CheckPasswordMatch").html("Complete los campos.");
        $('#btnChange').prop('disabled', true);

    } else {
        if (pass1 != pass2) {
            $("#CheckPasswordMatch").css('color', 'red');
            $("#CheckPasswordMatch").html("Las contraseñas no coinciden.");
            $('#btnChange').prop('disabled', true);
        } else {
            $("#CheckPasswordMatch").css('color', 'green');
            $("#CheckPasswordMatch").html("Las contraseñas coinciden.");
            $('#btnChange').prop('disabled', false);
        }
    }

}
$(document).ready(function() {
    $("#pass1").keyup(validatePasswordMatch);
    $("#pass2").keyup(validatePasswordMatch);
});
</script>

</html>