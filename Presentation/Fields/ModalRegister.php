<!-- Modal -->
<div class="modal fade modal-mini modal-primary" id="myModal1" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:60%">

                <div class="modal-header justify-content-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel">
                        <center>¿Que tipo de usuario deseas ser?</center>
                        

                    </h5>
                </div>
                <div class="modal-body text-center">
                    <button type="button" class="btn btn-primary btn-outline-primary" style="width: 132px;"
                        onclick="window.location.href='<?php echo ROOT_DIRECTORY . ROUTE_PRESENTATION . 'register.php?u=1' ?>'">Estandar</button>
                    &nbsp;o&nbsp;
                    <button type="button" class="btn btn-danger btn-outline-primary" style="width: 132px;"
                        onclick="window.location.href='<?php echo ROOT_DIRECTORY . ROUTE_PRESENTATION . 'register.php?u=2' ?>'">Publicador</button>
                
                    </div>
                    
            </div>
        </div>
    </div>
</div>