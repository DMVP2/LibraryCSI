<?php

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_SESSION . 'UserSession.php');

$userSession = UserSession::getUserSession();

$rol = $userSession->getRol();

?>
<nav class="navbar navbar-default navbar-fixed">
    <div class="container-fluid">

        <?php if (strcasecmp($rol, 'client') == 0) { ?>

        <!-- CLIENTE -->
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a href="<?php echo ROOT_DIRECTORY . '/index.php' ?>" style="font-size: 25px; color: #000000;">
                        <?php echo NAME_PROJECT ?>
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?php echo ROOT_DIRECTORY . ROUTE_CLIENT . 'MyProfile.php' ?>">
                        Mi perfil
                    </a>
                </li>
                <li>
                    <a href="<?php echo ROOT_DIRECTORY . ROUTE_CLIENT . 'MyBookings.php' ?>">
                        Mis reservas
                    </a>
                </li>
                <li>
                    <a href="<?php echo ROOT_DIRECTORY . ROUTE_SESSION . 'closeSession.php' ?>">
                        Cerrar sesión
                    </a>
                </li>
            </ul>
        </div>

        <?php } else { ?>

        <!-- NO LOGUEADO -->

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a href="<?php echo ROOT_DIRECTORY . '/index.php' ?>" style="font-size: 25px; color: #000000;">
                        <?php echo NAME_PROJECT ?>
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?php echo ROOT_DIRECTORY . ROUTE_PRESENTATION . 'login.php' ?>">
                        Iniciar sesión
                    </a>
                </li>
                <li>
                    <a href="#" data-toggle="modal" data-target="#myModal1">
                        Registrarme
                    </a>
                </li>
            </ul>
        </div>
        <?php  } ?>

    </div>
</nav>