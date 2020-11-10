<?php

$rol = 'employee';

?>


<div class="span3">
    <div class="sidebar">
        <ul class="widget widget-menu unstyled">

            <?php if (strcasecmp($rol, 'employee') == 0) { ?>

            <li><a href="index.html"><i class="menu-icon fa fa-book"></i>Reservas
                </a></li>

            <?php } else {  ?>


            <li class="active"><a href="index.html"><i class="menu-icon icon-dashboard"></i>Dashboard
                </a></li>
            <li><a href="activity.html"><i class="menu-icon icon-bullhorn"></i>News Feed </a>
            </li>
            <li><a href="message.html"><i class="menu-icon icon-inbox"></i>Inbox </a></li>
            <li><a href="task.html"><i class="menu-icon icon-tasks"></i>Tasks </a></li>
        </ul>
        <!--/.widget-nav-->


        <ul class="widget widget-menu unstyled">
            <li><a href="ui-button-icon.html"><i class="menu-icon icon-bold"></i> Buttons </a></li>
            <li><a href="ui-typography.html"><i class="menu-icon icon-book"></i>Typography </a></li>
            <li><a href="form.html"><i class="menu-icon icon-paste"></i>Forms </a></li>
            <li><a href="table.html"><i class="menu-icon icon-table"></i>Tables </a></li>
            <li><a href="charts.html"><i class="menu-icon icon-bar-chart"></i>Charts </a></li>
        </ul>

        <?php } ?>

    </div>
    <!--/.sidebar-->
</div>
<!--/.span3-->
<div class="span9">
    <div class="content">
        <!--/#btn-controls-->


        <!--/.module-->
    </div>
    <!--/.content-->
</div>
<!--/.span9-->