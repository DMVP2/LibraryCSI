<nav class="navbar navbar-default navbar-fixed">
    <div class="container-fluid">

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
                    <a href="<?php echo ROOT_DIRECTORY . ROUTE_PRESENTATION . 'register.php' ?>">
                        Registrarme
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>