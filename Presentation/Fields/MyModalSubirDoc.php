<!-- Modal -->
<div class="modal fade modal-mini modal-primary" id="myModalSubirDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:60%">

                <div class="modal-header justify-content-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel">
                        <center>¿Que tipo de documento deseas subir?</center>
                    </h5>
                </div>
                <div class="modal-body text-center">
                    <button type="button" class="btn btn-primary btn-outline-primary" style="width: 132px;" onclick="window.location.href='<?php echo ROOT_DIRECTORY . ROUTE_FIELDS . 'Client/upDocument.php?u=1' ?>'">Libro Físico</button>
                    &nbsp;o&nbsp;
                    <button type="button" class="btn btn-success btn-outline-primary" style="width: 132px;" onclick="window.location.href='<?php echo ROOT_DIRECTORY . ROUTE_FIELDS . 'Client/upDocument.php?u=2' ?>'">Documento PDF</button>
                </div>

            </div>
        </div>
    </div>
</div>