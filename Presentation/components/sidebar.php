<?php

$rol = 'employee';
$nameFile = basename($_SERVER['PHP_SELF'], '.php');



if (strcasecmp($rol, 'employee') == 0) {
    $color = 'yellow';
}

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

            <li <?php echo strcasecmp($nameFile, 'registeruser') == 0 ? "class='active'" : "" ?>>
                <a href="<?php echo ROOT_DIRECTORY . ROUTE_EMPLOYEE . 'registerUser.php' ?>">
                    <i class="fa fa-user"></i>
                    <p>Registrar cliente</p>
                </a>
            </li>

            <?php } else { ?>

            <li class="active">
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
                <a href="">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                    <p>Salir</p>
                </a>
            </li>

        </ul>

    </div>
</div>