<?php

include_once('../../../routes.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'UserDriving.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'PublisherDriving.php');


include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'User.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Publisher.php');


$c = Connection::getInstance();
$connection = $c->connectBD();

$userDriving = new UserDriving($connection);
$publisherDriving = new PublisherDriving($connection);

$usersPublishers = $userDriving->listUsersByRol(4);

?>
<table id="tablePublishers" class="table table-hover table-striped">
    <thead>
        <th>Documento</th>
        <th>Tipo</th>
        <th>Nombre</th>
        <th>Nombre comercial</th>
        <th>Estado</th>
        <th>Acción</th>
    </thead>
    <tbody>
        <?php
        foreach ($usersPublishers as $userPub) {

            $publisher = $publisherDriving->searchPublisherById($userPub->getUserId());

            if (strcasecmp($publisher->getStatus(), 'Pending') == 0) {
                $btnAction = " 
                                                    <button class='btn btn-warning btn-fill' onclick='executeAction(1, " . $publisher->getDocument() . ")'>
                                                        <i type='span' class='fa fa-check-circle' style='color: white'></i>
                                                    </button>
                                                    <button class='btn btn-red btn-fill' onclick='executeAction(0, " . $publisher->getDocument() . ")'>
                                                        <i type='span' class='fa fa-times-circle' style='color: white'></i>
                                                    </button>";
            } else if (strcasecmp($publisher->getStatus(), 'Active') == 0) {
                $btnAction = " 
                                                    <button class='btn btn-orange btn-fill' onclick='executeAction(0, " . $publisher->getDocument() . ")'>
                                                        <i type='span' class='fa fa-times' style='color: white'></i>
                                                    </button>";
            } else {
                $btnAction = "
                                                    <button class='btn btn-success btn-fill' onclick='executeAction(1, " . $publisher->getDocument() . ")'>
                                                        <i type='span' class='fa fa-check' style='color: white'></i>
                                                    </button>";
            }

            $state = "";
            if (strcasecmp($publisher->getStatus(), 'Active') == 0) {
                $state = "Activo";
            } else if (strcasecmp($publisher->getStatus(), 'Inactive') == 0) {
                $state = "Inactivo";
            } else {
                $state = "Pendiente";
            }

            echo "<tr>";

            echo "<td>" . $userPub->getTypeDocument() . " " . $userPub->getUserId() . "</td>";
            echo "<td>" . $publisher->getType() . "</td>";
            echo "<td>" . $userPub->getName() . " " . $userPub->getLastName() . "</td>";
            echo "<td>" . $publisher->getBusinessName() . "</td>";
            echo "<td>" . $state . "</td>";
            echo "<td>" . $btnAction . "</td>";

            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<script>
$('#tablePublishers').DataTable();
</script>