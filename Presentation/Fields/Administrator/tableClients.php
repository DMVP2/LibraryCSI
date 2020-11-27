<?php

include_once('../../../routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'UserDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'User.php');


$c = Connection::getInstance();
$connection = $c->connectBD();

$userDriving = new UserDriving($connection);
$clients = $userDriving->listUsersByRol(5);
?>


<table id="tableClient" class="table table-hover table-striped">
    <thead>
        <th>Documento</th>
        <th>Tipo</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Estado</th>
        <th>Acción</th>

    </thead>
    <tbody>
        <?php
        foreach ($clients as $client) {

            if (strcasecmp($client->getStatus(), 'Active') == 0) {
                $btnAction = "
                <button class='btn btn-red btn-fill' onclick='executeAction(0, " . $client->getUserId() . ")'>
                    <i type='span' class='fa fa-lock' style='color: white'></i>
                </button>";
            } else if (strcasecmp($client->getStatus(), 'Blocked') == 0) {
                $btnAction = "
                <button class='btn btn-red btn-fill' onclick='executeAction(1, " . $client->getUserId() . ")'>
                    <i type='span' class='fa fa-check' style='color: white'></i>
                </button>";
            } else {
                $btnAction = "";
            }

            echo "<tr>";

            echo "<td>" . $client->getUserId() . "</td>";
            echo "<td>" . $client->getTypeDocument() . "</td>";
            echo "<td>" . $client->getName() . "</td>";
            echo "<td>" . $client->getLastName() . "</td>";
            echo "<td>" . $client->getStatus() . "</td>";
            echo "<td>" . $btnAction . "</td>";

            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<script>
$('#tableClient').DataTable();
</script>