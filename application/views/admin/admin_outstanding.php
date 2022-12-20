<div id="content-wrapper">
  <div class="container-fluid mb-5">

    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Aviso destacado</li>
    </ol>


    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Aviso destacado del día
        </div>
        <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-outstanding" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Expiración</th>
                            <th>Imagen</th>   
                            <th>Estado</th> 
                            <th>Editar</th> 
                          
                        </tr>
                        </thead>
                    </table>
                    </div>
        </div>
    </div>

  </div>
</div>





<div class="modal fade bd-example-modal-lg" id="outstanding_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Editar destacado</h5>
        <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm">
            <p id="UserModalInfo"></p>
          </div>
        </div>
      
        <div class="form-group">
       
              <div class="row">
                  <div class="col-md-6 mb-3">
                        <label for="actividad">Fecha expiración</label>
                        <div div class="input-group" id="frm_name2">
                            <input type="text" class="form-control"  name="date_expiration" id="date_expiration"  >
                            <div class="invalid-feedback "></div>
                        </div>
                        
                  </div>
                 
                 
                </div>
                <div class="row">

                  <form  id= "image_section" >

                   <div class="col-md-12 mb-3">
                      <label for="actividad">Cargar imagen:</label>
                      <div class="form-group " id="frm_foto">
                       <div class= "custom-input" >
                          <input type="file"  data-preview-file-type="any" name="file-section" id="file-section">
                          <label  for="file_e">Elegir imagen</label>
                         <!-- <label class="custom-file-label" for="file_e">Elegir imagen</label>-->
                     </form>
                          </div>
                      </div>
                   <div class="form-group float-right">
                       <button type="button" id="update_section_btn" class="btn btn-primary">Guardar</button>
                  </div>
                
                </div>
                </div>
                </div>
        </div>
    </div>
  </div>
</div>

<style>

  #date_expiration{ z-index:1151 !important; }
  
</style>




<script src="<?php echo base_url(); ?>assets/js_admin/admin_outstanding.js?v=<?php echo(rand()); ?>"></script>