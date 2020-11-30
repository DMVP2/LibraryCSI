<?php
include_once('../../../routes.php');


include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'UserDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'User.php');


$c = Connection::getInstance();
$connection = $c->connectBD();

$userDriving = new UserDriving($connection);
$owners = $userDriving->listUsersByRol(1);
$admins = $userDriving->listUsersByRol(2);
?>

<table id="tableAdmin" class="table table-hover table-striped">
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
        foreach ($owners as $owner) {

            echo "<tr>";

            echo "<td>" . $owner->getUserId() . "</td>";
            echo "<td>" . $owner->getTypeDocument() . "</td>";
            echo "<td>" . $owner->getName() . "</td>";
            echo "<td>" . $owner->getLastName() . "</td>";
            echo "<td>(Owner)</td>";
            echo "<td></td>";


            echo "</tr>";
        }
        foreach ($admins as $admin) {

            if (strcasecmp($admin->getStatus(), 'Active') == 0) {
                $btnAction = "
                <button class='btn btn-red btn-fill' onclick='executeAction(0, " . $admin->getUserId() . ")'>
                    <i type='span' class='fa fa-lock' style='color: white'></i>
                </button>";
            } else if (strcasecmp($admin->getStatus(), 'Blocked') == 0) {
                $btnAction = "
                <button class='btn btn-red btn-fill' onclick='executeAction(1, " . $admin->getUserId() . ")'>
                    <i type='span' class='fa fa-unlock' style='color: white'></i>
                </button>";
            } else {
                $btnAction = "";
            }
            $state = "";
            if (strcasecmp($admin->getStatus(), 'Active') == 0) {
                $state = "Activo";
            } else if (strcasecmp($admin->getStatus(), 'Inactive') == 0) {
                $state = "Inactivo";
            } else {
                $state = "Bloqueado";
            }

            echo "<tr>";

            echo "<td>" . $admin->getUserId() . "</td>";
            echo "<td>" . $admin->getTypeDocument() . "</td>";
            echo "<td>" . $admin->getName() . "</td>";
            echo "<td>" . $admin->getLastName() . "</td>";
            echo "<td>" . $state . "</td>";
            echo "<td>" . $btnAction . "</td>";

            echo "</tr>";
        }
        ?>
    </tbody>
</table>
<script>
$('#tableAdmin').DataTable();
</script>