<?php
$idUser = $_REQUEST['idUser'];
?>

<br>
<div class="row centerLarge">
    <div class="col-md-12 ">
        <div class="card">
            <div class="header">
                <h5 class="title">Reservas <?php echo " " . $idUser  ?></h5>
            </div>
            <div class="content table-responsive table-full-width">

                <table class="table table-hover table-striped">
                    <thead>
                        <th>Documento</th>
                        <th>Codigo</th>
                        <th>Estado</th>
                        <th>Fecha de entrega</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>100 años de soledad</td>
                            <td>ISBN 1234</td>
                            <td>Recogido</td>
                            <td>20/11/2020</td>
                            <td><button><i type="span" class="fa fa-sign-out" aria-hidden="true"></i></button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>