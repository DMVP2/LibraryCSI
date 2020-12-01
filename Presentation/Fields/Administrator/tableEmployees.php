<?php

include_once('../../../routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'UserDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'User.php');


$c = Connection::getInstance();
$connection = $c->connectBD();

$userDriving = new UserDriving($connection);
$empleados = $userDriving->listUsersByRol(3);

?>

<table id="tableEmployee" class="table table-hover table-striped">
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
        foreach ($empleados as $empleado) {


            if (strcasecmp($empleado->getStatus(), 'Active') == 0) {
                $btnAction = "
                <button class='btn btn-red btn-fill' onclick='executeAction(0, " . $empleado->getUserId() . ")'>
                    <i type='span' class='fa fa-lock' style='color: white'></i>
                </button>";
            } else if (strcasecmp($empleado->getStatus(), 'Blocked') == 0) {
                $btnAction = "
                <button class='btn btn-red btn-fill' onclick='executeAction(1, " . $empleado->getUserId() . ")'>
                    <i type='span' class='fa fa-unlock' style='color: white'></i>
                </button>";
            } else {
                $btnAction = "";
            }

            $state = "";
            if (strcasecmp($empleado->getStatus(), 'Active') == 0) {
                $state = "Activo";
            } else {
                $state = "Bloqueado";
            }

            echo "<tr>";

            echo "<td>" . $empleado->getUserId() . "</td>";
            echo "<td>" . $empleado->getTypeDocument() . "</td>";
            echo "<td>" . $empleado->getName() . "</td>";
            echo "<td>" . $empleado->getLastName() . "</td>";
            echo "<td>" . $state . "</td>";
            echo "<td>" . $btnAction . "</td>";

            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<script>
$('#tableEmployee').DataTable();
</script>