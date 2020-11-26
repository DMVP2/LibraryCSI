<?php

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_SESSION . 'UserSession.php');

$userSession = UserSession::getUserSession();

$rol = $userSession->getRol();

?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid" id="topNavBar">

        <?php if (strcasecmp($rol, 'client') == 0) { ?>

        <!-- CLIENTE -->
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left" style="font-size:21px;color:gray;margin:1%">
                <li>
                    <a href="<?php echo ROOT_DIRECTORY . '/index.php' ?>" >
                        <div style="font-size:21px;color:gray"> <?php echo NAME_PROJECT; echo" "; ?> <i type='span' class='fa fa-book' aria-hidden='true' style="font-size:21px;color:gray"></i></div>
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right" style="font-size:19px;color:gray;margin:1%">
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
            <ul class="nav navbar-nav navbar-left"  style="font-size:21px;color:gray;margin:1%">
                <li>
                <a href="<?php echo ROOT_DIRECTORY . '/index.php' ?>">
                        <?php echo NAME_PROJECT; echo" "; ?> <i type='span' class='fa fa-book' aria-hidden='true' style="font-size:19px;color:gray"></i>
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right" style="font-size:19px;color:gray;margin:1%" >
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

<style>
#topNavBar{

  background-image: url(" https://media.discordapp.net/attachments/770685547953389581/781363175093436446/foto.png?width=962&height=96 ");/*repeating-linear-gradient(#F9E79F, #D6EAF8, #FADBD8);*/
   -webkit-background-size: cover;
   -moz-background-size: cover;
   -o-background-size: cover;
   background-size: cover;
   height: 100%;
   width: 100% ;
   text-align: center; 
}
</style>