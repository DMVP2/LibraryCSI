<?php

include_once('../../../routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'UserDriving.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'DocumentDriving.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Document.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'User.php');


$c = Connection::getInstance();
$connection = $c->connectBD();

$userDriving = new UserDriving($connection);
$documentDriving = new DocumentDriving($connection);
$ciudades = $documentDriving->getCitys();
$autores = $documentDriving->getAuthors();


$typeDoc = $_GET['u'];

if ($typeDoc == 1) {
    $tipoDocumento = " Físico";
    $typeBtn = "primary";
    $classDiv = "col-xs-offset-1 col-xs-10";
} else {
    $tipoDocumento = " PDF";
    $typeBtn = "success";
    $classDiv = "col-xs-offset-1 col-xs-10";
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
    <link href="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'css/light-bootstrap-dashboard.css?v=1.4.0' ?>" rel="stylesheet" />

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

            <div class="content background-image-login" style=" background-image: url('<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . "img/bannerLogin.jpg";  ?>  ');padding-top: 102px;"">
                <div class=" container-fluid ">
                    <div class=" row center-block">
                <div class="<?php echo $classDiv ?>">
                    <div class="card ">
                        <div class="header ">
                            <center>
                                <br>
                                <h3 class="title">Subir Documento <?php echo $tipoDocumento ?></h3>
                            </center>
                        </div>
                        <div class="content col-xs-offset-1 col-xs-postset-1">
                            <form id="formUpDocument">
                                <?php if ($typeDoc == 1 || 2) { ?>
                                    <div class="row ">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Título del Documento <?php echo $tipoDocumento ?></label>
                                                <input type="text" class="form-control" placeholder="Título" id="title" name="title"  required>

                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label> <?php if ($typeDoc == 1) {
                                                            echo ('ISBN: ');
                                                        } else {
                                                            echo ('DOI: ');
                                                        } ?></label>
                                                <input type="text" class="form-control" placeholder="Identificador" id="code" name="code" required>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Fecha Publicación</label><br>
                                                <input style="background-color: #ffffff;border: 1px solid #e3e3e3;border-radius: 4px;color: #565656;padding: 8px 12px;height: 40px; -webkit-box-shadow: none;box-shadow: none;" type="date" id="date" name="date" step="1" max="<?php echo date("Y-m-d"); ?>" required>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Editorial</label>
                                                <input type="text" class="form-control" placeholder="Casa Editorial" id="editorial" name="editorial"  required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Lenguaje</label>
                                                <input type="text" class="form-control" placeholder="Lengüa del Documento" id="lenguage" name="lenguage"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Número de Páginas</label>
                                                <input type="number" class="form-control" placeholder="No. Pag" id="num_pages" name="num_pages" required>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Categoría</label>
                                                <select name="category" id="category" class="form-control">
                                                    <option value="" selected style="color:gray">Seleccione una...</option>
                                                    <option value="Niños">Niños</option>
                                                    <option value="Adultos">Adultos</option>
                                                    <option value="Adultos">Jóvenes</option>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if ($typeDoc == 1) { ?>

                                            <div class="col-md-6">
                                                <input type="text" hidden id="type" name="type" value='Fisico' />

                                                <div class="form-group">
                                                    <label>Imagen de Portada</label>
                                                    <input type="file" class="form-control" placeholder="Portada" id="image" name="image" style="background-color: #ffffff;border: 1px solid #e3e3e3;border-radius: 4px;color: #565656;padding: 8px 12px;height: 40px; -webkit-box-shadow: none;box-shadow: none;" required>
                                                </div>
                                            </div>
                                        <?php   } else { ?>
                                            <div class="col-md-3">

                                                <input type="text" hidden id="type" name="type"  value='Digital' />

                                                <div class="form-group">
                                                    <label>Imagen de Portada</label>
                                                    <input type="file" class="form-control" placeholder="Portada" id="image" name="image" style="background-color: #ffffff;border: 1px solid #e3e3e3;border-radius: 4px;color: #565656;padding: 8px 12px;height: 40px; -webkit-box-shadow: none;box-shadow: none;" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">


                                                <div class="form-group">
                                                    <label>Archivo en PDF</label>
                                                    <input type="file" class="form-control" placeholder="Documento PDF" id="" name="pdf" style="background-color: #ffffff;border: 1px solid #e3e3e3;border-radius: 4px;color: #565656;padding: 8px 12px;height: 40px; -webkit-box-shadow: none;box-shadow: none;" required>
                                                </div>
                                            </div>
                                        <?php  } ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Seleccione la ciudad de publicación</label>
                                                <select name="city_id" id="city_id" class="form-control">
                                                    <option value="" selected style="color:gray">Seleccione una...</option>
                                                    <?php
                                                    $cantidadCiudades = count($ciudades);
                                                    if ($cantidadCiudades > 1) {
                                                        echo '<b>Autores: </b><br><ul>';
                                                        foreach ($ciudades as &$name) {
                                                            echo '<option value=' . $name[0] . ' >' . $name[1]  . '</option>';
                                                        }
                                                        echo '</ul>';
                                                    } else {
                                                        echo '';
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Seleccione él o los Autores</label>
                                                <select multiple name="author_id" id="author_id" class="form-control">
                                                    <option value="" selected style="color:gray">Seleccione una...</option>
                                                    <?php
                                                    $cantidadAutores = count($autores);
                                                    if ($cantidadAutores > 1) {
                                                        echo '<b>Autores: </b><br><ul>';
                                                        foreach ($autores as &$name) {
                                                            echo '<option value=' . $name[0] . ' >' . $name[1]  . '</option>';
                                                        }
                                                        echo '</ul>';
                                                    } else {
                                                        echo '';
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <label>Descripción del Documento - 350 Caracteres</label>
                                                <textarea name="description" id="description" placeholder="Realiza una descripción de libro o documento que deseas subir." class="form-control" minlength="20" maxlength="350" rows="5" cols="70" style="background-color: #ffffff;border: 1px solid #e3e3e3;border-radius: 4px;color: #565656;padding: 8px 12px; -webkit-box-shadow: none;box-shadow: none;" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else {
                                }  ?>
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
                                        <a href="<?php echo ROOT_DIRECTORY . '/index.php' ?>" class="title text-info">Regresar</a>
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
    <!-- MyModalSubirDoc -->
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_FIELDS . "MyModalSubirDoc.php";
    ?>
    <!-- MyModalSubirDoc -->

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
        $('#formUpDocument').submit(function(e) {
            $('#btnSubmit').prop('disabled', true);
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: '<?php echo ROOT_DIRECTORY . ROUTE_PROCEDURES . "Client/registerDocument.php" ?>',
                data: $(this).serialize(),
                success: function(response) {
                    var jsonData = JSON.parse(response);

                    if (jsonData.success == "1") {
                        $("#formUpDocument")[0].reset();
                        notifications.showNotificationInfo("Se ha registrado con éxito");

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