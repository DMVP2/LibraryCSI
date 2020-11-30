<?php

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_SESSION . 'UserSession.php');

$userSession = UserSession::getUserSession();
$userSession->verifySession();

$rol = $userSession->getRol();

if (strcasecmp($rol, 'Employee') == 0) {
    $color = 'yellow';
} elseif (strcasecmp($rol, 'Admin') == 0 or strcasecmp($rol, 'Owner') == 0) {
    $color = 'red';
}

$nameFile = basename($_SERVER['PHP_SELF'], '.php');

?>

<div class="sidebar" data-color="<?php echo $color ?>"
    data-image="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'img/sidebar-5.jpg' ?>">

    <!--
        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag
            -->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a class="simple-text">
                <img src="<?php echo ROOT_DIRECTORY . ROUTE_ASSETS . 'img/banWhite.png' ?>" width="50%">
            </a>
        </div>

        <ul class="nav">

            <?php if (strcasecmp($rol, 'employee') == 0) { ?>

            <li <?php echo strcasecmp($nameFile, 'indexemployee') == 0 ? "class='active'" : "" ?>>
                <a href="<?php echo ROOT_DIRECTORY . ROUTE_EMPLOYEE . 'indexEmployee.php' ?>">
                    <i class="fa fa-book"></i>
                    <p>Reservas</p>
                </a>
            </li>

            <li <?php echo strcasecmp($nameFile, 'registerClient') == 0 ? "class='active'" : "" ?>>
                <a href="<?php echo ROOT_DIRECTORY . ROUTE_EMPLOYEE . 'registerClient.php' ?>">
                    <i class="fa fa-user"></i>
                    <p>Registrar cliente</p>
                </a>
            </li>

            <?php } elseif (strcasecmp($rol, 'admin') == 0 or strcasecmp($rol, 'owner') == 0) { ?>

            <li <?php echo strcasecmp($nameFile, 'indexAdministrator') == 0 ? "class='active'" : "" ?>>
                <a href="<?php echo ROOT_DIRECTORY . ROUTE_ADMINISTRATOR . 'indexAdministrator.php' ?>">
                    <i class="fa fa-pie-chart"></i>
                    <p>Inicio</p>
                </a>
            </li>
            <li <?php echo strcasecmp($nameFile, 'employeeAdministrator') == 0 ? "class='active'" : "" ?>>
                <a href="<?php echo ROOT_DIRECTORY . ROUTE_ADMINISTRATOR . 'employeeAdministrator.php' ?>">
                    <i class="fa fa-briefcase"></i>
                    <p>Empleados</p>
                </a>
            </li>
            <li <?php echo strcasecmp($nameFile, 'publisherAdministrator') == 0 ? "class='active'" : "" ?>>
                <a href="<?php echo ROOT_DIRECTORY . ROUTE_ADMINISTRATOR . 'publisherAdministrator.php' ?>">
                    <i class="fa fa-pencil-square-o"></i>
                    <p>Publicadores</p>
                </a>
            </li>
            <li <?php echo strcasecmp($nameFile, 'clientAdministrator') == 0 ? "class='active'" : "" ?>>
                <a href="<?php echo ROOT_DIRECTORY . ROUTE_ADMINISTRATOR . 'clientAdministrator.php' ?>">
                    <i class=" fa fa-user"></i>
                    <p>Clientes</p>
                </a>
            </li>
            <?php if (strcasecmp($rol, 'owner') == 0) { ?>
            <li <?php echo strcasecmp($nameFile, 'adminAdministrator') == 0 ? "class='active'" : "" ?>>
                <a href="<?php echo ROOT_DIRECTORY . ROUTE_ADMINISTRATOR . 'adminAdministrator.php' ?>">
                    <i class=" fa fa-users"></i>
                    <p>Administradores</p>
                </a>
            </li>
            <?php } ?>
            <li <?php echo strcasecmp($nameFile, 'documentsAdministrator') == 0 ? "class='active'" : "" ?>>
                <a href="<?php echo ROOT_DIRECTORY . ROUTE_ADMINISTRATOR . 'documentsAdministrator.php' ?>">
                    <i class="fa fa-book"></i>
                    <p>Documentos</p>
                </a>
            </li>
            <li <?php echo strcasecmp($nameFile, 'a') == 0 ? "class='active'" : "" ?>>
                <a href="#">
                    <i class="fa fa-bar-chart"></i>
                    <p>Reportes</p>
                </a>
            </li>
            <li <?php echo strcasecmp($nameFile, 'auditAdministrator') == 0 ? "class='active'" : "" ?>>
                <a href="<?php echo ROOT_DIRECTORY . ROUTE_ADMINISTRATOR . 'auditAdministrator.php' ?>">
                    <i class="fa fa-eye"></i>
                    <p>Auditoria</p>
                </a>
            </li>



            <?php } else { ?>

            <li class=" active">
                <a href="dashboard.html">
                    <i class="pe-7s-graph"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="user.html">
                    <i class="pe-7s-user"></i>
                    <p>User Profile</p>
                </a>
            </li>
            <li>
                <a href="table.html">
                    <i class="pe-7s-note2"></i>
                    <p>Table List</p>
                </a>
            </li>
            <li>
                <a href="typography.html">
                    <i class="pe-7s-news-paper"></i>
                    <p>Typography</p>
                </a>
            </li>
            <li>
                <a href="icons.html">
                    <i class="pe-7s-science"></i>
                    <p>Icons</p>
                </a>
            </li>
            <li>
                <a href="maps.html">
                    <i class="pe-7s-map-marker"></i>
                    <p>Maps</p>
                </a>
            </li>
            <li>
                <a href="notifications.html">
                    <i class="pe-7s-bell"></i>
                    <p>Notifications</p>
                </a>
            </li>

            <?php } ?>

            <li class="active-pro">
                <a href="<?php echo ROOT_DIRECTORY . ROUTE_SESSION . 'closeSession.php' ?>">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                    <p>Salir</p>
                </a>
            </li>

        </ul>

    </div>
</div>