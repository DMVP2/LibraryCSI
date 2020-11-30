<?php
include_once('../../../routes.php');


include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_DRIVINGS . 'DocumentDriving.php');

include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_PERSISTENCE . 'Connection.php');
include_once($_SERVER['DOCUMENT_ROOT'] . ROOT_DIRECTORY . ROUTE_ENTITIES . 'Document.php');


$c = Connection::getInstance();
$connection = $c->connectBD();

$documentDriving = new DocumentDriving($connection);
$documents = $documentDriving->listDocuments();
?>
<table id="tableDocuments" class="table table-hover table-striped">
    <thead>
        <th>Codigo</th>
        <th>Titulo</th>
        <th>Editorial</th>
        <th>Fecha publicación</th>
        <th>Tipo</th>
        <th>Estado</th>
        <th>Acción</th>
    </thead>
    <tbody>
        <?php
        foreach ($documents as $document) {

            if (strcasecmp($document->getStatus(), 'Active') == 0) {
                $btnAction = "
                                                    <button class='btn btn-red btn-fill' onclick='executeAction(0, " . $document->getDocumentId() . ")'>
                                                        <i type='span' class='fa fa-times' style='color: white'></i>
                                                    </button>";
            } else if (strcasecmp($document->getStatus(), 'Inactive') == 0) {
                $btnAction = "
                                                    <button class='btn btn-red btn-fill' onclick='executeAction(1, " . $document->getDocumentId() . ")'>
                                                        <i type='span' class='fa fa-check' style='color: white'></i>
                                                    </button>";
            } else {
                $btnAction = "";
            }

            $state = "";
            if (strcasecmp($document->getStatus(), 'Active') == 0) {
                $state = "Activo";
            } else if (strcasecmp($document->getStatus(), 'Inactive') == 0) {
                $state = "Inactivo";
            } else {
                $state = "Bloqueado";
            }

            echo "<tr>";

            echo "<td>" . $document->getCode() . "</td>";
            echo "<td>" . $document->getTitle() . "</td>";
            echo "<td>" . $document->getEditorial() . "</td>";
            echo "<td>" . $document->getDateOfPublication() . "</td>";
            echo "<td>" . $document->getType() . "</td>";
            echo "<td>" . $state . "</td>";
            echo "<td>" . $btnAction . "</td>";


            echo "</tr>";
        }
        ?>
    </tbody>
</table>
<script>
$('#tableDocuments').DataTable();
</script>